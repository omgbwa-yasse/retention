<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Country;
use App\Models\Articles;
use App\Models\RuleActive;
use App\Models\RuleDua;
use App\Models\RuleDul;

class RuleController extends Controller
{
    // Affiche la liste des éléments
    public function index()
    {
        $rules = Rule::all();
        $rules->load('countries');
        return view('rule.ruleIndex', compact('rules'));
    }






    // Affiche le formulaire de création d'un élément
    public function create()
    {
        $countries = country::orderBy('name')->get();
        return view('rule.ruleCreate', compact('countries'));
    }





    // Enregistre un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'country_id' => 'required'
        ]);

        $rule = Rule::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'country_id' => $request->input('country_id')
        ]);

        return redirect()->route('rule.index')->with('success', 'Rule created successfully.');
    }






    // Affiche un élément spécifique
    public function show(Rule $rule)
    {
        $rule->load('countries')->load('actives')->load('duls')->load('classifications');
        return view('rule.ruleShow', compact('rule'));
    }





    // Affiche le formulaire de modification d'un élément
    public function edit(Rule $rule)
    {
        $countrys = Country::orderBy('name')->get();
        return view('rule.ruleEdit', compact('rule', 'country'));
    }







    // Met à jour un élément spécifique
    public function update(Request $request, Rule $rule)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'country_id' => 'required'
        ]);

        $rule->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'country_id' => $request->input('country_id')
        ]);

        return redirect()->route('rule.index')->with('success', 'Rule updated successfully.');
    }





    // Supprime un élément spécifique
    public function destroy(Rule $rule)
    {
        $rule->delete();
        return redirect()->route('rule.index')->with('success', 'Rule deleted successfully.');
    }
}
