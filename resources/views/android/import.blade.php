@extends('multi-tab-view')

@section('headerTitle')
    Android import: {{ $status }}
@endsection

@section('content')
    <div class="page--settings">
        <div class="view active-view">
            <h1>{{ $title }}</h1>
            <p>{{ $description }}</p>
            <p>{{ $url }}</p>
        </div>
    </div>

@endsection
