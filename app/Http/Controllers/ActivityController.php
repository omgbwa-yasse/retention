<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Models\Country;

class ActivityController extends Controller
{
    // Affiche la liste des éléments
    public function index()
    {
        $countryId = Auth::user()->country_id;
        $activities = Classification::whereNotNull('parent_id')->where('country_id', $countryId)->orderBy('code')->get();
        $activities->load('parent');
        $activities->load('rules');
        $activities->load('domaine'); // refuse d'afficher les éléments
        $activities->load('typologies');
        $activities->load('countries');
        return view('activity.activityIndex', compact('activities'));
    }




    // Affiche le formulaire de création d'un élément
    public function create()
    {
        $auth = Auth::user();
        $countryId = Auth::user()->country_id;
        $activities = Classification::where('country_id', $countryId)->orderBy('code')->get();
        return view('activity.activityCreate', compact('activities', 'auth'));
    }





    // Enregistre un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:classifications,id',
            'country_id' => 'required|exists:countries,id',
        ]);

        $parent = Classification::findOrFail($request->parent_id);
        $code = $parent->code . $request->input('code');

        Classification::create([
            'code' => $code,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent_id' => $parent->id,
            'country_id' => $request->country_id,
            'user_id' => Auth::user()->id,
        ]);

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
        $activities = Classification::orderBy('code')->get();
        return view('activity.activityEdit', compact('activity', 'activities'));
    }




    // Met à jour un élément spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:classifications,id'
        ]);

        $item = Classification::findOrFail($id);
        $item->code = $request->input('code');
        $item->name = $request->input('name');
        $item->parent_id = $request->input('parent_id');
        $item->save();

        return redirect()->route('activity.index')->with('success', 'Item updated successfully.');
    }




    public function destroy($id)
    {
        $classification = Classification::findOrFail($id);

        if ($classification->children->isNotEmpty()) {
            return back()->with('error', 'Impossible de supprimer cette classification. Elle a des enfants. Veuillez supprimer les enfants d\'abord.');
        }

        $classification->delete();

        return redirect()->route('activity.index')->with('success', 'Élément supprimé avec succès.');
    }



}
