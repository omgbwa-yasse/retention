<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;
use App\Models\Mission;



class MissionController extends Controller
{
    // Affiche la liste des éléments
    public function index()
    {
        $items = Classification::all();
        return view('mission.index', compact('items'));
    }



    // Affiche le formulaire de création d'un élément
    public function create()
    {
        return view('mission.create');
    }




    // Enregistre un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'cote' => 'required',
            'title' => 'required',
            'parent_id' => 'nullable|exists:your_table,id',
        ]);

        Classification::create($request->all());

        return redirect()->route('classification.index')->with('success', 'Item created successfully.');
    }




    // Affiche un élément spécifique
    public function show($id)
    {
        $item = Classification::findOrFail($id);
        return view('mission.show', compact('item'));
    }




    // Affiche le formulaire de modification d'un élément
    public function edit($id)
    {
        $classification = Classification::findOrFail($id);
        return view('update', compact('classification'));
    }




    // Met à jour un élément spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'cote' => 'required',
            'title' => 'required',
            'parent_id' => 'nullable|exists:classification,id',
        ]);

        $item = Classification::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('classification.index')->with('success', 'Item updated successfully.');
    }




    // Supprime un élément spécifique
    public function destroy($id)
    {
        $item = Classification::findOrFail($id);
        $item->delete();

        return redirect()->route('classification.index')->with('success', 'Item deleted successfully.');
    }
}

