@extends('templates.default')

@section('title')

Chatty | Sign Up

@stop

@section('content') 

<div class="col-md-6 col-md-offset-3">
    <div class="welcome-message">
        <h3>sign Up</h3>
        <hr>
        <form role="form" method="post" action="{{ route('auth.signup') }}">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email" class="control-label">Your email address</label>
                <input type="text" name="email" class="form-control" id="email" value="{{ Request::old('email') ?: '' }}">
                @if ($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                <label for="username" class="control-label">Choose a  username</label>
                <input type="text" name="username" class="form-control" id="username" value="{{ Request::old('username') ?: '' }}">
                @if ($errors->has('username'))
                <span class="help-block">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password" class="control-label">Choose a password</label>
                <input type="password" name="password" class="form-control" id="email" value="">
                @if ($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Sign Up</button>
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
</div>

@stop