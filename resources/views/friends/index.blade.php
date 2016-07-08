@extends('templates.default')

@section('title')

Friends | {{ Auth::user()->getNameOrUsername() }}

@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <h3>Your friends</h3>
        @if (!$friends->count())
        <p>You have no friends.</p>        
        @else
        <div class="block-background">

            @foreach ($friends as $user)
                <div class="friend-list">
                    @include('user.partials.userblock')<hr>
                </div>
            @endforeach
        </div>

        @endif
    </div>
    <div class="col-md-5 col-md-offset-1">
        <h4>Friend requests</h4>
        @if (!$requests->count())
            <p>You have no friend request.</p>        
        @else
            <div class="block-background">
                @foreach ($requests as $user)
                    <div class="friend-list row">
                        <div class="col-md-6">
                            @include('user.partials.userblock')
                        </div>
                        <div class="col-md-6"> 
                            @if (Auth::user()->hasFriendRequestReceived($user))
                                <a href="{{ route('friend.accept', ['username' => $user->username]) }}" class="btn btn-primary accept-btn">Accept friend request</a>
                             @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@stop