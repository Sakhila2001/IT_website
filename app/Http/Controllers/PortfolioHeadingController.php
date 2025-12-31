<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PortfolioHeadingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PortfolioHeadingController extends Controller
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
     * Display the portfolio heading
     */


    /**
     * Show the form for editing the portfolio heading
     */
    public function edit()
    {
        $portfolioHeading = $this->getPortfolioHeading();
        return view('backend.portfolio_heading.edit', compact('portfolioHeading'));
    }

    /**
     * Update the portfolio heading
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'small_heading' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'heading_description' => 'required|string',
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
            'remove_seo_image' => 'nullable|boolean',
        ]);

        try {
            DB::beginTransaction();

            $data = $this->getPortfolioHeading();

            // Format SEO keywords
            if ($request->filled('seo_keywords')) {
                $validated['seo_keywords'] = collect(explode(',', $request->seo_keywords))
                    ->map(fn($item) => trim($item))
                    ->filter()
                    ->unique()
                    ->implode(', ');
            } else {
                $validated['seo_keywords'] = $data->seo_keywords ?? $this->defaultValues['seo_keywords'];
            }

            $manager = new ImageManager(new Driver());

            // Handle SEO image
            if ($request->remove_seo_image && $data->seo_image) {
                Storage::disk('public')->delete($data->seo_image);
                $validated['seo_image'] = null;
            } elseif ($request->hasFile('seo_image')) {
                if ($data->seo_image) {
                    Storage::disk('public')->delete($data->seo_image);
                }
                $imageName = 'seo_' . time() . '.webp';
                $relativePath = 'portfolio_heading/seo/' . $imageName;
                Storage::disk('public')->makeDirectory('portfolio_heading/seo');
                $manager->read($request->file('seo_image'))
                    ->resize(1200, 630)
                    ->toWebp(75)
                    ->save(storage_path('app/public/' . $relativePath));
                $validated['seo_image'] = $relativePath;
            }



            // Log the validated data for debugging
            Log::info('Portfolio Heading Update', [
                'validated_data' => $validated,
                'existing_data' => $data->toArray()
            ]);

            // Update the record
            $data->fill($validated);
            $saved = $data->save();

            if (!$saved) {
                throw new Exception('Failed to save portfolio heading record');
            }

            DB::commit();
            return redirect()->route('backend.portfolios.index')
                ->with('success', 'Portfolio page updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Portfolio Heading Update Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
