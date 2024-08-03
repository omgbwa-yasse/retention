<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Classification;
use App\Models\RuleClassification;

class RuleClassificationController extends Controller
{
    // Afficher toutes les règles avec leurs classifications
    public function index()
    {
        $rules = Rule::with('classifications')->get();
        return view('ruleClassification.ruleClassificationIndex', compact('rules'));
    }

    // Afficher le formulaire pour créer une nouvelle relation
    public function create(INT $rule_id)
    {
        $rule = Rule::findOrFail($rule_id);
        $classifications = Classification::all();
        return view('ruleClassification.ruleClassificationCreate', compact('classifications', 'rule'));
    }

    // Enregistrer la nouvelle relation
    public function store(Request $request)
    {
        $ruleClassification = new RuleClassification();
        $ruleClassification->rule_id = $request->input('rule_id');
        $ruleClassification->classification_id = $request->input('classification_id');
        $ruleClassification->save();

        return redirect()->route('rule.classification.ruleClassificationIndex')->with('success', 'Relation ajoutée avec succès!');
    }

    // Afficher le formulaire pour éditer une relation existante
    public function edit($rule_id, $classification_id)
    {
        $rule = Rule::findOrFail($rule_id);
        $classification = Classification::findOrFail($classification_id);
        $classifications = Classification::all();
        return view('ruleClassification.ruleClassificationEdit', compact('rule', 'classification', 'classifications'));
    }

    // Mettre à jour la relation existante
    public function update(Request $request, $id)
    {
        $rule = Rule::findOrFail($id);
        $rule->name = $request->input('name');
        $rule->save();
        $rule->classifications()->sync($request->input('classifications'));
        return redirect()->route('rule.classification.ruleClassificationIndex')->with('success', 'Relation mise à jour avec succès!');
    }

    // Supprimer une relation
    public function destroy($id)
    {
        $rule = Rule::findOrFail($id);
        $rule->classifications()->detach();
        $rule->delete();
        return redirect()->route('rule.classification.ruleClassificationIndex')->with('success', 'Relation supprimée avec succès!');
    }
}

