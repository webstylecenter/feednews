@extends('layouts.splitscreen')

@section('title')
    Privacy Policy - Read and manage News, Todo's and notes cross-platform
@endsection

@section('leftContent')
    @include('user.leftcontent')
@endsection

@section('rightContent')
    <div class="header">
        <h1>Feednews.me</h1>
    </div>
    <h2>Privacy Policy</h2>

    <p>Feednews.me cares about Privacy. We only ask for information that we need to make a sign in possible, and only
        keep information that is required to make things work. This is how we handle personal data:</p>

    <h3>What personal data is stored?</h3>
    <ul>
        <li>Your username, email and one-way encrypted password</li>
        <li>Your notes</li>
        <li>Your Todo list</li>
        <li>The feeds you add</li>
        <li>The feed-items you add manually</li>
        <li>What feed-items you have pinned</li>
        <li>Your IP-address only when you register and login for security reasons.</li>
        <li>An url to your Facebook/Google avater if you use those platforms to login</li>
    </ul>

    <h3>Who has access to your data?</h3>
    <p>The above mentioned data is accessible to yourself when you sign in, and to the webmaster of FeedNews. We do not share any data with anyone.</p>

    <h3>Data storage purposes</h3>
    <p>The above mentioned data is saved on our server so you can access your feeds, notes, todo lists from any device from any location. When you login with Facebook or Google  we will also save your avater url so we can display your avatar picture in the top right of the desktop website.</p>

    <h3>Am I being tracked?</h3>
    <p>We only save the date of your last login in case we need to wipe data in the future, but we don't use any
        trackers, or embeds that might track you. We only set a cookie to check your login state, but we don't save
        anything else.</p>
    <p>We might add Google Analytics in the future, but with the option to anonymize data first before sending it to
        Google's servers. That way, YOU personally won't tracked, but we still get to see what functionality get's used
        the most and what not.</p>
    <p>If we ever going to ad any Ad services to our site (that we don't plan to do) we will only show them if you
        accept to be tracked if you sign in.</p>

    <h3>Is my data secure?</h3>
    <p>We run on the latest, updated versions of Laravel, PHP 8 and CentOS. The frameworks we use are continuous
        monitored by GitHub for any security issues and we fix them as soon as we hear about them. If for some case our
        data get's stolen, passwords are encrypted in a way that they cannot be recovered. If you know coding, you can
        see what we do in our source code on
        <a href="https://github.com/webstylecenter/feednews/" target="_blank">Github</a>.
    </p>

    <h3>Can my data be removed?</h3>
    <p>We will soon at a feature to remove data with a simple click, for now. Please contact us at peter@petervdam.nl
        with your email address. And your data will be removed within 48 hours.</p>

    <h3>How long is my data saved</h3>
    <p>If we notice that you haven't signed in for a couple of months, the webmaster will manually delete all your content. This includes your email address and all data you've added during your usage.</p>

    <p><a class="button" href="{{ route('register') }}">Register now!</a></p>
@endsection
