<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
{
    public function index()
    {
        $answers = ForumPost::all();
        $subjects = ForumSubject::with('latestPost')->get(); // Eager load latestPost

        return view('subject.post.index', compact('subjects', 'answers'));
    }


    public function show(ForumPost $post)
    {
        return view('subject.post.show', compact('post'));
    }




    public function create(ForumSubject $subject)
    {
        return view('subject.post.create', compact('subject'));
    }




    public function store(Request $request, ForumSubject $subject)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new ForumPost($validatedData);
        $post->user_id = Auth::id();
        $post->subject_id = $subject->id;

        if ($request->has('parent_id')) {
            $post->parent_id = $request->input('parent_id');
        }

        $post->save();

        return redirect()->route('subject.show', $subject)->with('success', 'Post created successfully.'); // Rediriger vers la page du sujet après la création
    }



    public function edit(ForumPost $post)
    {
        return view('subject.post.edit', compact('post'));
    }



    public function update(Request $request, ForumPost $post)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validatedData);

        return redirect()->route('subject.show', $post->subject)->with('success', 'Post updated successfully.'); // Rediriger vers la page du sujet après la mise à jour
    }

    public function reply(Request $request, ForumSubject $subject, ForumPost $post)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $reply = new ForumPost([
            'name' => $validatedData['name'],
            'content' => $validatedData['content'],
            'user_id' => auth()->id(),
            'subject_id' => $subject->id,
            'parent_id' => $post->id, // Set the parent post ID
        ]);

        $reply->save();

        return redirect()->route('subject.show', $subject)->with('success', 'Reply created successfully!');
    }



    public function destroy(ForumPost $post, ForumSubject $subject)
    {
        $post->delete();
        return redirect()->route('subjects.show', $subject)->with('success', 'Post deleted successfully.'); // Rediriger vers la page du sujet après la suppression
    }

}
