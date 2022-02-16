@extends('base')
@php
 use Carbon\Carbon;
$hour = Carbon::now()->format('H');
@endphp

@section('body')
    <div class="content-overlay"></div>
    @include('home.components.header')
    @include('home.components.profile-menu')
    @include('home.components.container')
    @include('home.components.mobile')
    @include('home.components.handlebars')
    @include('modals.create')
@endsection
