<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\State;
use App\Models\RuleActive;
use App\Models\RuleDua;
use App\Models\RuleDul;

class RuleController extends Controller
{
    // Affiche la liste des éléments
    public function index()
    {
        $rules = Rule::with('state')->orderBy('name')->get();
        return view('rule.ruleIndex', compact('rules'));
    }






    // Affiche le formulaire de création d'un élément
    public function create()
    {
        $states = State::orderBy('name')->get();
        return view('rule.ruleCreate', compact('states'));
    }





    // Enregistre un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'state_id' => 'required'
        ]);

        $rule = Rule::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'state_id' => $request->input('state_id')
        ]);

        return redirect()->route('rule.index')->with('success', 'Rule created successfully.');
    }






    // Affiche un élément spécifique
    public function show(Rule $rule)
    {
        $rule->load('state')->load('actives')->load('duls')->load('state');
        return view('rule.ruleShow', compact('rule'));
    }





    // Affiche le formulaire de modification d'un élément
    public function edit(Rule $rule)
    {
        $states = State::orderBy('name')->get();
        return view('rule.ruleEdit', compact('rule', 'states'));
    }







    // Met à jour un élément spécifique
    public function update(Request $request, Rule $rule)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'state_id' => 'required'
        ]);

        $rule->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'state_id' => $request->input('state_id')
        ]);

        return redirect()->route('rule.index')->with('success', 'Rule updated successfully.');
    }





    // Supprime un élément spécifique
    public function destroy(Rule $rule)
    {
        $rule->delete();
        return redirect()->route('rules.index')->with('success', 'Rule deleted successfully.');
    }
}
