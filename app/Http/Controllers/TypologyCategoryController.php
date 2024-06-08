<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TypologyCategory;
use Illuminate\Http\Request;

class TypologyCategoryController extends Controller
{
    public function create()
    {
        $typologyCategories = TypologyCategory::all();
        return view('setting.typologyCategory.create', compact('typologyCategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:typologyCategory',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:typologyCategory,id',
        ]);

        TypologyCategory::create($validatedData);

        return redirect()->route('typologyCategory.index')->with('status', 'Typology category created successfully.');
    }

    public function edit(TypologyCategory $typologyCategory)
    {
        $typologyCategories = TypologyCategory::all();
        return view('setting.typologyCategory.edit', compact('typologyCategory', 'typologyCategories'));
    }

    public function update(Request $request, TypologyCategory $typologyCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:typologyCategory,name,' . $typologyCategory->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:typologyCategory,id',
        ]);

        $typologyCategory->update($validatedData);

        return redirect()->route('typologyCategory.index')->with('status', 'Typology category updated successfully.');
    }

    public function index()
    {
        $typologyCategories = TypologyCategory::with('parent')->get();
        return view('setting.typologyCategory.index', compact('typologyCategories'));
    }
}
