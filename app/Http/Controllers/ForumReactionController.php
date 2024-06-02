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
        $request->validate([
            'reaction_type_id' => 'required|exists:forum_reaction_types,id',
        ]);

        $user = auth()->user();

        // Find the existing reaction (if any)
        $existingReaction = ForumReactionPost::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();

        if ($existingReaction) {
            // User has already reacted
            if ($existingReaction->reaction_type_id == $request->reaction_type_id) {
                // Same reaction type, so delete it
                $existingReaction->delete();
                return back()->with('success', 'Reaction removed.');
            } else {
                // Different reaction type, so update it
                ForumReactionPost::where('user_id', $user->id)
                    ->where('post_id', $post->id)
                    ->update(['reaction_type_id' => $request->reaction_type_id]);

                return back()->with('success', 'Reaction changed.');
            }
        } else {
            // No existing reaction, so create a new one
            $post->forumReactionPosts()->create([
                'user_id' => $user->id,
                'reaction_type_id' => $request->reaction_type_id,
            ]);
            return back()->with('success', 'Reaction added.');
        }
    }



}
