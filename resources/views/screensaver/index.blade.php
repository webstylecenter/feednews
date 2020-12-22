@extends('base')

@section('header')
    <script type="text/javascript">
        /** global: newsItems */
        let newsItems = [];
        @foreach($feedItems as $item)
            newsItems.push([
                "{{ $item->feed->name }}",
                "{{ strip_tags($item->title, 'js')  }}",
                "{{ mb_substr($item->description, 0, 120) }}",
                "{{ $item->feed->color }}"
            ]);
        @endforeach

    </script>
@endsection

