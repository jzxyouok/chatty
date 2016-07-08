@extends('templates.default')

@section('title')

Chatty | Sign In

@stop

@section('content') 

<div class="col-md-6 col-md-offset-3">
    <div class="welcome-message">
        <h3>sign in</h3>
        <hr>
        <form role="form" method="post" action="{{ route('auth.signin') }}">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email" class="control-label">Email</label>
                <input type="text" name="email" class="form-control" id="email" value="{{ Request::old('email') }}">
                @if ($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password" class="control-label">Password</label>
                <input type="password" name="password" class="form-control" id="email" value="">
                @if ($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-default">Sign In</button>
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
</div>

@stop