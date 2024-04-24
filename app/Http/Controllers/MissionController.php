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
        $items = Classification::whereNull('parent_id')->orderBy('code')->get();
        $items->load('children');
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
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:classification,id',
        ]);

        Classification::create($request->all());

        return redirect()->route('mission.index')->with('success', 'Item created successfully.');
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
        $mission = Classification::findOrFail($id);
        $items = Classification::all();
        return view('mission.edit', compact('mission', 'items'));
    }




    // Met à jour un élément spécifique

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);


        $item = Classification::findOrFail($id);
        $item->code = $request->input('code');
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->save();

        return redirect()->route('mission.index')->with('success', 'Item updated successfully.');
    }




    // Supprime un élément spécifique
    public function destroy($id)
    {
        $item = Classification::findOrFail($id);
        if ($item->children->isEmpty()) {
            $item->delete();
            return redirect()->route('mission.index')->with('success', 'Item deleted successfully.');
        } else {
            return redirect()->route('mission.index')->with('error', 'Cannot delete item with children.');
        }

    }
}

