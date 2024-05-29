<?php

namespace App\Http\Controllers;

use App\Models\ForumSubject;
use App\Models\ForumPost;
use App\Models\ForumReactionType;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $subjects = ForumSubject::with('posts')->get();
        return view('forum.index', compact('subjects'));
    }

    public function subject(ForumSubject $subject)
    {
        $posts = $subject->posts()->latest()->paginate(10);
        return view('forum.subject', compact('subject', 'posts'));
    }


    public function createSubject()
    {
        return view('forum.create_subject');
    }
    public function createPost(ForumSubject $subject)
    {
        return view('forum.create_post', compact('subject'));
    }
    public function showPost(ForumPost $post)
    {
        $replies = $post->replies()->paginate(10);

        return view('forum.show_post', compact('post', 'replies'));
    }


    public function storeSubject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:forum_subjects,name',
            'description' => 'nullable|string',
        ]);

        ForumSubject::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('forum.index')->with('success', 'Subject created successfully!');
    }

    public function storePost(Request $request, ForumSubject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = $subject->posts()->create([
            'name' => $request->name,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        if ($request->has('reply_post_id')) {
            $reply_post = ForumPost::find($request->reply_post_id);
            if ($reply_post) {
                $reply_post->replies()->save($post);
            }
        }

        return redirect()->route('forum.subject', $subject)->with('success', 'Post created successfully!');
    }


    public function addReaction(Request $request, ForumPost $post)
    {
        $request->validate([
            'reaction_type_id' => 'required|exists:forum_reaction_types,id',
        ]);

        if ($post->reactions()->where('user_id', auth()->id())->where('reaction_type_id', $request->input('reaction_type_id'))->exists()) {
            return back()->with('error', 'You already reacted with this type.');
        }

        $post->reactions()->attach($request->input('reaction_type_id'), ['user_id' => auth()->id()]);

        return back()->with('success', 'Reaction added!');
    }

    public function show(ForumSubject $subject)
    {
        $reactionTypes = ForumReactionType::all();
        return view('forum.show', compact('subject', 'reactionTypes'));
    }

    public function createReply(Request $request, ForumPost $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $reply = $post->replies()->create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('forum.showPost', $post->id)->with('success', 'Reply created successfully!');
    }


}
