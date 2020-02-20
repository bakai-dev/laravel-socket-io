<?php


namespace App\Http\Controllers;


use App\Events\Message;
use App\Events\PrivateMessage;
use App\Room;
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


    public function chatRoom(Request $request)
    {
        PrivateMessage::dispatch($request->all());
    }

    public function chatRoomView(Room $room)
    {

        return view('room', compact('room'));
    }
}
