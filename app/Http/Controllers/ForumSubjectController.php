<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\ForumSubject;
use Illuminate\Http\Request;

class ForumSubjectController extends Controller
{
    public function index()
    {
        $subjects = ForumSubject::all();
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subject = ForumSubject::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('subject.show', $subject->id)->with('success', 'Subject created successfully!');
    }


//    public function show(ForumSubject $subject)
//    {
//        $posts = $subject::all();
//        return view('subject.show', compact('subject', 'posts'));
//    }
    public function show(ForumSubject $subject)
    {
        // Eager load all necessary relationships in a single query
        $subject->load(['posts' => function ($query) {
            $query->with(['user', 'forumReactionPosts', 'latestReply']);
        }, 'classes']); // Also eager load the 'classes' relationship

        return view('subject.show', [
            'subject' => $subject,
            'posts' => $subject->posts, // Access the already loaded posts
        ]);
    }





    public function edit(ForumSubject $subject)
    {
        $classes = Classification::all()->where('country_id','=',Auth()->user()->getAuthIdentifier());
        return view('subject.edit', compact('subject'),compact('classes'));
    }

    public function update(Request $request, ForumSubject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subject->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('subject.show', $subject->id)->with('success', 'Subject updated successfully!');
    }

    public function destroy(ForumSubject $subject)
    {
        $subject->delete();
        return redirect()->route('subject.index')->with('success', 'Subject deleted successfully!');
    }
}
