@if($isAdmin)
    <h1>Admin</h1>

    <h2>Users</h2>
    @include('settings.components.userlist')

    <h2>Feeds</h2>
    @include('settings.components.latest-feeds')

    <h2>Error log</h2>
    @include('settings.components.error-log')
@endif
