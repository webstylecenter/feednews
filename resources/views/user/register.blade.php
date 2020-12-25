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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="registerBox">
        <form method="post" action="{{ route('register.submit') }}">
            <input type="text" name="name" id="name" placeholder="Name" value="{{ $request->old('name') }}"  />
            <input type="text" name="email" placeholder="Email address" value="{{ $request->old('email') }}" />
            <input type="password" name="password" id="password" placeholder="Password"  />

            <input type="checkbox" value="on" name="gdpr" id="gdpr" /><label for="gdpr">I agree that the above filled in data will be stored on Feednews servers for login purposes as described in our <a href="{{ route('homepage.privacy.policy') }}">Privacy Policy</a>.</label><br />&nbsp;<br />
            <input type="submit" value="Create account" />
            @csrf
        </form>
    </div>
@endsection
