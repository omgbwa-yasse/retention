<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dul;
use App\Models\Rule;
use App\Models\Trigger;
use App\Models\Country;
use App\Models\Articles;
use App\Models\Sort;

class DulController extends Controller
{
    public function index($rule_id)
    {
        $duls = Dul::where('rule_id', $rule_id)->get();
        $rule = rule ::findOrFail($rule_id);
        return view('dul.dulIndex', compact('duls', 'rule'));
    }


    public function create(INT $rule_id, country $country)
    {
        $triggers = trigger::all()->sortBy('code');
        $sorts = sort::all()->sortBy('code');
        $rule = Rule::findOrFail($rule_id);
        $articles = articles::get();
        $countries = country::get()->where('name', '=', $country->name);
        return view('dul.dulCreate', compact('rule', 'sorts', 'triggers','articles', 'country'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required|string|max:50',
            'description' => 'nullable|string',
            'rule_id' => 'required|exists:rules,id',
            'trigger_id' => 'required|exists:triggers,id',
            'sort_id' => 'required|exists:sorts,id',
            'country_id' => 'required|exists:countries,id',
        ]);
        $rule = rule::findOrfail($request->input('rule_id'));
        Dul::create($request->all());
        return redirect()->route('rule.dul.index', $rule)->with('success', 'Dul créé avec succès.');
    }

    public function show($rule_id, $id)
    {
        $dul = Dul::findOrFail($id);
        $rule = Rule::findOrFail($rule_id);
        return view('dul.dulShow', compact('rule', 'dul'));
    }

    public function edit($id)
    {
        $dul = Dul::findOrFail($id);
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
