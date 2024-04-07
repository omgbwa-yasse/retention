<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Classification;


class ActivityController extends Controller
{
    // Affiche la liste des éléments
    public function index()
    {
        $items = Classification::whereNotNull('parent_id')->orderByDesc('id')->get();
        return view('activity.activityIndex', compact('items'));
    }




    // Affiche le formulaire de création d'un élément
    public function create()
    {
        $items = Classification::orderByDesc('id')->get();
        return view('activity.activityCreate', compact('items'));

    }




    // Enregistre un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'cote' => 'required',
            'title' => 'required',
            'parent_id' => 'nullable|exists:classification,id',
        ]);

        Classification::create($request->all());

        return redirect()->route('activity.index')->with('success', 'Item created successfully.');
    }




    // Affiche un élément spécifique
    public function show($id)
    {
        $item = Classification::findOrFail($id);
        return view('activity.activityShow', compact('item'));
    }




    // Affiche le formulaire de modification d'un élément

    public function edit($id)
    {
        $activity = Classification::findOrFail($id);
        $items = Classification::all();
        return view('activity.activityEdit', compact('activity', 'items'));
    }




    // Met à jour un élément spécifique

    public function update(Request $request, $id)
    {
        $request->validate([
            'cote' => 'required',
            'title' => 'required',
            'parent_id' => 'required'
        ]);

        $item = Classification::findOrFail($id);
        $item->cote = $request->input('cote');
        $item->title = $request->input('title');
        $item->title = $request->input('parent_id');
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
