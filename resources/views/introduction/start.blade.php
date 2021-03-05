@extends('multi-tab-view')

@section('headerTitle')
    <span class="hide-if-mobile">Welcome to Feednews!</span>
    <span class="hide-if-desktop">Welcome!</span>
@endsection

@section('tabs')
    <span class="js-homepage-showpage active" data-page="intro">Introduction</span>
    <span class="js-homepage-showpage" data-page="feeds">Select feeds to follow</span>
    <span class="js-homepage-showpage" data-page="preferences">Good to know</span>
@endsection

@section('content')
    <div class="page--intro">
        <div class="view intro active-view">
            @include('introduction.content.intro')
        </div>
        <div class="view feeds">
            @include('introduction.content.select-feeds')
        </div>
        <div class="view preferences">
            @include('introduction.content.good-to-know')
        </div>
    </div>
@endsection
