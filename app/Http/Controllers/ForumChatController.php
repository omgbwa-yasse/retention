<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ForumChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with('messages')->get();
        return view('chats.index', compact('chats'));
    }

    public function create()
    {
        return view('chats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $chat = Chat::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('chats.show', $chat->id)->with('success', 'Chat created successfully!');
    }

    public function show(Chat $chat)
    {
        $messages = $chat->messages()->latest()->paginate(10);
        return view('chats.show', compact('chat', 'messages'));
    }

    public function storeMessage(Request $request, Chat $chat)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $message = $chat->messages()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('chats.show', $chat->id)->with('success', 'Message sent successfully!');
    }
}
