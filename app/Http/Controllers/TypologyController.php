<?php

namespace App\Http\Controllers;
use App\Models\TypologyCategory;
use Illuminate\Http\Request;
use App\Models\Typology;
use Illuminate\Support\Facades\Auth;

class TypologyController extends Controller
{

    // relation between typology and typologyCategory
    public function category()
    {
        return $this->belongsTo(TypologyCategory::class);
    }


    // Index method to display all typology
    public function index()
    {
        $typologies = Typology::paginate(10)->load('category');
        return view('typology.typologyIndex', compact('typologies'));
    }




    // Create method to display the form for creating a new typology
    public function create()
    {
        $categories = TypologyCategory::all();
        return view('typology.typologyCreate', compact('categories'));
    }




    // Store method to store a new typology in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:typologies',
            'description' => 'nullable',
            'category_id' => 'required|exists:typology_categories,id',
        ]);

        $request['user_id'] = Auth::user()->id;

        Typology::create($request->all());

        return redirect()->route('typology.index')->with('success', 'Typology created successfully.');
    }






    // Show method to display a single typology
    public function show(Typology $typology)
    {
        $category = TypologyCategory::find($typology->typology_category_id);
        return view('typology.typologyShow', compact('typology', 'category'));
    }





    // Edit method to display the form for editing a typology
    public function edit(Typology $typology)
    {
        $categories = TypologyCategory::all();
        return view('typology.typologyEdit', compact('typology', 'categories'));
    }





    // Update method to update a typology in the database
    public function update(Request $request, Typology $typology)
    {
        $request->validate([
            'name' => 'required|max:50|unique:typologies,name,' . $typology->id,
            'description' => 'nullable',
            'category_id' => 'required|exists:typology_categories,id',
        ]);

        $typology->update($request->all());

        return redirect()->route('typology.index')->with('success', 'Typology updated successfully.');
    }





    // Destroy method to delete a typology from the database
    public function destroy(Typology $typology)
    {
        $typology->delete();
        return redirect()->route('typology.index')->with('success', 'Typology deleted successfully.');
    }
}


