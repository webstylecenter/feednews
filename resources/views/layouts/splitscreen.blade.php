@extends('base')

@section('body')
    <div class="splitscreen">
        <div class="left side">
            <div class="content wow fadeInRight">
                @section('leftContent')@endsection
            </div>
        </div>
        <div class="right side">
            <div class="content wow fadeInLeft">
                @section('rightContent')@endsection
            </div>
        </div>
    </div>
@endsection
