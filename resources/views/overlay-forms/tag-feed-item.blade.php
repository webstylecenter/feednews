<form class="js-overlay-form-container" data-action-url="{{ route('tag.add') }}">
    <h1>Tag item</h1>

    <div class="add-tag-to-user-feed-item-preview">
        <h3>{{ $title }}</h3>
        <p>{{ $description  }}</p>
    </div>

    <div class="tag-options" style="max-height: 250px; overflow-y: scroll">
        @foreach($tags as $tag)
            <div style="display: block;">
                <input style="width: auto" type="radio" name="tag" value="{{ $tag->id }}" /> {{ $tag->name }}
            </div>
        @endforeach
    </div>

    <input type="hidden" name="user-feed-item-id" value="{{ $id }}">
</form>
