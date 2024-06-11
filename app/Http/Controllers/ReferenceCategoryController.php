<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ReferenceCategory;
use Illuminate\Http\Request;

class ReferenceCategoryController extends Controller
{
    public function index()
    {
        $referenceCategories = ReferenceCategory::all();
        return view('referenceCategory.index', compact('referenceCategories'));
    }

    public function create()
    {
        return view('referenceCategory.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:reference_categories',
            'description' => 'required|string',
        ]);

        ReferenceCategory::create($validatedData);

        return redirect()->route('referenceCategory.index')->with('status', 'Reference category created successfully.');
    }

    public function edit(ReferenceCategory $referenceCategory)
    {
        return view('referenceCategory.edit', compact('referenceCategory'));
    }

    public function update(Request $request, ReferenceCategory $referenceCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:reference_categories,name,' . $referenceCategory->id,
            'description' => 'required|string',
        ]);

        $referenceCategory->update($validatedData);

        return redirect()->route('referenceCategory.index')->with('status', 'Reference category updated successfully.');
    }

    public function show(ReferenceCategory $referenceCategory)
    {
        return view('referenceCategory.show', compact('referenceCategory'));
    }

    public function destroy(ReferenceCategory $referenceCategory)
    {
        // Ensure the category isn't linked to any references
        if ($referenceCategory->references()->exists()) {
            return redirect()->route('referenceCategory.index')->with('error', 'Cannot delete category in use.');
        }

        $referenceCategory->delete();

        return redirect()->route('referenceCategory.index')->with('success', 'Reference category deleted successfully.');
    }
}
