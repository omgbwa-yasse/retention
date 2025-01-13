<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\ForumPost;
use App\Models\ForumSubject;
use Illuminate\Http\Request;

class ForumSubjectController extends Controller
{
    public function index()
    {
        $subjects = ForumSubject::with('user')  // Chargement eager de la relation user si elle existe
        ->orderBy('created_at', 'desc')     // Les plus récents d'abord
        ->paginate(10);
        return view('subject.index', compact('subjects'));
    }
    public function create(Request $request)
    {
        $classId = $request->input('class_id');
        $user = auth()->user(); // Get the authenticated user
        $countryId = $user->country_id; // Assuming the user model has a country_id attribute

        // Fetch classifications where the country_id matches the authenticated user's country_id
        $classes = Classification::where('country_id', $countryId)->get();

        return view('subject.create', compact('classes', 'classId'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'class_id' => 'required', // Validate classification
        ]);

        // Create the subject
        $subject = ForumSubject::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
        ]);

        // Attach the classification to the subject
        $subject->classes()->attach($request->input('class_id'));

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
    public function showPost(ForumSubject $subject, ForumPost $post)
    {
        if ($post) {
            $replies = $post->replies()->get();

            if ($replies->count() > 0) {
                // Do something with the replies...

                return view('subject.post.show', compact('subject', 'post', 'replies'));
            } else {
                // Handle the case where there are no replies...

                $no_replies = "There are no replies for this post.";
                return view('subject.post.show', compact('subject', 'post', 'no_replies'));
            }
        } else {
            // Handle the case where the post was not found...

            $post_not_found = "The post was not found.";
            return view('subject.post.show', compact('subject', 'post_not_found'));
        }
    }


    public function editPost(ForumSubject $subject, ForumPost $post)
    {
        return view('subject.post.edit', compact('subject', 'post'));
    }
    public function updatePost(Request $request,ForumSubject $subject, ForumPost $post)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validatedData);

        return redirect()->route('subject.show', $post->subject)->with('success', 'Post updated successfully.'); // Rediriger vers la page du sujet après la mise à jour
    }


    public function destroyPost(ForumSubject $subject, ForumPost $post)
    {
        $post->delete();

        return redirect()->route('subject.show', $subject)->with('success', 'Post deleted successfully.');
    }

}
