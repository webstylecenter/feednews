@extends('multi-tab-view')

@section('headerTitle')
    Settings
@endsection

@section('tabs')
    <span class="js-homepage-showpage active" data-page="feeds">Feeds</span>
    <span class="js-homepage-showpage" data-page="preferences">Preferences</span>
    @if($isAdmin)
        <span class="js-homepage-showpage" data-page="admin">Admin</span>
    @endif
@endsection

@section('content')
<div class="page--settings">
    <div class="view active-view feeds">
        @include('settings.feeds')
    </div>
    <div class="view preferences">
        @include('settings.preferences')
    </div>
    <div class="view admin">
        @include('settings.admin')
    </div>
</div>

@include('modals.choose-icon')
@endsection
