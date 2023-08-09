<h4>Number of users: {{ \App\Models\User::all()->count() }}</h4>

<table>
    <thead>
    <tr>
        <th colspan="2">Name</th>
        <th>Email</th>
        <th># Feeds</th>
        <th># Notes</th>
        <th># Checklist items</th>
        <th colspan="2">Last Login</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td colspan="2">
                <img class="user-avatar" src="{{ $user->avatar ?? '/images/FeedNews-Logo.png' }}" title="Avatar" />
                {{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->userFeeds()->count() }}</td>
            <td>{{ $user->notes()->count() }}</td>
            <td>{{ $user->checklistItems()->count() }}</td>
            <td>{{ $user->last_login ?? $user->updated_at }}</td>
            <td><button class="button remove-user fa fa-trash" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-remove-url="{{ route('remove', ['id' => $user->id]) }}"></button></td>
        </tr>
    @endforeach
    </tbody>
</table>
