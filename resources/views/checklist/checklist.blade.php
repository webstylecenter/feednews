<ul>
    @foreach($todos as $checklistItem)
        <li>
            <input class="js-checklist-item" type="checkbox" id="todo{{ $checklistItem->id }}" data-database-id="{{ $checklistItem->id }}" />
            <label for="todo{{ $checklistItem->id }}">{{ $checklistItem->item }}</label>
        </li>
    @endforeach
</ul>
@if($finished)
    <h2>Done</h2>
    <ul class="done">
        @foreach($finished as $checklistItem)
            <li>
                <input class="js-checklist-item" type="checkbox" id="todo{{ $checklistItem->id }}" data-database-id="{{ $checklistItem->id }}" checked="checked" />
                <label for="todo{{ $checklistItem->id }}">{{ $checklistItem->item }}</label>
            </li>
        @endforeach
    </ul>
@endif
