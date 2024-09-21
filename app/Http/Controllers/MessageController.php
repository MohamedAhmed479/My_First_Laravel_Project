<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        $messages = Message::paginate(15);
        return view("admin.messages.view_messages", get_defined_vars());
    }

    public function unReadMessages() {
        $unread_messages = Message::where('status', 'unread')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.messages.view_unread_messages', get_defined_vars());

    }

    public function show(Message $message) {
        $message->update([
            'status' => 'readable',
        ]);

        return view("admin.messages.show", get_defined_vars());

    }

    public function contact() {
        return view('messages.contact');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $validatedData['status'] = "unread";

        Message::create($validatedData);

        return back()->with('success', "Your message send successfully");
    }

    public function destroy(Message $message) {
        $message->delete();

        return back()->with('success', "Message Deleted successfully");
        
    }

}
