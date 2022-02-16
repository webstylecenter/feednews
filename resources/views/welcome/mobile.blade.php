@extends('base')

@section('body')
    <div class="loading-screen--top">Loading...</div>
    <div class="load">
        <div class="dot"></div>
        <div class="outline"><span></span></div>
    </div>
    <div class="loading-screen--bottom js-open-new-window">
        If you see this screen longer then 10 seconds<br />
        you might want to open it in a new window
    </div>
@endsection
