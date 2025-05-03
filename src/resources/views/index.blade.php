@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="all-contents">
        <form action="localhost/" method = "POST">
        @csrf
            <div class="top-contents">

            </div>

        </form>
</div>