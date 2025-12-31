<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceHeadingModel;
use App\Models\ServiceModel;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;
use Illuminate\Support\Facades\Storage;
class ServiceHeadingController extends Controller
{
    // Default values for the service heading
    protected $defaultValues = [
        'small_heading' => 'Default Small Subheading',
        'heading' => 'Default Heading',
        'heading_description' => 'Default Heading Description',
        'seo_title' => 'Default SEO Title',
        'seo_description' => 'Default SEO Description',
        'seo_keywords' => 'default,keywords',
        'seo_image' => null
    ];

    // Get or create the single service heading record
    protected function getServiceHeading()
    {
        return ServiceHeadingModel::firstOrCreate(
            ['id' => 1],
            $this->defaultValues
        );
    }


    public function index()
    {
        $serviceHeading = $this->getServiceHeading();
        return view('backend.service_heading.index', compact('serviceHeading'));
    }

    public function websiteContact()
    {
        $serviceHeading = $this->getServiceHeading();

        $services = DB::connection('mysql')->table('services')
            ->where('is_publish', 'Publish')
            ->where('is_delete', 0)
            ->get();

        // Prepare SEO data - use service heading or fallback to defaults
        $seoData = [
            'title' => $serviceHeading->seo_title ?? $serviceHeading->heading ?? 'Our Services',
            'seo_description' => $serviceHeading->seo_description ?? $serviceHeading->heading_description ?? '',
            'seo_keyword' => $serviceHeading->seo_keywords ?? '',
            'seo_image' => ($serviceHeading && $serviceHeading->seo_image) ? 'storage/' . $serviceHeading->seo_image : '',
        ];

        return view('website.services', compact('serviceHeading', 'services', 'seoData'));
    }


    public function edit()
    {
        $serviceHeading = $this->getServiceHeading();
        return view('backend.service_heading.edit', compact('serviceHeading'));
    }



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

        ]);

        try {
            $data = ServiceHeadingModel::firstOrNew(['id' => 1]);

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
                $relativePath = 'services/seo/' . $imageName;
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

            return redirect()->route('backend.services.index')
                ->with('success', 'Service page updated successfully');

        } catch (Exception $e) {
            return back()->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }


}
