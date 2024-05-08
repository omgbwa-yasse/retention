<?php

namespace App\Http\Controllers;

use App\Models\Amswer;
use App\Models\Subject;
use Illuminate\Http\Request;

class AmswerController extends Controller
{
    public function index()
    {
        $Amswers = Amswer::with('user')->latest()->get();
        return view('forum.Amswers.index', compact('Amswers'));
    }

    public function create(Subject $subject)
    {
        return view('forum.Amswers.create', compact('subject'));
    }

    public function store(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $Amswer = Amswer::create([
            'name' => $request->name,
            'subject_id' => $subject->id,
            'parent_id' => $request->parent_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('subjects.show', $subject->id)->with('success', 'Amswer created successfully.');
    }

    public function show(Amswer $Amswer)
    {
        return view('forum.Amswers.show', compact('Amswer'));
    }

    public function edit(Amswer $Amswer)
    {
        return view('forum.Amswers.edit', compact('Amswer'));
    }

    public function update(Request $request, Amswer $Amswer)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $Amswer->update([
            'name' => $request->name,
        ]);

        return redirect()->route('subjects.show', $Amswer->subject_id)->with('success', 'Amswer updated successfully.');
    }

    public function destroy(Amswer $Amswer)
    {
        $Amswer->delete();
        return redirect()->route('subjects.show', $Amswer->subject_id)->with('success', 'Amswer deleted successfully.');
    }
}


