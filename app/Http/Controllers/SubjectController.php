<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('user')->latest()->get();
        return view('forum.Subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('forum.Subject.create');
    }




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:forum_subjects',
            'description' => 'nullable',
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('Subject.index')->with('success', 'Subject created successfully.');
    }





    public function show(Subject $subject)
    {
        return view('forum.Subject.show', compact('subject'));
    }





    public function edit(Subject $subject)
    {
        return view('forum.Subject.edit', compact('subject'));
    }





    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|max:100|unique:forum_subjects,name,' . $subject->id,
            'description' => 'nullable',
        ]);

        $subject->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('Subject.index')->with('success', 'Subject updated successfully.');
    }





    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('Subject.index')->with('success', 'Subject deleted successfully.');
    }
}
