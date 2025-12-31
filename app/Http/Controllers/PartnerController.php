<?php

namespace App\Http\Controllers;

use App\Models\PartnerHeadingModel;
use App\Models\PartnerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = PartnerModel::where('is_delete', false)->orderBy('created_at', 'desc')->paginate(10);
        $partnerHeading = PartnerHeadingModel::first();

        // If no record exists, create a default one
        if (!$partnerHeading) {
            $partnerHeading = PartnerHeadingModel::create([
                'small_heading' => 'Default Small Heading',
                'heading' => 'Default Heading',
                'heading_description' => 'Default Description',
            ]);
        }
        return view(('backend.partners.index'), compact('partners', 'partnerHeading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.partners.create');

    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_publish' => 'required|in:Publish,Draft',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
        ]);

        try {
            $imagePath = null;

            if ($request->hasFile('file')) {
                // Store original image
                $imagePath = $request->file('file')->store('partnerimages', 'public');

                // Create ImageManager with specific driver
                $manager = new ImageManager(new Driver()); // or new Imagick\Driver()

                // Read and manipulate image
                $image = $manager->read(public_path('storage/' . $imagePath));
                $image->scaleDown(300, 300); // Maintains aspect ratio

                // Save the modified image
                $image->save(public_path('storage/' . $imagePath));
            }

            PartnerModel::create([
                'name' => $request->name,
                'is_publish' => $request->is_publish,
                'image' => $imagePath,
            ]);

            return redirect()->route('backend.partners.index')->with('success', 'Partner created successfully.');

        } catch (\Exception $e) {
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()
                ->withInput()
                ->with('error', 'Something went wrong! Please Try again.');
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
        $partners = PartnerModel::findOrFail($id);
        return view('backend.partners.edit', compact('partners'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_publish' => 'required|in:Publish,Draft',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
        ]);

        try {
            $partners = PartnerModel::findOrFail($id);
            $imagePath = $partners->image; // Keep existing image by default

            if ($request->hasFile('file')) {
                // Delete old image if it exists
                if ($partners->image && Storage::disk('public')->exists($partners->image)) {
                    Storage::disk('public')->delete($partners->image);
                }

                // Store new image
                $imagePath = $request->file('file')->store('partnerimages', 'public');

                // Create ImageManager with specific driver
                $manager = new ImageManager(new Driver());

                // Read and manipulate image
                $image = $manager->read(public_path('storage/' . $imagePath));
                $image->scaleDown(300, 300); // Maintains aspect ratio

                // Save the modified image
                $image->save(public_path('storage/' . $imagePath));
            }

            $partners->update([
                'name' => $request->name,
                'is_publish' => $request->is_publish,
                'image' => $imagePath,
            ]);

            return redirect()->route('backend.partners.index')
                ->with('success', 'Partner updated successfully.');

        } catch (\Exception $e) {
            // Clean up if there was an error during new image upload
            if (isset($imagePath) && $imagePath !== $partners->image && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()
                ->withInput()
                ->with('error', 'Something went wrong! Please Try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $partners = PartnerModel::findOrFail($id);

        $partners->is_delete = true;
        $partners->save();

        // Redirect back with success message
        return redirect()->route('backend.partners.index')->with('success', 'Partner deleted successfully.');
    }
}
