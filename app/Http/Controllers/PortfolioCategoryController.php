<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PortfolioCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Exclude categories marked as deleted
        $portfoliocategories = PortfolioCategoryModel::where('is_delete', false)->orderBy('created_at', 'asc')->paginate(10);
        return view('backend.portfolioCategories.index', compact('portfoliocategories'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.portfolioCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate first — Laravel will automatically redirect back with errors
        $request->validate([
            'category' => [
                'required',
                'string',
                'max:255',
                Rule::unique('portfolio_categories', 'name')->where(function ($query) {
                    $query->where('is_delete', false);
                }),
            ],
            'is_publish' => 'required|in:Publish,Draft',
        ], [
            'category.unique' => 'This category name already exists.',
        ]);

        try {
            PortfolioCategoryModel::create([
                'name' => $request->category,
                'is_publish' => $request->is_publish,
                'is_delete' => false, // New categories are not deleted
            ]);

            return redirect()->route('backend.portfolioCategories.index')
                ->with('success', 'Portfolio Category created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error creating portfolio category: ' . $e->getMessage());
            return redirect()->back()->withInput()
                ->with('error', 'An error occurred while creating the portfolio category.');
        }
    }



    public function edit(string $id)
    {
        $portfoliocategory = PortfolioCategoryModel::findOrFail($id);
        return view('backend.portfolioCategories.edit', compact('portfoliocategory'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, string $id)
    {
        $portfoliocategory = PortfolioCategoryModel::findOrFail($id);

        $request->validate([
            'category' => [
                'required',
                'string',
                'max:255',
                Rule::unique('portfolio_categories', 'name')
                    ->ignore($portfoliocategory->id)
                    ->where(function ($query) {
                        $query->where('is_delete', false);
                    }),
            ],
            'is_publish' => 'required|in:Publish,Draft',
        ], [
            'category.unique' => 'This category name already exists.',
        ]);

        try {
            $portfoliocategory->update([
                'name' => $request->category,
                'is_publish' => $request->is_publish,
            ]);

            return redirect()->route('backend.portfolioCategories.index')
                ->with('success', 'Portfolio Category updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error updating portfolio category: ' . $e->getMessage());

            return redirect()->back()->withInput()
                ->with('error', 'An error occurred while updating the portfolio category.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the category
        $portfoliocategory = PortfolioCategoryModel::findOrFail($id);

        // Set the 'is_delete' flag to true (soft delete)
        $portfoliocategory->is_delete = true;
        $portfoliocategory->save();

        // Redirect back with success message
        return redirect()->route('backend.portfolioCategories.index')->with('success', 'Portfolio Category deleted successfully.');
    }

}
