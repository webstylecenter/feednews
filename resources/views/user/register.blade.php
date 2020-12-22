@extends('layouts.splitscreen')

@section('title')
    Feednews - Read and manage News, Todo's and notes cross-platform
@endsection

@section('leftContent')
    @include('user.leftcontent')
@endsection

@section('rightContent')
    <div class="header">
        <h1>Feednews.me</h1>
    </div>
    <p>Fill in the form below to register for a FeedNews.me account</p>

    <div class="registerBox">
        <form method="post">
            <input type="text" name="username" id="username" placeholder="username" required="required" />
            <input type="text" name="email" placeholder="Email address" required="required" />
            <input type="password" name="password" id="password" placeholder="password" required="required" />

            <input type="checkbox" value="on" name="gdpr" id="gdpr" required="required" /><label for="gdpr">I agree that the above filled in data will be stored on Feednews servers for login purposes as described in our <a href="/privacy-policy/">Privacy Policy</a>.</label><br />&nbsp;<br />
            <input type="submit" value="Create account" />
        </form>
    </div>
@endsection
