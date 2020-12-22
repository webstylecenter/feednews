<div class="widget-note">
    <h2>Notes</h2>

    <div class="widget-note--notes-list">
        @foreach($notes as $note)
            <span class="js-open-note note-selector-{{ $note->id }}" data-note-id="{{ $note->id }}">{{ $note->name }}</span>
        @endforeach
        <span class="js-open-note fa fa-plus-circle note-selector-new" data-note-id="new"></span>
    </div>

    <div class="widget-note--notes">
        @foreach($notes as $note)
            <div class="note-data-{{ $note->id }}">
                <input type="text" name="name" value="{{ $note->name }}" />
                <textarea class="widget-note--input" data-id="{{ $note->id }}" data-position="{{ $note->position }}">{{ $note->content }}</textarea>
                <button class="widget-note--remove js-remove-note" data-id="{{ $note->id }}">Remove note</button>
            </div>
        @endforeach

        <div class="note-data-new">
            <input type="text" name="name" value="{{ \Carbon\Carbon::now()  }}" />
            <textarea class="widget-note--input" data-id="" data-position=""></textarea>
        </div>
    </div>
</div>
