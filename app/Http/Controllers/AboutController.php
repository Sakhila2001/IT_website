<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AboutModel;
use App\Models\ContactDetailModel;
use App\Models\FAQModel;
use App\Models\FaqsHeadingHModel;
use App\Models\PortfolioCategoryModel;
use App\Models\PortfolioModel;
use App\Models\TeamModel;
use App\Models\TeamsHeadingHModel;
use App\Models\WhyChooseUsHeadingModel;
use App\Models\WhyChooseUsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // or use Imagick\Driver for Imagick


class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = AboutModel::first();

        $teams = TeamModel::where('is_delete', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'teams_page'); // Use unique query parameter

        return view('backend.about.index', compact('about', 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function websiteContact()
    {
        $teamsHeading = TeamsHeadingHModel::first();
        $about = AboutModel::first();
        $seoData = [
            'title' => $about->seo_title ?? $about->heading ?? 'Our Services',
            'seo_description' => $about->seo_description ?? $about->heading_description ?? '',
            'seo_keyword' => $about->seo_keywords ?? '',
            'seo_image' => ($about && $about->seo_image) ? 'storage/' . $about->seo_image : '',
        ];

        $teams = TeamModel::where('is_delete', false)
            ->where('is_publish', 'Publish')
            ->orderBy('created_at', 'desc')
            ->get() ?? collect([]);

        $portfolios = PortfolioModel::where('is_publish', 'Publish')
            ->where('is_delete', 0)
            ->get();
        $choose = WhyChooseUsModel::where('is_delete', false)->orderBy('created_at', 'desc')->paginate(10);
        $chooseHeading = WhyChooseUsHeadingModel::first();

        $portfoliocategories = PortfolioCategoryModel::where('is_delete', false)
            ->whereHas('portfolios', function ($query) {
                $query->where('is_publish', 'Publish')->where('is_delete', 0);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $contact = ContactDetailModel::first();

        return view('website.about', compact(
            'about',
            'teams',
            'portfolios',
            'portfoliocategories',
            'contact',
            'teamsHeading',
            'seoData',
            'choose',
            'chooseHeading'
        ));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit()
    {
        $about = AboutModel::first();
        return view('backend.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    protected function processAndStoreImage($file, $relativePath, $width, $height)
    {
        // Ensure the directory exists
        $directory = dirname($relativePath);
        Storage::disk('public')->makeDirectory($directory);

        $manager = new ImageManager(new Driver());
        $manager->read($file)
            ->resize($width, $height)
            ->toWebp(75)
            ->save(storage_path('app/public/' . $relativePath));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
            'counter_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
            'heading' => 'required|string|max:255',
            'small_heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'core_description' => 'nullable|string',
            'mission_description' => 'nullable|string',
            'vision_description' => 'nullable|string',
            'years_of_experience' => 'nullable|integer|min:0',
            'no_of_employees' => 'nullable|integer|min:0',
            'no_of_users' => 'nullable|integer|min:0',
            'no_of_satisfied_clients' => 'nullable|integer|min:0',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
            'remove_seo_image' => 'nullable|boolean',
            'remove_image1' => 'nullable|boolean',
            'remove_image2' => 'nullable|boolean',
            'remove_counter_image' => 'nullable|boolean',
        ]);

        try {
            $about = AboutModel::firstOrNew(['id' => 1]);

            // Format SEO keywords if present
            if ($request->filled('seo_keywords')) {
                $validated['seo_keywords'] = collect(explode(',', $request->seo_keywords))
                    ->map(fn($item) => trim($item))
                    ->filter()
                    ->unique()
                    ->implode(', ');
            }

            // Handle image1 removal
            if ($request->remove_image1) {
                if ($about->image1) {
                    Storage::delete('public/' . $about->image1);
                }
                $validated['image1'] = null;
            } elseif ($request->hasFile('image1')) {
                if ($about->image1) {
                    Storage::delete('public/' . $about->image1);
                }
                $imageName = 'image1_' . time() . '.webp';
                $relativePath = 'about/images/' . $imageName;
                $this->processAndStoreImage($request->file('image1'), $relativePath, 600, 405);
                $validated['image1'] = $relativePath;
            }

            // Handle image2 removal
            if ($request->remove_image2) {
                if ($about->image2) {
                    Storage::delete('public/' . $about->image2);
                }
                $validated['image2'] = null;
            } elseif ($request->hasFile('image2')) {
                if ($about->image2) {
                    Storage::delete('public/' . $about->image2);
                }
                $imageName = 'image2_' . time() . '.webp';
                $relativePath = 'about/images/' . $imageName;
                $this->processAndStoreImage($request->file('image2'), $relativePath, 304, 205);
                $validated['image2'] = $relativePath;
            }

            // Handle counter_image removal
            if ($request->remove_counter_image) {
                if ($about->counter_image) {
                    Storage::delete('public/' . $about->counter_image);
                }
                $validated['counter_image'] = null;
            } elseif ($request->hasFile('counter_image')) {
                if ($about->counter_image) {
                    Storage::delete('public/' . $about->counter_image);
                }
                $imageName = 'counter_' . time() . '.webp';
                $relativePath = 'about/images/' . $imageName;
                $this->processAndStoreImage($request->file('counter_image'), $relativePath, 638, 431);
                $validated['counter_image'] = $relativePath;
            }

            // Handle SEO image removal
            if ($request->remove_seo_image) {
                if ($about->seo_image) {
                    Storage::delete('public/' . $about->seo_image);
                }
                $validated['seo_image'] = null;
            } elseif ($request->hasFile('seo_image')) {
                if ($about->seo_image) {
                    Storage::delete('public/' . $about->seo_image);
                }
                $imageName = 'seo_' . time() . '.webp';
                $relativePath = 'about/seo/' . $imageName;
                $this->processAndStoreImage($request->file('seo_image'), $relativePath, 1200, 630);
                $validated['seo_image'] = $relativePath;
            }

            $about->fill($validated)->save();

            return redirect()->route('backend.about.index')
                ->with('success', 'About page updated successfully');

        } catch (Exception $e) {
            \Log::error('About update error: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Something went wrong while updating the About Section. Error: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
