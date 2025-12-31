<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PortfolioModel;
use App\Models\PortfolioCategoryModel;
use App\Models\PortfolioHeadingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    // Default values for the portfolio heading
    protected $defaultValues = [
        'id' => 1,
        'small_heading' => 'Our Work',
        'heading' => 'Work & Project',
        'heading_description' => 'Explore our collection of projects built with cutting-edge technology.',
        'seo_title' => 'Our Portfolio | Company Name',
        'seo_description' => 'Explore our portfolio of innovative projects and work.',
        'seo_keywords' => 'portfolio, projects, work, company portfolio',
        'seo_image' => null,
    ];

    /**
     * Get or create the single portfolio heading record with ID 1
     */
    protected function getPortfolioHeading()
    {
        return PortfolioHeadingModel::firstOrCreate(
            ['id' => 1],
            $this->defaultValues
        );
    }

    /**
     * Display a listing of the portfolios.
     */
    public function index()
    {
        $portfolios = PortfolioModel::where('is_delete', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get heading (creates default if not exists)
        $portfolioHeading = $this->getPortfolioHeading();

        return view('backend.portfolios.index', compact('portfolios', 'portfolioHeading'));
    }
    public function websiteContact()
    {
        // Fetch only published portfolios
        $portfolios = PortfolioModel::where('is_publish', 'Publish')
            ->where('is_delete', 0)
            ->get();
        $portfolioHeading = PortfolioHeadingModel::first();
        $seoData = [
            'title' => $portfolioHeading->seo_title ?? $portfolioHeading->heading ?? 'Our Services',
            'seo_description' => $portfolioHeading->seo_description ?? $portfolioHeading->heading_description ?? '',
            'seo_keyword' => $portfolioHeading->seo_keywords ?? '',
            'seo_image' => ($portfolioHeading && $portfolioHeading->seo_image) ? 'storage/' . $portfolioHeading->seo_image : '',
        ];

        $portfoliocategories = PortfolioCategoryModel::where('is_delete', false)
            ->whereHas('portfolios', function ($query) {
                $query->where('is_publish', 'Publish')->where('is_delete', 0);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('website.portfolio', compact('portfolios', 'portfoliocategories', 'portfolioHeading', 'seoData'));
    }



    public function create()
    {
        $portfoliocategories = PortfolioCategoryModel::where('is_publish', 'Publish')
            ->where('is_delete', 0)
            ->get();

        return view('backend.portfolios.create', compact('portfoliocategories'));

    }



    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|exists:portfolio_categories,id',
                'is_publish' => 'required|in:Publish,Draft',
                'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
            ]);

            // Initialize ImageManager
            $manager = new ImageManager(new Driver());
            $imagePath = null;

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $path = 'storage/portfolioimages/';

                // Create directory if not exists
                if (!File::isDirectory(public_path($path))) {
                    File::makeDirectory(public_path($path), 0755, true, true);
                }

                // Resize image to 373x267
                $image = $manager->read($image);
                $image->resize(373, 267);
                $image->save(public_path($path . $imageName));

                $imagePath = 'portfolioimages/' . $imageName;
            }

            PortfolioModel::create([
                'title' => $request->title,
                'portfolio_category_id' => $request->category,
                'is_publish' => $request->is_publish,
                'image' => $imagePath,
            ]);

            return redirect()->route('backend.portfolios.index')->with('success', 'Portfolio created successfully.');
        } catch (\Exception $e) {
            // Log the error (optional)
            \Log::error('Error creating portfolio: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the portfolio.');
        }
    }




    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $portfolios = PortfolioModel::findOrFail($id);
        $portfoliocategories = PortfolioCategoryModel::where('is_publish', 'Publish')
            ->where('is_delete', 0)
            ->get();


        return view('backend.portfolios.edit', compact('portfolios', 'portfoliocategories'));
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|exists:portfolio_categories,id',
                'is_publish' => 'required|in:Publish,Draft',
                'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
            ]);

            $portfolios = PortfolioModel::findOrFail($id);
            $manager = new ImageManager(new Driver());
            $imagePath = $portfolios->image;

            if ($request->hasFile('file')) {
                // Delete old image if exists
                if ($imagePath && File::exists(public_path('storage/' . $imagePath))) {
                    File::delete(public_path('storage/' . $imagePath));
                }

                $image = $request->file('file');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $path = 'storage/portfolioimages/';

                // Create directory if not exists
                if (!File::isDirectory(public_path($path))) {
                    File::makeDirectory(public_path($path), 0755, true, true);
                }

                // Resize image to 373x267
                $image = $manager->read($image);
                $image->resize(373, 267);
                $image->save(public_path($path . $imageName));

                $imagePath = 'portfolioimages/' . $imageName;
            }

            $portfolios->update([
                'title' => $request->title,
                'portfolio_category_id' => $request->category,
                'is_publish' => $request->is_publish,
                'image' => $imagePath,
            ]);

            return redirect()->route('backend.portfolios.index')->with('success', 'Portfolio updated successfully.');
        } catch (\Exception $e) {
            // Log the error (optional)
            \Log::error('Error updating portfolio: ' . $e->getMessage());

            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the portfolio.');
        }
    }



    public function destroy(string $id)
    {
        $portfolios = PortfolioModel::findOrFail($id);

        $portfolios->is_delete = true;
        $portfolios->save();

        // Redirect back with success message
        return redirect()->route('backend.portfolios.index')->with('success', 'Portfolios deleted successfully.');
    }
}
