<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show($id): View
    {
        $chat = Chat::with(['users', 'messages'])->find($id);
        if(!$chat->users->contains(auth()->user())) {
            abort(403);
        }
        $messages = $chat->messages()->with('user')->get();

        return view('chatroom', compact('chat', 'messages'));
    }
}
