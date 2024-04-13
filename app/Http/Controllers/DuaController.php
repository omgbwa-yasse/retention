<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dua;
use App\Models\Rule;
use App\Models\Trigger;
use App\Models\Sort;

class DuaController extends Controller
{
    public function index(Rule $rule)
    {
        $duas = Dua::where('rule_id', $rule->id)->get();
        return view('dua.duaIndex', compact('duas', 'rule'));
    }


    public function create(INT $rule_id)
    {
        $triggers = trigger::all()->sortBy('code');
        $sorts = sort::all()->sortBy('code');
        $rule = Rule::findOrFail($rule_id);
        return view('dua.duaCreate', compact('rule', 'sorts', 'triggers'));
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
        Dua::create($request->all());
        return redirect()->route('rule.dua.index', $rule)->with('success', 'Dua créé avec succès.');
    }

    public function show($id)
    {
        $dua = Dua::findOrFail($id);
        return view('dua.duaShow', compact('dua'));
    }

    public function edit($id)
    {
        $dua = Dua::findOrFail($id);
        // Vous pouvez inclure ici la logique nécessaire pour récupérer les données liées
        return view('dua.duaEdit', compact('dua'));
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

        $dua = Dua::findOrFail($id);
        $dua->update($request->all());
        return redirect()->route('dua.index')->with('success', 'Dua mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $dua = Dua::findOrFail($id);
        $dua->delete();
        return redirect()->route('dua.index')->with('success', 'Dua supprimé avec succès.');
    }
}
