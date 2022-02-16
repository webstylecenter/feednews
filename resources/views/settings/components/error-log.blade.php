<h4>Latest Feeds</h4>
<table>
    <thead>
    <tr>
        <th>Type</th>
        <th>User</th>
        <th>Feed</th>
        <th>Exception</th>
        <th>Occurrences</th>
        <th>First error</th>
        <th>Last at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($errors as $error)
        <tr>
            <td class="error-log-{{ $error->getType() }}">{{ $error->getType() }}</td>
            <td>{{ $error->user->name ?? '-' }}</td>
            <td>{{ $error->feed->name ?? '-' }}</td>
            <td>{{ $error->exception }}</td>
            <td>{{ $error->occurrences }}</td>
            <td>{{ $error->created_at }}</td>
            <td>{{ $error->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
