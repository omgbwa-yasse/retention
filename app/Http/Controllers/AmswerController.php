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
        dd($amswer);
        return view('subject.amswer.index', compact('amswer'));
    }

    public function create($id)
    {
        $subject = Subject::find($id);
        return view('subject.amswer.create', compact('subject'));
    }




    public function store(Request $request, subject $subject)
    {
        $request->validate([
            'name' => 'required|max:100',
            'parent_id' => 'nullable|integer',
        ]);
            $answer = new Amswer;
            $answer->name = $request->input('name');
            $answer->subject_id = $subject->id;
            if( $request->input('parent_id')){ $answer->parent_id = $request->input('parent_id'); }
            $answer->user_id = auth()->id();
            $answer->save();
            return redirect()->route('subject.show', $subject)->with('success', 'Answer created successfully.');
        }




    public function show(Amswer $Amswer)
    {
        return view('subject.amswer.show', compact('Amswer'));
    }




    public function edit(Amswer $Amswer)
    {
        return view('subject.amswer.edit', compact('Amswer'));
    }





    public function update(Request $request, Amswer $Amswer)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $Amswer->update([
            'name' => $request->name,
        ]);

        return redirect()->route('subject.show', $Amswer->subject_id)->with('success', 'Amswer updated successfully.');
    }





    public function destroy(Amswer $Amswer)
    {
        $Amswer->delete();
        return redirect()->route('subject.show', $Amswer->subject_id)->with('success', 'Amswer deleted successfully.');
    }
}


