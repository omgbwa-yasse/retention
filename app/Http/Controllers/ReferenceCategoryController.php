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
        return view('category.categoryIndex', compact('category'));
    }







    public function show($id)
    {
        $category = ReferenceCategory::findOrFail($id);
        return view('category.categoryShow', compact('category'));
    }






    public function create()
    {
        return view('category.categorycreate');
    }









    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
        ]);

        ReferenceCategory::create($request->all());
        return redirect()->route('reference-category.index')->with('success', 'Category created successfully.');
    }









    public function edit(INT $id)
    {
        $category = ReferenceCategory::findOrFail($id);
        return view('category.categoryEdit', compact('category'));
    }









    public function update(Request $request, ReferenceCategory $category)
    {
        dd($request);
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required'
        ]);

        $category->update($request->all());

        return redirect()->route('category.categoryIndex')->with('success', 'Category updated successfully.');
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

