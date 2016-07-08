@extends('templates.default')

@section('title')

Edit Profile | {{ Auth::user()->getNameOrUsername() }} 

@stop

@section('content')

<div class="row">
    
    <!-- User info -->
    <div class="col-md-4">
        <div class="block-background">
            <img style="max-height:250px;" height=auto width=100% src="{{ route('display.dp', ['filename' => Auth::user()->displayPicture->filename]) }}" alt="">
            <h3><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">{{ Auth::user()->getNameOrUsername() }}</a></h3>            
            <hr>
            <label for="fname">First Name:</label>
            <span id="fname">{{ Auth::user()->first_name }}</span><br>
            <label for="lname">Last Name:</label>
            <span id="lname">{{ Auth::user()->last_name }}</span><br>
            <label for="uname">Username:</label>
            <span id="uname">{{ Auth::user()->username }}</span><br>
            <label for="lc">Location:</label>
            <span id="lc">{{ Auth::user()->location }}</span>
        </div>
    </div>

    <!-- Edit form for users -->
    <div class="col-md-5">
        <div class="block-background">
            <h3>Update your profile</h3>
            <hr>
            <form class="form-vertical" role='form' method="post" action="{{ route('profile.edit') }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                            <label for="first_name" class="control-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}" >
                            @if ($errors->has('first_name'))
                            <span class="help-block">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                            <label for="last_name" class="control-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">
                            @if ($errors->has('last_name'))
                            <span class="help-block">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                    <label for="location" class="control-label">Location</label>
                    <input type="text" name="location" class="form-control" id="location" value="{{ Request::old('location') ?: Auth::user()->location }}">
                    @if ($errors->has('location'))
                    <span class="help-block">{{ $errors->first('location') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>

    <!-- Image upload section -->
    <div class="col-md-3">
        <div class="block-background">
            <h4>Upload Your Image</h4><hr>
            <form action="{{ route('upload.dp') }}" method="post" enctype="multipart/form-data">
                <div class="form-group {{ $errors->has('dp') ? 'has-error' : '' }}">
                    <input class="form" type="file" name="dp" id="dp_upload">
                    @if($errors->has('dp'))
                        <span class="help-block">{{ $errors->first('dp') }}</span>
                    @endif
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button class="btn btn-default">Upload</button>
            </form>
        </div> 
    </div>

</div>

@stop