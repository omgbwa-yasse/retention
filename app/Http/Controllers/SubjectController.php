<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\SubjectClassification;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('user')->latest()->get();
        $subjects->load('classes');
        return view('subject.index', compact('subjects'));
    }


    public function basket()
    {
        return view('subject.index', compact('subjects'));
    }


    public function create()
    {
        $classes = Classification::all()->where('country_id','=',Auth()->user()->getAuthIdentifier());
        return view('subject.create', compact('classes'));
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


        $classification = SubjectClassification::firstOrCreate(
            ['classification_id' => $request->class_id, 'subject_id' => $subject->id],
            ['create_at' => now(), 'update_at' => now()]
        );

        return redirect()->route('subject.index')->with('success', 'Subject created successfully.');
    }





    public function show(Subject $subject)
    {
        return view('subject.show', compact('subject'));
    }





    public function edit(Subject $subject)
    {
        $subject->load('classes');
        $classes = classification::all();
        return view('Subject.edit', compact('subject','classes'));
    }




    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'name' => 'required|max:100|unique:forum_subjects,name,' . $subject->id,
            'description' => 'nullable',
        ]);

        $subject->update([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        $classification = SubjectClassification::firstOrCreate(
            ['classification_id' => $request->class_id, 'subject_id' => $subject->id],
            ['create_at' => now(), 'update_at' => now()]
        );

        return redirect()->route('subject.index')->with('success', 'Subject updated successfully.');
    }





    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subject.index')->with('success', 'Subject deleted successfully.');
    }
}
