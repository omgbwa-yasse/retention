<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function create()
    {
        return view('setting.country.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'abbr' => 'required|string|max:10|unique:country',
            'name' => 'required|string|max:100|unique:country',
        ]);

        Country::create($validatedData);

        return redirect()->route('country.index')->with('status', 'Country created successfully.');
    }

    public function edit(Country $country)
    {
        return view('setting.country.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $validatedData = $request->validate([
            'abbr' => 'required|string|max:10|unique:country,abbr,' . $country->id,
            'name' => 'required|string|max:100|unique:country,name,' . $country->id,
        ]);

        $country->update($validatedData);

        return redirect()->route('country.index')->with('status', 'Country updated successfully.');
    }

    public function index()
    {
        $country = Country::all();
        return view('setting.country.index', compact('country'));
    }
}
