@extends('base')

@section('body')
    <div class="page--multi-tab">
        <div class="page--multi-tab-background"></div>
        <div class="page--multi-tab-background--overlay"></div>

        <header>
            <h1>
                @section('headerTitle')
                @endsection
            </h1>
            <div class="weather">
                @include('widgets/weather')
            </div>
        </header>

        <div class="mainContent">
            <nav>
                @section('tabs')
                @endsection
            </nav>

            <div class="views">
                @section('content')
                @endsection
            </div>
        </div>
    </div>
@endsection
