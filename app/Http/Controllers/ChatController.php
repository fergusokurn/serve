<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $chats = collect();
        
        if (request('user_id')) {
            $chats = Chat::where(function($query) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', request('user_id'));
            })->orWhere(function($query) {
                $query->where('sender_id', request('user_id'))
                      ->where('receiver_id', auth()->id());
            })->with(['sender', 'receiver'])->orderBy('created_at')->get();
        }
        
        return view('chat.index', compact('users', 'chats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}
