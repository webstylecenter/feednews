@if($isAdmin)
    <h1>Number of users: {{ \App\Models\User::all()->count() }}</h1>

    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Last Login</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->lastLogin }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
