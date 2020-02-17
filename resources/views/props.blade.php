@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <props-component :urldata="{{json_encode($url_data)}}"></props-component>

    </div>
</div>


@endsection
