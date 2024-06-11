<?php

namespace App\Http\Controllers;

use App\Models\TypologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypologyCategoryController extends Controller
{
    public function index()
    {
        $typologyCategories = TypologyCategory::with('parent')->get();
        return view('typologyCategory.index', compact('typologyCategories'));
    }

    public function create()
    {
        // Consider passing only the necessary categories
        $typologyCategories = TypologyCategory::all();
        return view('typologyCategory.create', compact('typologyCategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:typology_categories',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:typology_categories,id',

        ]);
        $validatedData['user_id'] = Auth::id();
        $typologyCategory = TypologyCategory::create($validatedData);

      

        return redirect()->route('typology_categories.index')->with('status', 'Typology category created successfully.');
    }


    public function edit(TypologyCategory $typologyCategory)
    {
        // Consider passing only the necessary categories
        $typologyCategories = TypologyCategory::all();
        return view('typologyCategory.edit', compact('typologyCategory', 'typologyCategories'));
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
}
