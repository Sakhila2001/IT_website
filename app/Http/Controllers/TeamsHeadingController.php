<?php

namespace App\Http\Controllers;

use App\Models\TeamsHeadingHModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Exception;

class TeamsHeadingController extends Controller
{
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
        $teamsHeading = TeamsHeadingHModel::first();

        if (!$teamsHeading) {
            $teamsHeading = TeamsHeadingHModel::create([
                'small_heading' => 'Default Small Heading',
                'heading' => 'Default Heading',
                'heading_description' => 'Default Description',
            ]);
        }

        return view('backend.teams_heading.edit', compact('teamsHeading'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
            $teamsHeading = TeamsHeadingHModel::findOrFail($id);

            // Format SEO keywords
            if ($request->filled('seo_keywords')) {
                $validated['seo_keywords'] = collect(preg_split('/[,\n]/', $request->seo_keywords, -1, PREG_SPLIT_NO_EMPTY))
                    ->map(fn($item) => trim($item))
                    ->filter()
                    ->unique()
                    ->implode(', ');
            }

            // Handle SEO image removal
            if ($request->input('remove_seo_image')) {
                if ($teamsHeading->seo_image) {
                    Storage::delete('public/' . $teamsHeading->seo_image);
                }
                $validated['seo_image'] = null;
            } elseif ($request->hasFile('seo_image')) {
                if ($teamsHeading->seo_image) {
                    Storage::delete('public/' . $teamsHeading->seo_image);
                }

                $manager = new ImageManager(new Driver());

                $imageName = 'seo_' . time() . '.webp';
                $relativePath = 'teams_heading/seo/' . $imageName;
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

            $teamsHeading->fill($validated)->save();

            return redirect()->route('backend.teams.index')
                ->with('success', 'Teams Heading Details updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
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
