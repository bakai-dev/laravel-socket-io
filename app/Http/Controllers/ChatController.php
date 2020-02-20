<?php


namespace App\Http\Controllers;


use App\Events\Message;
use App\Events\PrivateMessage;
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

    public function privateEchoChat(Request $request)
    {
        PrivateMessage::dispatch($request->all());
    }

    public function privateEchoChatView()
    {
        return view('privateEchoChat');
    }
}
