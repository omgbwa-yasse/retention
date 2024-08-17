<?php

namespace App\Http\Controllers;

use App\Models\Trigger;
use Illuminate\Http\Request;

class TriggerController extends Controller
{
    public function index()
    {
        $triggers = Trigger::all();
        return view('triggers.index', compact('triggers'));
    }

    public function create()
    {
        return view('triggers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:triggers,code',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Trigger::create($request->all());

        return redirect()->route('triggers.index')->with('success', 'Trigger created successfully.');
    }

    public function show(Trigger $trigger)
    {
        return view('triggers.show', compact('trigger'));
    }

    public function edit(Trigger $trigger)
    {
        return view('triggers.edit', compact('trigger'));
    }

    public function update(Request $request, Trigger $trigger)
    {
        $request->validate([
            'code' => 'required|unique:triggers,code,' . $trigger->id,
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $trigger->update($request->all());

        return redirect()->route('triggers.index')->with('success', 'Trigger updated successfully.');
    }

    public function destroy(Trigger $trigger)
    {
        $trigger->delete();

        return redirect()->route('triggers.index')->with('success', 'Trigger deleted successfully.');
    }
}
