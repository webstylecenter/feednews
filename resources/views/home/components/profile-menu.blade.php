<div class="profileMenu">
    <ul>
        <li><a class="js-open-url" data-url="{{ route('settings.index') }}"><span class="fa fa-cog"></span>Feed &amp; Settings</a></li>
        <li class="logout"><a class="js-open-new-window"><span class="fa fa-external-link-alt"></span>Open page in new window</a></li>

        <li><a class="js-copy-to-clipboard" data-clipboard-action="copy" data-clipboard-text="{{ env('APP_URL') }}"><span class="fa fa-share-square"></span>Copy url to clipboard</a></li>

        <li><a class="js-open-add-new-feed-form"><span class="fa fa-file"></span>Add item</a></li>

        <li class="logout"><a class="js-open-url" data-url="{{ route('feedback.index') }}"><span class="fa fa-comment"></span>Leave Feedback</a></li>
        <li class="logout"><a href="{{ route('logout') }}"><span class="fa fa-user"></span> Logout</a></li>
    </ul>
</div>
