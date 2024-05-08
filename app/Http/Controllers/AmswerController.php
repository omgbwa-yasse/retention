<?php

namespace App\Http\Controllers;

use App\Models\Amswer;
use App\Models\Subject;
use Illuminate\Http\Request;

class AmswerController extends Controller
{
    public function index()
    {
        $amswer = Amswer::with('user')->latest()->get();
        return view('forum.amswer.index', compact('amswer'));
    }

    public function create(Subject $subject)
    {
        return view('forum.amswer.create', compact('subject'));
    }




    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'parent_id' => 'nullable|integer',
        ]);

            $subject = subject::findOrFail($id);
            $answer = new Amswer;
            $answer->name = $request->input('name');
            $answer->subject_id = $subject->id;
            if( $request->input('parent_id')){ $answer->parent_id = $request->input('parent_id'); }
            $answer->user_id = auth()->id();
            $answer->save();

            return redirect()->route('subjects.show', $subject->id)->with('success', 'Answer created successfully.');
        }




    public function show(Amswer $Amswer)
    {
        return view('forum.amswer.show', compact('Amswer'));
    }




    public function edit(Amswer $Amswer)
    {
        return view('forum.amswer.edit', compact('Amswer'));
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


