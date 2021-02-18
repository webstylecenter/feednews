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
    <h2>Public Beta</h2>
    <div style="padding: 10px; border: 1px solid #337dff; border-radius: 5px;">
        <b>Notice: </b> FeedNews is currently transitioning between frameworks and is experiencing a few bugs and glithes
        at this time. Errors are being reported automaticly and will be fixed as soon as possible!
        Thank you for understanding!
    </div>

    <p>Please sign in below</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="signinBox">

        @if(env('GOOGLE_CLIENT_ID'))
            <a class="login-with-google" href="{{ route('oauth.redirect') }}"></a>
        @endif

        @if(env('FACEBOOK_CLIENT_ID'))
            <a class="login-with-facebook" href="{{ route('oauth.facebook.redirect') }}"></a>
        @endif

        <button type="button" class="js-other-login-options">Other options</button>

        <form method="post" action="{{ route('authenticate') }}">
            <input type="text" name="email" id="email" placeholder="email" />
            <input type="password" name="password" id="password" placeholder="password" />
            <input type="submit" value="Login" /> <a class="createAccount" href="{{ route('register') }}">Create account</a>
            @csrf
        </form>
    </div>

    <p><a href="{{ route('homepage.privacy.policy') }}">Privacy Policy</a></p>
@endsection
