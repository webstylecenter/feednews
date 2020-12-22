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
