<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function create()
    {
        return view('settings.countries.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'abbr' => 'required|string|max:10|unique:countries',
            'name' => 'required|string|max:100|unique:countries',
        ]);

        Country::create($validatedData);

        return redirect()->route('countries.index')->with('status', 'Country created successfully.');
    }

    public function edit(Country $country)
    {
        return view('settings.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $validatedData = $request->validate([
            'abbr' => 'required|string|max:10|unique:countries,abbr,' . $country->id,
            'name' => 'required|string|max:100|unique:countries,name,' . $country->id,
        ]);

        $country->update($validatedData);

        return redirect()->route('countries.index')->with('status', 'Country updated successfully.');
    }

    public function index()
    {
        $countries = Country::all();
        return view('settings.countries.index', compact('countries'));
    }
}
