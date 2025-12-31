<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CareerHeadingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;
use Illuminate\Support\Facades\Storage;
class CareerHeadingController extends Controller
{
    // Default values for the service heading
    protected $defaultValues = [
        'small_heading' => 'Default Small Heading',
        'heading' => 'Default Heading',
        'heading_description' => 'Default Description',
        'seo_title' => 'Default SEO Title',
        'seo_description' => 'Default SEO Description',
        'seo_keywords' => 'default,keywords',
        'seo_image' => null
    ];

    // Get or create the single service heading record
    protected function getcareerHeading()
    {
        return CareerHeadingModel::firstOrCreate([], $this->defaultValues);
    }

    public function index()
    {

    }

    public function websiteContact()
    {
        $careerHeading = $this->getcareerHeading();

        $careers = DB::connection('mysql')->table('careers')
            ->where('is_publish', 'Publish')
            ->where('is_delete', 0)
            ->get();

        // Prepare SEO data - use service heading or fallback to defaults
        $seoData = [
            'title' => $careerHeading->seo_title ?? $careerHeading->heading ?? 'Our Services',
            'seo_description' => $careerHeading->seo_description ?? $careerHeading->heading_description ?? '',
            'seo_keyword' => $careerHeading->seo_keywords ?? '',

            'seo_image' => ($careerHeading && $careerHeading->seo_image) ? 'storage/' . $careerHeading->seo_image : '',
        ];

        return view('website.career', compact('careerHeading', 'careers', 'seoData'));
    }



    public function edit()
    {
        $careerHeading = $this->getcareerHeading();
        return view('backend.career_heading.edit', compact('careerHeading'));
    }



    public function update(Request $request)
    {
        $validated = $request->validate([
            'small_heading' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'heading_description' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'sometimes|string',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10048',

        ]);

        try {
            $data = CareerHeadingModel::firstOrNew(['id' => 1]);

            // Format SEO keywords
            if ($request->filled('seo_keywords')) {
                $validated['seo_keywords'] = collect(explode(',', $request->seo_keywords))
                    ->map(fn($item) => trim($item))
                    ->filter()
                    ->unique()
                    ->implode(', ');
            }

            // Handle SEO image removal
            if ($request->remove_seo_image) {
                if ($data->seo_image) {
                    Storage::delete('public/' . $data->seo_image);
                }
                $validated['seo_image'] = null;
            }
            // Handle SEO image upload
            elseif ($request->hasFile('seo_image')) {
                if ($data->seo_image) {
                    Storage::delete('public/' . $data->seo_image);
                }

                $manager = new ImageManager(new Driver());

                $imageName = 'seo_' . time() . '.webp';
                $relativePath = 'careers/seo/' . $imageName;
                $fullPath = storage_path('app/public/' . $relativePath);

                if (!file_exists(dirname($fullPath))) {
                    mkdir(dirname($fullPath), 0755, true);
                }

                $manager->read($request->file('seo_image'))
                    ->resize(1200, 630)
                    ->toWebp(75)
                    ->save($fullPath);

                $validated['seo_image'] = $relativePath;
            }

            $data->fill($validated)->save();

            return redirect()->route('backend.careers.index')
                ->with('success', 'Career page updated successfully');

        } catch (Exception $e) {
            return back()->withInput()
                ->with('error', 'Something went wrong while updating the career hrading. Please try again.');
        }
    }


}
