@php
    $values = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
@endphp

<form class="js-overlay-form-container" data-action-url="{{ route('tag.add') }}">
    <h1>Add tag</h1>

    <p>
        <label for="tag_name">Name of tag:</label><br/>
        <input id="tag_name" type="text" name="name" placeholder="Example: Livestreams"/>
    </p>

    <p>
        <label for="tag_color">Select color:</label><br/>
        <input
           id="tag_color"
           class="spectrum"
           type="text"
           name="color"
           placeholder="#F3F3F3"
           value="#{{ $values[array_rand($values, 1)] . $values[array_rand($values, 1)] . $values[array_rand($values, 1)] . $values[array_rand($values, 1)] . $values[array_rand($values, 1)] . $values[array_rand($values, 1)] }}"/>
    </p>
</form>
