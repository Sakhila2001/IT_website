<?php

namespace App\Http\Controllers;

use App\Models\PartnerHeadingModel;
use Illuminate\Http\Request;

class PartnerHeadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partnerHeading = PartnerHeadingModel::first();

        // If no record exists, create a default one
        if (!$partnerHeading) {
            $partnerHeading = PartnerHeadingModel::create([
                'small_heading' => 'Default Small Heading',
                'heading' => 'Default Heading',
                'heading_description' => 'Default Description',
            ]);
        }

        return view('backend.partners_heading.index', compact('partnerHeading'));
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
        $partnerHeading = PartnerHeadingModel::first();

        if (!$partnerHeading) {
            $partnerHeading = PartnerHeadingModel::create([
                'small_heading' => 'Default Small Heading',
                'heading' => 'Default Heading',
                'heading_description' => 'Default Description',
            ]);
        }

        return view('backend.partners_heading.edit', compact('partnerHeading'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        PartnerHeadingModel::updateOrCreate(
            ['id' => $id],
            $request->only(['heading', 'heading_description', 'small_heading'])
        );

        return redirect()->route('backend.partners.index')->with('success', 'Partners Heading Details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
