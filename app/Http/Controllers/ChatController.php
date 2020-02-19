<?php


namespace App\Http\Controllers;


use App\Events\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function echoChat(Request $request)
    {
        Message::dispatch($request->input('body'));
    }

    public function echoChatView()
    {
        return view('echoChat');
    }
}
