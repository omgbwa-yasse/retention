<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Country;
use App\Models\Articles;
use App\Models\Status;
use App\Models\Active;
use App\Models\Dua;
use App\Models\Dul;
use App\Models\Trigger;
use App\Models\Sort;
use App\Models\RuleActive;
use App\Models\RuleDua;
use App\Models\RuleDul;
use Illuminate\Support\Facades\Auth;

class CommitteeController extends Controller
{
    // Affiche la liste des éléments
    public function project()
    {
        $rules = Rule::with(['actives', 'duas', 'duls', 'countries', 'articles', 'classifications', 'baskets', 'status'])
            ->where('status_id', '=', 1)
            ->get();
        return view('rule.ruleIndex', compact('rules'));
    }

    public function examining()
    {
        $rules = Rule::with(['actives', 'duas', 'duls', 'countries', 'articles', 'classifications', 'baskets', 'status'])
            ->where('status_id', '=', 2)
            ->paginate(10); // Use paginate instead of get

        return view('rule.ruleIndex', compact('rules'));
    }
    public function approved()
    {
        $rules = Rule::with(['actives', 'duas', 'duls', 'countries', 'articles', 'classifications', 'baskets', 'status'])
            ->where('status_id', '=', 3)
            ->paginate(10); // Use paginate instead of get
        return view('rule.ruleIndex', compact('rules'));
    }

    public function index()
    {
        $rules = Rule::where('country_id', '=', Auth::user()->country_id)->get();
        $rules->load('validator');
        return view('validation.index', compact('rules'));
    }

    public function show(Rule $rule)
    {
        $rule->load('countries')->load('actives')->load('duls')->load('classifications')->load('status');
        return view('committee.show', compact('rule'));
    }

    public function update(Request $request, $id)
    {
        $rule = Rule::findOrFail($id);
        if ($rule->status_id == 1 && ($request->status_id == 2 || $request->status_id == 3)) {
            $rule->update([
                'status_id' => $request->input('status_id'),
                'validated_at' => now(),
                'validated_by' => Auth::id()
            ]);
        } else {
            abort(404);
        }
        return redirect()->route('committee.index')->with('success', 'Activité mise à jour avec succès.');
    }
}

