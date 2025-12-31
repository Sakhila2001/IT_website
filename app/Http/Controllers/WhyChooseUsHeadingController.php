<?php

namespace App\Http\Controllers;

use App\Models\WhyChooseUsHeadingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class WhyChooseUsHeadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $chooseHeading = WhyChooseUsHeadingModel::first();

        // If no record exists, create a default one
        if (!$chooseHeading) {
            $chooseHeading = WhyChooseUsHeadingModel::create([
                'small_heading' => 'Default Small Heading',
                'heading' => 'Default Heading',
                'heading_description' => 'Default Description',
                'banner_image' => null
            ]);
        }

        return view('backend.why_choose_us_heading.edit', compact('chooseHeading'));
    }

    /**
     * Update the specified resource in storage.
     */





    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required',
            'small_heading' => 'required',
            'heading_description' => 'required',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
        ]);

        $data = $request->only(['heading', 'heading_description', 'small_heading']);
        $chooseHeading = WhyChooseUsHeadingModel::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('banner_image')) {
            // Delete old image if exists
            if ($chooseHeading->image && Storage::disk('public')->exists($chooseHeading->image)) {
                Storage::disk('public')->delete($chooseHeading->image);
            }

            // Store original image
            $imagePath = $request->file('banner_image')->store('choose_images', 'public');

            // Create ImageManager with GD driver
            $manager = new ImageManager(new Driver());

            // Read and manipulate image
            $image = $manager->read(storage_path('app/public/' . $imagePath));
            $image->scaleDown(725); // Scale down to max width 800px maintaining aspect ratio

            // Save the modified image
            $image->save(storage_path('app/public/' . $imagePath));

            $data['banner_image'] = $imagePath;
        } elseif ($request->has('remove_image')) {
            // Remove image if checkbox is checked
            if ($chooseHeading->image && Storage::disk('public')->exists($chooseHeading->image)) {
                Storage::disk('public')->delete($chooseHeading->image);
            }
            $data['banner_image'] = null;
        }

        $chooseHeading->update($data);

        return redirect()->route('backend.why_choose_us.index')->with('success', 'Why Choose Us Heading Details updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
