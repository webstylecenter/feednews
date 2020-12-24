@extends('base')

@section('body')
    <div class="splitscreen">
        <div class="left side">
            <div class="content wow fadeInRight">
                @section('leftContent')
                @show
            </div>
        </div>
        <div class="right side">
            <div class="content wow fadeInLeft">
                @section('rightContent')
                @show
            </div>
        </div>
    </div>
@endsection
