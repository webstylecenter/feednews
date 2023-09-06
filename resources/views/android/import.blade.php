@extends('multi-tab-view')

@section('headerTitle')
    Feednews
@endsection

@section('tabs')
    <span class="js-homepage-showpage" data-page="settings">Import {{ $status }}</span>
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
