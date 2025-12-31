<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TeamModel;
use App\Models\TeamsHeadingHModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = TeamModel::where('is_delete', false)->orderBy('created_at', 'desc')->paginate(10);

        $teamsHeading = TeamsHeadingHModel::first();

        // If no record exists, create a default one
        if (!$teamsHeading) {
            $teamsHeading = TeamsHeadingHModel::create([
                'small_heading' => 'Default Small Heading',
                'heading' => 'Default Heading',
                'heading_description' => 'Default Description',
                'seo_title' => 'Default SEO Title',
                'seo_description' => 'Default SEO Description',
                'seo_keywords' => 'default,keywords',
                'seo_image' => null
            ]);
        }

        return view('backend.teams.index', compact('teams', 'teamsHeading'));
    }
    public function websiteContact()
    {
        $teamsHeading = TeamsHeadingHModel::first();

        $teams = TeamModel::where('is_delete', false)
            ->where('is_publish', 'Publish')
            ->orderBy('created_at', 'desc')
            ->get();

        // Prepare SEO data - use service heading or fallback to defaults
        $seoData = [
            'title' => $teamsHeading->seo_title ?? $teamsHeading->heading ?? 'Our Teams',
            'seo_description' => $teamsHeading->seo_description ?? $teamsHeading->heading_description ?? '',
            'seo_keyword' => $teamsHeading->seo_keywords ?? '',
            'seo_image' => ($teamsHeading && $teamsHeading->seo_image) ? 'storage/' . $teamsHeading->seo_image : '',

        ];
        return view('website.team', compact('teams', 'teamsHeading', 'seoData'));
    }
    public function create()
    {
        return view('backend.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */


     public function store(Request $request)
     {
         // Validate first — let Laravel handle validation errors
         $request->validate([
             'name' => 'required|string|max:255',
             'designation' => 'nullable|string',
             'is_publish' => 'required|in:Publish,Draft',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
             'order' => [
                 'required',
                 'integer',
                 'min:1',
                 Rule::unique('teams')->where(fn($query) => $query->where('is_delete', false)),
             ],
             'facebook_link' => 'nullable|url',
             'instagram_link' => 'nullable|url',
             'Linkedin_link' => 'nullable|url',
             'twitter_link' => 'nullable|url',
             'whatsapp_link' => 'nullable|url',
             'is_delete' => 'nullable|boolean'
         ], [
             'order.unique' => 'This order number is already assigned to another active team member.',
             'order.min' => 'Order must be greater than 0.',
         ]);

         // Handle image upload...
         $image_path = null;
         if ($request->hasFile('image')) {
             $manager = new ImageManager(new Driver());
             $imageName = time() . '_' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
             $storagePath = 'team_images/' . $imageName;

             $image = $manager->read($request->file('image'));
             $image->cover(379, 392);
             Storage::disk('public')->put($storagePath, $image->encode());
             $image_path = $storagePath;
         }

         // Create the new team
         TeamModel::create([
             'name' => $request->name,
             'designation' => $request->designation,
             'is_publish' => $request->is_publish,
             'facebook_link' => $request->facebook_link,
             'instagram_link' => $request->instagram_link,
             'Linkedin_link' => $request->Linkedin_link,
             'twitter_link' => $request->twitter_link,
             'whatsapp_link' => $request->whatsapp_link,
             'order' => $request->order,
             'image' => $image_path,
             'is_delete' => $request->input('is_delete', false),
         ]);

         return redirect()->route('backend.teams.index')->with('success', 'Team created successfully!');
     }



    public function edit(string $id)
    {
        $team = TeamModel::findOrFail($id);
        return view('backend.teams.edit', compact('team'));
    }



    public function update(Request $request, string $id)
    {
        // Find the team first
        $team = TeamModel::findOrFail($id);

        // Validate — let Laravel handle validation errors
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string',
            'is_publish' => 'required|in:Publish,Draft',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10048',
            'order' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('teams')->ignore($team->id)->where(fn($query) => $query->where('is_delete', false)),
            ],
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'Linkedin_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'whatsapp_link' => 'nullable|url',
            'is_delete' => 'nullable|boolean'
        ], [
            'order.unique' => 'This order number is already assigned to another active team member.',
            'order.min' => 'Order must be greater than 0.',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                // Delete old image if exists
                if ($team->image && Storage::disk('public')->exists($team->image)) {
                    Storage::disk('public')->delete($team->image);
                }

                $manager = new ImageManager(new Driver());
                $imageName = time() . '_' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
                $storagePath = 'team_images/' . $imageName;

                $image = $manager->read($request->file('image'));
                $image->cover(379, 392);
                Storage::disk('public')->put($storagePath, $image->encode());

                $team->image = $storagePath;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to process image: ' . $e->getMessage());
            }
        }

        // Update team data
        $team->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'order' => $request->order,
            'is_publish' => $request->is_publish,
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'Linkedin_link' => $request->Linkedin_link,
            'twitter_link' => $request->twitter_link,
            'whatsapp_link' => $request->whatsapp_link,
            'is_delete' => $request->input('is_delete', false),
        ]);

        return redirect()->route('backend.teams.index')->with('success', 'Team updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = TeamModel::findOrFail($id);

        // Soft delete the team (mark is_delete as true)
        $team->update(['is_delete' => true]);

        return redirect()->route('backend.teams.index')->with('success', 'Team deleted successfully!');
    }
}
