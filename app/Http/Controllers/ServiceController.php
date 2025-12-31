<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceModel;
use App\Models\ServiceHeadingModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = ServiceModel::where('is_delete', false)->orderBy('created_at', 'desc')->paginate(10);


        $serviceHeading = ServiceHeadingModel::firstOrCreate(
            ['id' => 1],
            [
                'small_heading' => 'Default Small Subheading',
                'heading' => 'Default Heading',
                'heading_description' => 'Default Heading Description',
                'seo_title' => 'Default SEO Title',
                'seo_description' => 'Default SEO Description',
                'seo_keywords' => 'default,keywords',
                'seo_image' => null,
            ]
        );


        return view('backend.services.index', compact('services', 'serviceHeading'));
    }


    public function create()
    {
        return view('backend.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_publish' => 'required|in:Publish,Draft',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
            'seo_title' => 'required|string|max:255',
            'seo_keywords' => 'required|string|max:1000',
            'seo_description' => 'required|string',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
            'is_delete' => 'nullable|boolean'
        ]);

        try {
            DB::beginTransaction();

            $manager = new ImageManager(new Driver());

            // Handle main image upload
            $image_path = null;
            if ($request->hasFile('image')) {
                $icon = $request->file('image');
                $iconName = 'icon_' . uniqid() . '_' . time() . '.webp';
                $iconPath = storage_path('app/public/service_icons');

                if (!File::exists($iconPath)) {
                    File::makeDirectory($iconPath, 0755, true);
                }

                $manager->read($icon->getRealPath())
                    ->cover(1200, 900)
                    ->toWebp(90)
                    ->save($iconPath . '/' . $iconName);

                $image_path = 'service_icons/' . $iconName;
            }

            // Handle SEO image upload
            $seo_image_path = null;
            if ($request->hasFile('seo_image')) {
                $seoImage = $request->file('seo_image');
                $seoImageName = 'seo_' . uniqid() . '_' . time() . '.webp';
                $seoImagePath = storage_path('app/public/service_seo');

                if (!File::exists($seoImagePath)) {
                    File::makeDirectory($seoImagePath, 0755, true);
                }

                $manager->read($seoImage->getRealPath())
                    ->resize(1200, 630)
                    ->toWebp(75)
                    ->save($seoImagePath . '/' . $seoImageName);

                $seo_image_path = 'service_seo/' . $seoImageName;
            }

            // Create slug from title
            $slug = \Str::slug($request->title);

            // Ensure slug uniqueness
            $count = ServiceModel::where('slug', 'like', $slug . '%')->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            // Create the new service
            ServiceModel::create([
                'title' => $request->input('title'),
                'slug' => $slug,
                'description' => $request->input('description'),
                'is_publish' => $request->input('is_publish'),
                'image' => $image_path,
                'seo_title' => $request->input('seo_title'),
                'seo_keywords' => $request->input('seo_keywords'),
                'seo_description' => $request->input('seo_description'),
                'seo_image' => $seo_image_path,
                'is_delete' => $request->input('is_delete', false),
            ]);

            DB::commit();
            return redirect()->route('backend.services.index')->with('success', 'Service created successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function show($slug)
    {
        $service = ServiceModel::where('slug', $slug)
            ->where('is_delete', false)
            ->where('is_publish', 'Publish')
            ->firstOrFail();

        return view('website.service_detail', compact('service'));
    }



    public function edit(string $id)
    {
        $service = ServiceModel::findOrFail($id);
        return view('backend.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_publish' => 'required|in:Publish,Draft',
            'image' => 'required|image|max:10048',
            'seo_image' => 'nullable|image|max:10048',
            'seo_title' => 'required|string|max:255',
            'seo_keywords' => 'required|string',
            'seo_description' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $service = ServiceModel::findOrFail($id);
            $manager = new ImageManager(new Driver());

            /** MAIN IMAGE **/
            if ($request->hasFile('image')) {
                if ($service->image && Storage::disk('public')->exists($service->image)) {
                    Storage::disk('public')->delete($service->image);
                }

                $name = 'icon_' . time() . '.webp';
                $path = storage_path('app/public/service_icons');
                File::ensureDirectoryExists($path);

                $manager->read($request->image->getRealPath())
                    ->cover(1200, 900) 
                    ->toWebp(90)
                    ->save($path . '/' . $name);

                $service->image = 'service_icons/' . $name;
            }

            /** SEO IMAGE **/
            if ($request->hasFile('seo_image')) {
                if ($service->seo_image && Storage::disk('public')->exists($service->seo_image)) {
                    Storage::disk('public')->delete($service->seo_image);
                }

                $seoName = 'seo_' . time() . '.webp';
                $seoPath = storage_path('app/public/service_seo');
                File::ensureDirectoryExists($seoPath);

                $manager->read($request->seo_image->getRealPath())
                    ->resize(1200, 630)
                    ->toWebp(75)
                    ->save($seoPath . '/' . $seoName);

                $service->seo_image = 'service_seo/' . $seoName;
            }

            // Update slug if title changed
            if ($service->title !== $request->title) {
                $slug = \Str::slug($request->title);
                $count = ServiceModel::where('slug', 'like', $slug . '%')->where('id', '!=', $id)->count();
                if ($count > 0) {
                    $slug .= '-' . ($count + 1);
                }
                $service->slug = $slug;
            }

            $service->update([
                'title' => $request->title,
                'description' => $request->description,
                'seo_title' => $request->seo_title,
                'seo_keywords' => $request->seo_keywords,
                'seo_description' => $request->seo_description,
                'is_publish' => $request->is_publish,
            ]);

            DB::commit();
            return redirect()->route('backend.services.index')->with('success', 'Service updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = ServiceModel::findOrFail($id);

        // Soft delete the service (mark is_delete as true)
        $service->update(['is_delete' => true]);

        return redirect()->route('backend.services.index')->with('success', 'Service deleted successfully!');
    }
}
