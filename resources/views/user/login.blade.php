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
        <form method="post" action="{{ route('authenticate') }}">
            <input type="text" name="email" id="email" placeholder="email" />
            <input type="password" name="password" id="password" placeholder="password" />
            <input type="submit" value="Login" /> <a class="createAccount" href="{{ route('register') }}">Create account</a>
            @csrf
        </form>

        @if(env('GOOGLE_CLIENT_ID'))
            <a class="login-with-google" href="{{ route('oauth.redirect') }}">Login with your Google account</a>
        @endif
    </div>

    <p><a href="{{ route('homepage.privacy.policy') }}">Privacy Policy</a></p>
@endsection
