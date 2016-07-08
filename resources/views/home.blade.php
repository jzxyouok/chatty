@extends('templates.default')

@section('title')

Chatty | Home

@stop

@section('content')

<div class="col-md-12">
    <div class="welcome-message">
        <h3>Welcome to Chatty</h3>
        <p>The best social network ever..</p>
        <div class="banner">
            <div class="overlay">
                <div class="banner-header">
                    <h2>because friends are important</h2>
                    <a class="b-sign-up" href="{{ URL::to('signup') }}">Sign Up</a>
                    <a class="b-sign-in" href="{{ URL::to('signin') }}">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop