<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\TypologyCategory;
use Illuminate\Http\Request;

class TypologyCategoryController extends Controller
{
    public function create()
    {
        $typologyCategories = TypologyCategory::all();
        return view('settings.typology_categories.create', compact('typologyCategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:typology_categories',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:typology_categories,id',
        ]);

        TypologyCategory::create($validatedData);

        return redirect()->route('typology_categories.index')->with('status', 'Typology category created successfully.');
    }

    public function edit(TypologyCategory $typologyCategory)
    {
        $typologyCategories = TypologyCategory::all();
        return view('settings.typology_categories.edit', compact('typologyCategory', 'typologyCategories'));
    }

    public function update(Request $request, TypologyCategory $typologyCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:typology_categories,name,' . $typologyCategory->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:typology_categories,id',
        ]);

        $typologyCategory->update($validatedData);

        return redirect()->route('typology_categories.index')->with('status', 'Typology category updated successfully.');
    }

    public function index()
    {
        $typologyCategories = TypologyCategory::with('parent')->get();
        return view('settings.typology_categories.index', compact('typologyCategories'));
    }
}
