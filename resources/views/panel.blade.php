@extends('layouts.app')
@section('head')
    <title>{{env('APP_NAME')}} | Panel</title>
@endsection
@section('content')
    <div class="flex flex-center w-100">
        <img src="{{asset('images/web_page_under_construction.jpg')}}" alt="En construcción" class="w-75">
    </div>
@endsection