<div class="checklist">
    <div class="checklist--form">
        <input type="text" name="item" placeholder="Add item to list" class="fluent-light" /> <input type="button" value="Add" class="fluent-blue" />
    </div>

    <div class="checklist--list">
        @include('checklist.checklist', ['todos' => $todos, 'finished' => $finished ?? []])
    </div>
</div>
