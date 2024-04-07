<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use App\Models\ReferenceCategory;
use App\Models\Ressource;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{

    public function index()
    {
        $category = ReferenceCategory::all();
        $reference = Reference::with('category', 'ressource')->get();
        return view('reference.referenceIndex', compact('category', 'reference'));
    }

    public function create()
    {
        $category = ReferenceCategory::all();
        $ressource = Ressource::all();
        return view('reference.referenceCreate', compact('category', 'ressource'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50|unique:reference',
            'description' => 'nullable|max:500',
            'category_id' => 'required|exists:reference_category,id',
            'ressources' => 'required|array',
            'ressources.*' => 'exists:ressource,id',
        ]);

        $reference = Reference::create($request->only(['title', 'description', 'category_id']));
        $reference->ressources()->attach($request->input('ressources'));

        return redirect()->route('reference.index')->with('success', 'Référence créée avec succès.');
    }

    public function edit(Reference $reference)
    {
        $category = ReferenceCategory::all();
        $ressources = Ressource::all();
        $referenceRessources = $reference->ressources->pluck('id')->toArray();
        return view('reference.referenceEdit', compact('category', 'reference', 'ressource', 'referenceRessources'));
    }

    public function update(Request $request, Reference $reference)
    {
        $request->validate([
            'title' => 'required|max:50|unique:reference,title,' . $reference->id,
            'description' => 'nullable|max:500',
            'category_id' => 'required|exists:reference_category,id',
            'ressources' => 'array',
            'ressources.*' => 'exists:ressource,id',
        ]);

        $reference->update($request->only(['title', 'description', 'category_id']));
        $reference->ressources()->sync($request->input('ressource'));

        return redirect()->route('reference.index')->with('success', 'Référence mise à jour avec succès.');
    }

    public function destroy(Reference $reference)
    {
        $reference->delete();

        return redirect()->route('reference.index')->with('success', 'Référence supprimée avec succès.');
    }
}
