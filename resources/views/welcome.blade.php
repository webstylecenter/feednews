@extends('base')

@section('body')
    Test

    {{ \Illuminate\Support\Facades\Auth::user()->name }}
@endsection
