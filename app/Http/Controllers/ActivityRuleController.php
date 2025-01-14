<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityRule;
use App\Models\Rule;
use Illuminate\Support\Facades\Auth;

class ActivityRuleController extends Controller
{
    public function index(Activity $activity)
    {
        $activity->load('rules');
//        dd($activity);
        return view('activity.rule.index', compact('activity'));
    }

    public function create(Activity $activity)
    {
        $rules = Rule::where('country_id', '=', auth()->user()->country_id)->get();
        return view('activity.rule.create', compact('activity', 'rules'));
    }

    public function store(Request $request, Activity $activity)
    {
        $request['classification_id'] = $activity->id;
        $request->validate([
            'classification_id' => 'required|exists:activities,id',
            'rule_id' => 'required|exists:rules,id',
        ]);
        ActivityRule::create($request->all());

        return redirect()->route('activity.rule.index', compact('activity'))->with('success', 'ActivityRule créé avec succès.');
    }



    public function show(ActivityRule $activityRule)
    {
        return view('activity.rule.show', compact('activityRule'));
    }




    public function edit(ActivityRule $activityRule)
    {
        $activities = Activity::all();
        $rules = Rule::all();
        return view('activity.rule.edit', compact('activityRule', 'activities', 'rules'));
    }




    public function update(Request $request, ActivityRule $activityRule)
    {
        $request->validate([
            'classification_id' => 'sometimes|required|exists:activities,id',
            'rule_id' => 'sometimes|required|exists:rules,id',
        ]);

        $activityRule->update($request->all());

        return redirect()->route('activity.rule.index')->with('success', 'ActivityRule mis à jour avec succès.');
    }



    public function destroy(ActivityRule $activityRule)
    {
        $activityRule->delete();
        return redirect()->route('activity.rule.index')->with('success', 'ActivityRule supprimé avec succès.');
    }
}

