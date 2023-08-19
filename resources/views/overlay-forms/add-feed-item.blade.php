<form class="js-overlay-form-container" data-action-url="{{ route('feed.add') }}">
    <h1>Add item</h1>

    <p>
        <label for="add_url">Url you want to save:</label><br/>
        <input class="js-auto-load-meta-data" id="add_url" type="text" name="url" placeholder="https://google.com"/>
    </p>

    <p>
        <label for="add_title">Title:</label><br/>
        <input id="add_title" type="text" name="title" placeholder="Google Search Engine"/>
    </p>

    <p>
        <label for="add_description">Description:</label><br/>
        <input id="add_description" type="text" name="description" placeholder="Have your life tracked by the best"/>
    </p>
</form>
