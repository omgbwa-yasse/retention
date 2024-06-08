<?php

namespace App\Http\Controllers;
use App\Models\Reference;
use App\Models\Category;
use App\Models\ReferenceCategory;
use Illuminate\Http\Request;

class ReferenceCategoryController extends Controller
{



    public function create()
    {
        return view('setting.referenceCategory.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:referenceCategory',
            'description' => 'required|string',
        ]);

        ReferenceCategory::create($validatedData);

        return redirect()->route('referenceCategory.index')->with('status', 'Reference category created successfully.');
    }

    public function edit(ReferenceCategory $referenceCategory)
    {
        return view('setting.referenceCategory.edit', compact('referenceCategory'));
    }

    public function update(Request $request, ReferenceCategory $referenceCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:referenceCategory,name,' . $referenceCategory->id,
            'description' => 'required|string',
        ]);

        $referenceCategory->update($validatedData);

        return redirect()->route('referenceCategory.index')->with('status', 'Reference category updated successfully.');
    }






    public function show($id)
    {
        $category = ReferenceCategory::findOrFail($id);
        return view('category.categoryShow', compact('category'));
    }

    public function destroy(ReferenceCategory $category)
    {
        if ($category->references->count() > 0) {
            return redirect()->route('category.index')->with('error', 'Category cannot be deleted because it is in use.');
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }

}

