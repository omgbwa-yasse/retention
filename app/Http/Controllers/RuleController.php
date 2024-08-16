<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Country;
use App\Models\Articles;
use App\Models\status;
use App\Models\Active;
use App\Models\Dua;
use App\Models\Dul;
use App\Models\Trigger;
use App\Models\Sort;
use App\Models\RuleActive;
use App\Models\RuleDua;
use App\Models\RuleDul;
use Illuminate\Support\Facades\Auth;

class RuleController extends Controller
{
    // Affiche la liste des éléments
//    public function index()
//    {
//        $rules = Rule::with(['actives', 'duas', 'duls', 'countries', 'articles', 'classifications', 'baskets', 'status'])->get();
//        return view('rule.ruleIndex', compact('rules'));
//    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $rules = Rule::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('rule.ruleIndex', compact('rules'));
    }
    // Affiche le formulaire de création d'un élément
    public function create()
    {
        $states = status::all();
        $triggers = trigger::all();
        $sorts = Sort::all();
        $actives = Active::all();
        $articles = Articles ::all()->where('country_id','=',Auth::user()->country_id);
        $countries = country::orderBy('name')->get();
        return view('rule.ruleCreate', compact('countries','triggers','actives','articles','countries','sorts','states'));
    }



    // Enregistre un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'active_duration' => 'required',
            'active_trigger' => 'required',
            'active_sort' => 'required',
            'dua_duration' => 'required',
            'dua_trigger' => 'required',
            'dua_sort' => 'required',
            'dul_duration' => 'required',
            'dul_trigger' => 'required',
            'dul_sort' => 'required'
        ]);

        $countryId = Auth::user()->country_id;
        $country = Country::find($countryId);
        $code = $country->abbr . $request->input('code');

        $rule = Rule::create([
            'code' => $code,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'country_id' => $countryId,
            'user_id' => Auth::user()->id,
            'status_id' => 1
        ]);


        $ruleId = $rule->id;
        Active::create([
            'duration' => $request->input('active_duration'),
            'description' => $request->input('active_description'),
            'trigger_id' => $request->input('active_trigger'),
            'sort_id' => $request->input('active_sort'),
            'rule_id' => $ruleId,
            'country_id' => $countryId,
            'user_id' => Auth::user()->id
        ]);

        Dua::create([
            'duration' => $request->input('dua_duration'),
            'description' => $request->input('dua_description'),
            'trigger_id' => $request->input('dua_trigger'),
            'sort_id' => $request->input('dua_sort'),
            'rule_id' => $ruleId,
            'country_id' => $countryId,
            'user_id' => Auth::user()->id
        ]);

        Dul::create([
            'duration' => $request->input('dul_duration'),
            'description' => $request->input('dul_description'),
            'trigger_id' => $request->input('dul_trigger'),
            'sort_id' => $request->input('dul_sort'),
            'rule_id' => $ruleId,
            'country_id' => $countryId,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('rule.index')->with('success', 'Rule created successfully.');
    }







    // Affiche un élément spécifique
    public function show(Rule $rule)
    {
        $rule->load('countries')->load('actives')->load('duls')->load('classifications')->load('status');
        return view('rule.ruleShow', compact('rule'));
    }





    // Affiche le formulaire de modification d'un élément
    public function edit(Rule $rule)
    {
        $countries = Country::orderBy('name')->get();
        $triggers = Trigger::orderBy('name')->get();
        $sorts = Sort::orderBy('name')->get();
        $rule->load('Actives','duas','duls');
        return view('rule.ruleEdit', compact('rule', 'countries', 'triggers', 'sorts'));
    }






    // Met à jour un élément spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'active_duration' => 'required',
            'active_trigger' => 'required',
            'active_sort' => 'required',
            'dua_duration' => 'required',
            'dua_trigger' => 'required',
            'dua_sort' => 'required',
            'dul_duration' => 'required',
            'dul_trigger' => 'required',
            'dul_sort' => 'required',
        ]);

        $countryId = Auth::user()->country_id;
        $country = Country::find($countryId);
        $code = $country->abbr . $request->input('code');

        $rule = Rule::find($id);

        if (!$rule) {
            return redirect()->route('rule.index')->with('error', 'Rule not found.');
        }

        $rule->update([
            'code' => $code,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'country_id' => $countryId,
            'user_id' => Auth::user()->id,
            'status_id' => 1
        ]);

        Active::where('rule_id', $id)
              ->update([
                  'duration' => $request->input('active_duration'),
                  'description' => $request->input('active_description'),
                  'trigger_id' => $request->input('active_trigger'),
                  'sort_id' => $request->input('active_sort'),
                  'country_id' => $countryId,
                  'user_id' => Auth::user()->id
              ]);

        Dua::where('rule_id', $id)
           ->update([
               'duration' => $request->input('dua_duration'),
               'description' => $request->input('dua_description'),
               'trigger_id' => $request->input('dua_trigger'),
               'sort_id' => $request->input('dua_sort'),
               'country_id' => $countryId,
               'user_id' => Auth::user()->id
           ]);

        Dul::where('rule_id', $id)
           ->update([
               'duration' => $request->input('dul_duration'),
               'description' => $request->input('dul_description'),
               'trigger_id' => $request->input('dul_trigger'),
               'sort_id' => $request->input('dul_sort'),
               'country_id' => $countryId,
               'user_id' => Auth::user()->id
           ]);

        return redirect()->route('rule.index')->with('success', 'Rule updated successfully.');
    }




    // Supprime un élément spécifique
    public function destroy(Rule $rule)
    {
        $active = Active::where('rule_id', $rule->id)->get();
        foreach ($active as $a) {
            $a->delete();
        }

        $dua = Dua::where('rule_id', $rule->id)->get();
        foreach ($dua as $d) {
            $d->delete();
        }

        $dul = Dul::where('rule_id', $rule->id)->get();
        foreach ($dul as $d) {
            $d->delete();
        }

        $rule->delete();

        return redirect()->route('rule.index')->with('success', 'Rule deleted successfully.');
    }
    public function export()
    {
        $rules = Rule::with('status')->get();

        $pdf = PDF::loadView('rule.pdf', compact('rules'));

        return $pdf->download('regles_de_conservation.pdf');
    }



}
