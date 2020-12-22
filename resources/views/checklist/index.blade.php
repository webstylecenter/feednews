@extends('base')

@section('body')
    <div class="checklist--parent">
        @include('checklist.widget', ['finished' => $finished, 'todos' => $todos])
    </div>
@endsection
