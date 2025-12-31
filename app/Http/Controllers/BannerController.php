<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = BannerModel::where('is_delete', false)->orderBy('created_at', 'desc')->paginate(10);
        return view('backend.banner.index', compact('banners'));
    }
    
        
    
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('backend.banner.create');   
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'is_publish' => 'required|in:Publish,Draft',
        ]);

        BannerModel::create([
            'title' => $request->title,
            'is_publish' => $request->is_publish,
            'is_delete' => false, // New categories are not deleted
        ]);

        return redirect()->route('backend.home.index')->with('success', 'Banner created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banners = BannerModel::findOrFail($id);
            return view('backend.banner.edit', compact('banners'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'is_publish' => 'required|in:Publish,Draft',
        ]);
    
        // Find the banner by its ID
        $banners = BannerModel::findOrFail($id);
    
        $banners->update([
            'title' => $request->title,
            'is_publish' => $request->is_publish,
        ]);
    
        return redirect()->route('backend.home.index')->with('success', 'Banner updated successfully.');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Find the banner
    $banners = BannerModel::findOrFail($id);

    // Set the 'is_delete' flag to true (soft delete)
    $banners->is_delete = true;
    $banners->save();

    // Redirect back with success message
    return redirect()->route('backend.home.index')->with('success', 'Banner deleted successfully.');
}
}
