<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class MissionController extends Controller
{
    // Affiche la liste des éléments
    public function index()
    {
        $countryId = Auth::user()->country_id;
        $items = Classification::whereNull('parent_id')->where('country_id', $countryId)->orderBy('code')->get();
        $items->load('children');
        $country = Country ::find($countryId);
        return view('mission.index', compact('items','country'));
    }



    // Affiche le formulaire de création d'un élément
    public function create()
    {
        $auth = Auth::user();
        return view('mission.create', compact('auth'));
    }





// Enregistrement des missions
 // Enregistrement des missions
 public function store(Request $request)
 {
     $validatedData = $request->validate([
         'code' => 'required|max:10',
         'name' => 'required|max:255',
         'description' => 'required',
         'country_id' => 'required|exists:countries,id',
     ]);

     $country = Country::find($validatedData['country_id']);
     $abbreviation = $country ? $country->abbr : '';

     $code = $abbreviation . '-' . $validatedData['code'];

     $classification = Classification::create([
         'code' => $code,
         'name' => $validatedData['name'],
         'description' => $validatedData['description'],
         'country_id' => $validatedData['country_id'],
         'user_id' => Auth::user()->id,
     ]);

     return redirect()->route('mission.index')->with('success', 'Activité enregistrée avec succès.');
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

        return redirect()->route('mission.index')->with('success', 'Mission modifiée avec succès.');
    }




    // Supprime un élément spécifique
    public function destroy($id)
    {
        $item = Classification::findOrFail($id);
        if ($item->children->isEmpty()) {
            $item->delete();
            return redirect()->route('mission.index')->with('success', 'Mission supprimée avec succès.');
        } else {
            return redirect()->route('mission.index')->with('error', 'Cette mission ne peut-être supprimée car elle a des activités filles.');
        }

    }
}

