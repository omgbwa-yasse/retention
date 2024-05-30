<?php

// app/Http/Controllers/ForumReactionController.php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumReactionPost; // Import the ForumReactionPost model
use Illuminate\Http\Request;

class ForumReactionController extends Controller
{
    public function add(Request $request, ForumPost $post)
    {
        // Validate the incoming data (reaction_type_id exists, user is authenticated, etc.)
        $request->validate([
            'reaction_type_id' => 'required|exists:forum_reaction_types,id',
        ]);

        // Check if the user already reacted to this post with this type
        if ($post->forumReactionPosts()->where('user_id', auth()->id())
            ->where('reaction_type_id', $request->reaction_type_id)
            ->exists()) {
            return back()->with('error', 'You already reacted to this post.');
        }

        // Create a new ForumReactionPost entry
        ForumReactionPost::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'reaction_type_id' => $request->reaction_type_id,
        ]);

        return back()->with('success', 'Reaction added successfully!');
    }
}
