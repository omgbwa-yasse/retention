<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index()
    {
        $Countries = country::all();
        return view('country.index', compact('Countries'));
    }






    public function create()
    {
        $countries = country::all();
        return view('country.create', compact('countries'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:500|unique:Countries',
            'description' => 'nullable|string|max:500',
            'category_id' => 'required|exists:country_categories,id',
            'country_id' => 'required|exists:countries,id',
        ]);

        $validatedData['user_id'] = Auth::user()->id;
        $country = country::create($validatedData);
        return redirect()->route('country.index')->with('success', 'Référence créée avec succès');
    }




    public function edit($id)
    {
        $Countries = country::findOrFail($id);
        return view('country.edit', compact('Countries'));
    }






    public function update(Request $request, $id)
    {



        $validatedData = $request->validate([
            'name' => 'required|max:500|unique:Countries,name,'.$id,
            'abbr' => 'nullable|max:500',
        ]);
        $country = country::findOrFail($id);
        $country->update($validatedData);
        return redirect()->route('country.index')->with('success', 'La référence a été mise à jour avec succès.');
    }




    public function destroy(country $country)
    {
        $error = '';

        $country->delete();

        return redirect()->route('country.index')->with('success', 'La référence a été supprimée avec succès.');
    }

}
