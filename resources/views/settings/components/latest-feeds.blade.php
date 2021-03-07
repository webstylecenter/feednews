<h4>Latest Feeds</h4>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Followers</th>
        <th>Created at</th>
        <th>Updated at</th>
    </tr>
    </thead>
    <tbody>
        @foreach($feeds as $feed)
            <tr>
                <td>{{ $feed->id }}</td>
                <td>{{ $feed->name }}</td>
                <td>{{ $feed->userFeeds()->count() }}</td>
                <td>{{ $feed->created_at }}</td>
                <td>{{ $feed->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
