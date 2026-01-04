<?php

namespace App\Http\Controllers;

use App\Models\CareerHeadingModel;
use App\Models\CareerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = CareerModel::where('is_delete', false)->orderBy('created_at', 'desc')->paginate(10);


        $careerHeading = CareerHeadingModel::first();

        return view('backend.careers.index', compact('careers', 'careerHeading'));
    }


    public function create()
    {
        return view('backend.careers.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'job_descriptions' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_publish' => 'required|in:Publish,Draft',
        ]);

        try {
            DB::table('careers')->insert([
                'title' => $validated['title'],
                'job_descriptions' => $validated['job_descriptions'] ?? null,
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'is_publish' => $validated['is_publish'],
                'is_delete' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('backend.careers.index')->with('success', 'Career created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating career: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(CareerModel $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function edit($id)
    {
        $career = CareerModel::findOrFail($id);
        return view('backend.careers.edit', compact('career'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'job_descriptions' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_publish' => 'required|in:Publish,Draft',
        ]);

        try {
            $career = CareerModel::findOrFail($id);

            $career->update([
                'title' => $validated['title'],
                'job_descriptions' => $validated['job_descriptions'],
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'is_publish' => $validated['is_publish'],
            ]);

            return redirect()->route('backend.careers.index')
                ->with('success', 'Career updated successfully');
        } catch (\Exception $e) {
            // Optional: log the error if you want to debug later
            \Log::error('Error updating career: ' . $e->getMessage());

            return back()->withInput()
            ->with('error', 'Something went wrong while updating the career. Please try again.');

        }
    }


    /**
     * Remove the specified resource from storage.
     */



    public function destroy(string $id)
    {
        $career = CareerModel::findOrFail($id);
        $career->update(['is_delete' => true]);

        return redirect()->route('backend.careers.index')->with('success', 'Career deleted successfully!');
    }
}
