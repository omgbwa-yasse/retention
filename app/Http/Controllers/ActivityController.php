<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classification;

class ActivityController extends Controller
{
    // Affiche la liste des éléments
    public function index()
    {
        $activities = Classification::whereNotNull('parent_id')->orderBy('cote')->get();
        return view('activity.activityIndex', compact('activities'));
    }

    // Affiche le formulaire de création d'un élément
    public function create()
    {
        $activities = Classification::orderBy('cote')->get();
        return view('activity.activityCreate', compact('activities'));
    }


    // Enregistre un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'cote' => 'required',
            'name' => 'required',
            'parent_id' => 'nullable|exists:classifications,id',
        ]);

        Classification::create($request->all());
        return redirect()->route('activity.index')->with('success', 'Item created successfully.');
    }

    // Affiche un élément spécifique
    public function show($id)
    {
        $activity = Classification::findOrFail($id);
        $parentName = $activity->parent ? $activity->parent->name : 'No parent';
        return view('activity.activityShow', compact('activity', 'parentName'));
    }

    // Affiche le formulaire de modification d'un élément
    public function edit($id)
    {
        $activity = Classification::findOrFail($id);
        $activities = Classification::orderBy('cote')->get();
        return view('activity.activityEdit', compact('activity', 'activities'));
    }

    // Met à jour un élément spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'cote' => 'required',
            'name' => 'required',
            'parent_id' => 'nullable|exists:classifications,id'
        ]);

        $item = Classification::findOrFail($id);
        $item->cote = $request->input('cote');
        $item->name = $request->input('name');
        $item->parent_id = $request->input('parent_id');
        $item->save();

        return redirect()->route('activity.index')->with('success', 'Item updated successfully.');
    }

    // Supprime un élément spécifique
    public function destroy($id)
    {
        $item = Classification::findOrFail($id);
        $item->delete();
        return redirect()->route('activity.index')->with('success', 'Item deleted successfully.');
    }
}
