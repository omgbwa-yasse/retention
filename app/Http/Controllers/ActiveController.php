<?php

namespace App\Http\Controllers;
use App\Models\Active;
use App\Models\Rule;
use App\Models\Trigger;
use App\Models\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveController extends Controller
{
    public function index()
    {
        $actives = Active::with('rule', 'trigger', 'sort')->get();
        return view('active.activeIndex', compact('actives'));
    }


    public function create()
    {
        $rules = Rule::all();
        $triggers = Trigger::all();
        $sorts = Sort::all();
        return view('active.activeCreate', compact('rules', 'triggers', 'sorts'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required|max:50',
            'description' => 'nullable',
            'rule_id' => 'required|exists:rules,id',
            'trigger_id' => 'required|exists:triggers,id',
            'sort_id' => 'required|exists:sorts,id',
        ]);

        $countryId = Auth::user()->country_id;
        $userId = Auth::user()->id;

        $data = $request->all();
        $data['country_id'] = $countryId;
        $data['user_id'] = $userId;

        Active::create($data);

        return redirect()->route('active.index')->with('success', 'Active created successfully.');
    }





    public function edit(Active $active)
    {
        $rules = Rule::pluck('name', 'id');
        $triggers = Trigger::pluck('name', 'id');
        $sorts = Sort::pluck('name', 'id');
        return view('active.activeEdit', compact('active', 'rules', 'triggers', 'sorts'));
    }





    public function update(Request $request, Active $active)
    {
        $request->validate([
            'duration' => 'required|max:50',
            'description' => 'nullable',
            'rule_id' => 'required|exists:rules,id',
            'trigger_id' => 'required|exists:triggers,id',
            'sort_id' => 'required|exists:sorts,id',
        ]);

        $active->update($request->all());

        return redirect()->route('active.index')->with('success', 'Active updated successfully.');
    }







    public function destroy(Active $active)
    {
        $active->delete();

        return redirect()->route('active.index')->with('success', 'Active deleted successfully.');
    }
}
