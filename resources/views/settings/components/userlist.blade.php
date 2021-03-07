<h4>Number of users: {{ \App\Models\User::all()->count() }}</h4>

<table>
    <thead>
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Email</th>
        <th># Feeds</th>
        <th># Notes</th>
        <th># Checklist items</th>
        <th>Last Login</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->userFeeds()->count() }}</td>
            <td>{{ $user->notes()->count() }}</td>
            <td>{{ $user->checklistItems()->count() }}</td>
            <td>{{ $user->last_login ?? $user->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
