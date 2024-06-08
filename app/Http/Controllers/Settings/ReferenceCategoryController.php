<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\ReferenceCategory;
use Illuminate\Http\Request;

class ReferenceCategoryController extends Controller
{
    public function create()
    {
        return view('settings.reference_categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:reference_categories',
            'description' => 'required|string',
        ]);

        ReferenceCategory::create($validatedData);

        return redirect()->route('reference_categories.index')->with('status', 'Reference category created successfully.');
    }

    public function edit(ReferenceCategory $referenceCategory)
    {
        return view('settings.reference_categories.edit', compact('referenceCategory'));
    }

    public function update(Request $request, ReferenceCategory $referenceCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:reference_categories,name,' . $referenceCategory->id,
            'description' => 'required|string',
        ]);

        $referenceCategory->update($validatedData);

        return redirect()->route('reference_categories.index')->with('status', 'Reference category updated successfully.');
    }
}
