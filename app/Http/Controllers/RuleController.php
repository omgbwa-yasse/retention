<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Country;
use App\Models\Articles;
use App\Models\Status;
use App\Models\Trigger;
use App\Models\Sort;
use Illuminate\Support\Facades\Auth;

class RuleController extends Controller
{
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
        $states = Status::all();
        $triggers = Trigger::all();
        $sorts = Sort::all();
        $articles = Articles::all()->where('country_id', '=', Auth::user()->country_id);
        $countries = Country::orderBy('name')->get();
        return view('rule.ruleCreate', compact('countries', 'triggers', 'articles', 'sorts', 'states'));
    }





    // Enregistre un nouvel élément
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:rules|max:10',
            'name' => 'required|unique:rules|max:100',
            'description' => 'nullable',
            'duration' => 'required|max:10',
            'trigger_id' => 'required|exists:triggers,id',
            'sort_id' => 'required|exists:sorts,id',
        ]);

        $countryId = Auth::user()->country_id;
        $country = Country::find($countryId);
        $code = $country->abbr . $request->input('code');

        Rule::create([
            'code' => $code,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'duration' => $request->input('duration'),
            'trigger_id' => $request->input('trigger_id'),
            'sort_id' => $request->input('sort_id'),
            'country_id' => $countryId,
            'user_id' => Auth::user()->id,
            'status_id' => 1
        ]);

        return redirect()->route('rule.index')->with('success', 'Rule created successfully.');
    }




    // Affiche un élément spécifique
    public function show(Rule $rule)
    {
        $rule->load(['country', 'status']);
        return view('rule.ruleShow', compact('rule'));
    }





    // Affiche le formulaire de modification d'un élément
    public function edit(Rule $rule)
    {
        $countries = Country::orderBy('name')->get();
        $triggers = Trigger::orderBy('name')->get();
        $sorts = Sort::orderBy('name')->get();
        return view('rule.ruleEdit', compact('rule', 'countries', 'triggers', 'sorts'));
    }




    // Met à jour un élément spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|max:10',
            'name' => 'required|max:100',
            'description' => 'nullable',
            'duration' => 'required|max:10',
            'trigger_id' => 'required|exists:triggers,id',
            'sort_id' => 'required|exists:sorts,id',
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
            'duration' => $request->input('duration'),
            'trigger_id' => $request->input('trigger_id'),
            'sort_id' => $request->input('sort_id'),
            'country_id' => $countryId,
            'user_id' => Auth::user()->id,
            'status_id' => 1
        ]);

        return redirect()->route('rule.index')->with('success', 'Rule updated successfully.');
    }




    // Supprime un élément spécifique
    public function destroy(Rule $rule)
    {
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
