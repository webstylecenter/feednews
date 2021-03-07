@if($isAdmin)
    <h1>Admin</h1>

    <h2>Users</h2>
    @include('settings.components.userlist')

    <h2>Feeds</h2>
    @include('settings.components.latest-feeds')
@endif
