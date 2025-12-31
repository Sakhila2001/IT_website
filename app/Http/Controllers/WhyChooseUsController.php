<?php

namespace App\Http\Controllers;

use App\Models\WhyChooseUsHeadingModel;
use App\Models\WhyChooseUsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $choose = WhyChooseUsModel::where('is_delete', false)->orderBy('created_at', 'desc')->paginate(10);
        $chooseHeading = WhyChooseUsHeadingModel::first();

        // If no record exists, create a default one
        if (!$chooseHeading) {
            $chooseHeading = WhyChooseUsHeadingModel::create([
                'small_heading' => 'Default Small Heading',
                'heading' => 'Default Heading',

                'heading_description' => 'Default Description',
            ]);
        }
        return view('backend.why_choose_us.index', compact('choose', 'chooseHeading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.why_choose_us.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_publish' => 'required|in:Publish,Draft',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
        ]);

        try {
            $imagePath = null;

            if ($request->hasFile('file')) {
                // Store original image
                $imagePath = $request->file('file')->store('iconimages', 'public');

                // Create ImageManager with specific driver
                $manager = new ImageManager(new Driver()); // or new Imagick\Driver()

                // Read and manipulate image
                $image = $manager->read(public_path('storage/' . $imagePath));
                $image->scaleDown(300, 300); // Maintains aspect ratio

                // Save the modified image
                $image->save(public_path('storage/' . $imagePath));
            }

            WhyChooseUsModel::create([
                'title' => $request->title,
                'description' => $request->description,
                'is_publish' => $request->is_publish,
                'icon_image' => $imagePath,
            ]);

            return redirect()->route('backend.why_choose_us.index')->with('success', 'Why Choose Us List created successfully.');

        } catch (\Exception $e) {
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()
                ->withInput()
                ->with('error', 'Error creating partner: ' . $e->getMessage());
        }
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
    public function edit(string $id)
    {
        $choose = WhyChooseUsModel::findOrFail($id);
        return view('backend.why_choose_us.edit', compact('choose'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_publish' => 'required|in:Publish,Draft',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
        ]);

        try {
            $choose = WhyChooseUsModel::findOrFail($id);
            $imagePath = $choose->icon_image; // Keep existing image by default

            if ($request->hasFile('file')) {
                // Delete old image if it exists
                if ($choose->icon_image && Storage::disk('public')->exists($choose->icon_image)) {
                    Storage::disk('public')->delete($choose->icon_image);
                }

                // Store new image
                $imagePath = $request->file('file')->store('iconimages', 'public');

                // Create ImageManager with specific driver
                $manager = new ImageManager(new Driver());

                // Read and manipulate image
                $image = $manager->read(public_path('storage/' . $imagePath));
                $image->scaleDown(300, 300); // Maintains aspect ratio

                // Save the modified image
                $image->save(public_path('storage/' . $imagePath));
            }

            $choose->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_publish' => $request->is_publish,
                'icon_image' => $imagePath,
            ]);

            return redirect()->route('backend.why_choose_us.index')
                ->with('success', 'Why choose us list updated successfully.');

        } catch (\Exception $e) {
            // Clean up if there was an error during new image upload
            if (isset($imagePath) && $imagePath !== $choose->icon_image && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()
                ->withInput()
                ->with('error', 'Error updating partner: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $choose = WhyChooseUsModel::findOrFail($id);

        $choose->is_delete = true;
        $choose->save();

        // Redirect back with success message
        return redirect()->route('backend.why_choose_us.index')->with('success', 'Why choose us list deleted successfully.');
    }
}
