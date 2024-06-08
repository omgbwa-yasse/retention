<?php

namespace App\Http\Controllers; // Correct namespace

use App\Http\Controllers\Controller;
use App\Models\ReferenceCategory;
use Illuminate\Http\Request;

class ReferenceCategoryController extends Controller
{
    public function index()
    {
        $referenceCategories = ReferenceCategory::all();
        return view('settings.reference_categories.index', compact('referenceCategories'));
    }

    public function create()
    {
        return view('settings.reference_categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:reference_categories', // Corrected table name
            'description' => 'required|string',
        ]);

        ReferenceCategory::create($validatedData);

        return redirect()->route('setting.referenceCategory.index')->with('status', 'Reference category created successfully.'); // Corrected route name
    }

    public function edit(ReferenceCategory $referenceCategory)
    {
        return view('settings.reference_categories.edit', compact('referenceCategory'));
    }

    public function update(Request $request, ReferenceCategory $referenceCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:reference_categories,name,' . $referenceCategory->id, // Corrected table name and unique rule
            'description' => 'required|string',
        ]);

        $referenceCategory->update($validatedData);

        return redirect()->route('setting.referenceCategory.index')->with('status', 'Reference category updated successfully.'); // Corrected route name
    }

    public function show(ReferenceCategory $referenceCategory)
    {
        return view('settings.reference_categories.show', compact('referenceCategory')); // Corrected view name and model instance
    }

    public function destroy(ReferenceCategory $referenceCategory)
    {
        // Ensure the category isn't linked to any references
        if ($referenceCategory->references()->exists()) {
            return redirect()->route('setting.referenceCategory.index')->with('error', 'Cannot delete category in use.'); // Corrected route name
        }

        $referenceCategory->delete();

        return redirect()->route('setting.referenceCategory.index')->with('success', 'Reference category deleted successfully.'); // Corrected route name
    }
}
