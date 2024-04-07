<?php

namespace App\Http\Controllers;
use App\Models\Reference;
use App\Models\Category;
use App\Models\ReferenceCategory;
use Illuminate\Http\Request;

class ReferenceCategoryController extends Controller
{



    public function index()
    {
        $categories = ReferenceCategory::all();
        return view('category.index', compact('category'));
    }






    public function create()
    {
        return view('category.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
        ]);

        ReferenceCategory::create($request->all());

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }



    public function edit(ReferenceCategory $category)
    {
        return view('category.edit', compact('category'));
    }


    public function update(Request $request, ReferenceCategory $category)
    {
        $request->validate([
            'title' => 'required|max:50',
        ]);

        $category->update($request->all());

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
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

