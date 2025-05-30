@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/index.css') }}">
@endsection

@section('content')
@if(isset($search) && $search != '')
    <h2>検索結果：「{{$search}}」</h2>
@endif
</div>
        <div class="image-container">
            <div class="row">
                @foreach ($sells as $sell)
                    <div class="col-md-2 mb-4">
                        <a href="{{ url('/item/' . $sell->id) }}" >
                            <div class="card">
                                <img src="{{ $sell->image }}" class="card-img-top img-fluid custom-img" alt="{{ $sell->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $sell->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
@endsection

