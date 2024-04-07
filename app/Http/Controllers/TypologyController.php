<?php

namespace App\Http\Controllers;
use App\Models\TypologyCategory;
use Illuminate\Http\Request;
use App\Models\Typology;

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
        $typology = Typology::paginate(10);
        return view('typology.typologyIndex', compact('typology'));
    }




    // Create method to display the form for creating a new typology
    public function create()
    {
        $category = TypologyCategory::all();
        return view('typology.typologyCreate', compact('category'));
    }




    // Store method to store a new typology in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50|unique:typology',
            'description' => 'nullable',
            'typology_category_id' => 'required|exists:typology_category,id',
        ]);

        // dump($request->all()); // Si vous voulez vérifier les données envoyées

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
        $category = TypologyCategory::all();
        return view('typology.typologyEdit', compact('typology', 'category'));
    }





    // Update method to update a typology in the database
    public function update(Request $request, Typology $typology)
    {
        $request->validate([
            'title' => 'required|max:50|unique:typology,title,' . $typology->id,
            'description' => 'nullable',
            'typology_category_id' => 'required|exists:typology_category,id',
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


