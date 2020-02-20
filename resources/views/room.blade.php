@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::check())
            <h5 class="text-center">Пользователь: {{Auth::user()->email}}</h5>
            <room-component :room="{{$room}}" :users="{{\App\User::select('email','id')->where('id' ,'!=', Auth::id())->get()}}" :user="{{Auth::user()}}"></room-component>
        @else
            Y need login for chat
        @endif

    </div>
</div>


@endsection

