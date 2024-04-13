<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dul;
use App\Models\Rule;
use App\Models\Trigger;
use App\Models\Sort;

class DulController extends Controller
{
    public function index(rule $rule)
    {
        $duls = Dul::where('rule_id', $rule->id)->get();
        return view('dul.dulIndex', compact('duls', 'rule'));
    }


    public function create(INT $rule_id)
    {
        $triggers = trigger::all()->sortBy('code');
        $sorts = sort::all()->sortBy('code');
        $rule = Rule::findOrFail($rule_id);
        return view('dul.dulCreate', compact('rule', 'sorts', 'triggers'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required|string|max:50',
            'description' => 'nullable|string',
            'rule_id' => 'required|exists:rules,id',
            'trigger_id' => 'required|exists:triggers,id',
            'sort_id' => 'required|exists:sorts,id',
        ]);
        $rule = rule::findOrfail($request->input('rule_id'));
        Dul::create($request->all());
        return redirect()->route('rule.dul.index', $rule)->with('success', 'Dul créé avec succès.');
    }

    public function show($id)
    {
        $dul = Dul::findOrFail($id);
        return view('dul.dulShow', compact('dul'));
    }

    public function edit($id)
    {
        $dul = Dul::findOrFail($id);
        // Vous pouvez inclure ici la logique nécessaire pour récupérer les données liées
        return view('dul.dulEdit', compact('dul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'duration' => 'required|string|max:50',
            'description' => 'nullable|string',
            'rule_id' => 'required|exists:rules,id',
            'trigger_id' => 'required|exists:triggers,id',
            'sort_id' => 'required|exists:sorts,id',
        ]);

        $dul = Dul::findOrFail($id);
        $dul->update($request->all());
        return redirect()->route('dul.index')->with('success', 'Dul mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $dul = Dul::findOrFail($id);
        $dul->delete();
        return redirect()->route('dul.index')->with('success', 'Dul supprimé avec succès.');
    }
}
