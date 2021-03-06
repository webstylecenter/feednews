@extends('base')

@section('body')
    <div class="page--homepage">
        <div data-balloon="Click picture to see more" data-balloon-pos="bottom" class="header">
            @include('widgets.weather')
        </div>

        <div class="mainContent">
            <nav>
                <span class="js-homepage-showpage active" data-page="widgets">Notes</span>
                <span class="js-homepage-showpage" data-page="feeds">Feed overview</span>
            </nav>

            <div class="views">
                <div class="view widgets">
                    @include('widgets.notes', ['notes' => $notes])
                    <div class="checklist-widget">
                        @include('widgets.checklist', ['todos' => $todos])
                    </div>
                </div>

                <div class="view feeds">
                    Loading feeds...
                </div>
            </div>

        </div>
    </div>
@endsection
