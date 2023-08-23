@extends('base')

@section('body')
    <div class="page--multi-tab">
        <div class="page--multi-tab-background"></div>
        <div class="page--multi-tab-background--overlay"></div>

        <header>
            <h1>
                @section('headerTitle')
                @show
            </h1>
        </header>

        <div class="mainContent">
            <nav>
                @section('tabs')
                @show
            </nav>

            <div class="views">
                @section('content')
                @show
            </div>
        </div>
    </div>
@endsection
