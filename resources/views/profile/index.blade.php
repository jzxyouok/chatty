@extends('templates.default')

@section('title')

Chatty | {{ $user->getNameOrUsername() }}

@stop

@section('content')

<div class="row">
    <div class="col-md-6">
        <!-- User info -->
        <div class="block-background">
            <img style="max-height:350px;" height=auto width=100% src="{{ route('display.dp', ['filename' => $user->displayPicture->filename]) }}" alt="">
            <h3><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">{{ $user->getNameOrUsername() }}</a></h3>            
            <hr>
            <label for="fname">First Name:</label>
            <span id="fname">{{ $user->first_name }}</span><br>
            <label for="lname">Last Name:</label>
            <span id="lname">{{ $user->last_name }}</span><br>
            <label for="uname">Username:</label>
            <span id="uname">{{ $user->username }}</span><br>
            <label for="email">Email:</label>
            <span id="email">{{ $user->email }}</span><br>
            <label for="lc">Location:</label>
            <span id="lc">{{ $user->location }}</span>
        </div>

        <!-- User status -->

        <div>
            <h2 style="font-weight:200">{{ $user->getFirstNameOrUsername() }}'s Posts</h2><hr>
        </div>
        @if(!$statuses->count())
        <p>No post to show.</p>
        @else
        @foreach($statuses as $status)
        <div class="media block-background">
            <a class="pull-left" href="{{ route('profile.index',[
                            'username' => $status->user->username,
                        ]) }}">
                <img class="media-object img-responsive" style="height: 50px; width: 50px " alt="{{ $status->user->getNameOrUsername() }}" src="{{ route('display.dp', ['filename' => $status->user->displayPicture->filename]) }}">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="{{ route('profile.index',[
                            'username' => $status->user->username,
                        ]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
                <p>{{ $status->body }}</p>
                <ul class="list-inline">
                    <li>{{ $status->created_at->diffForHumans() }}</li>
                    @if($status->user->id !== Auth::user()->id)
                        @if(Auth::user()->hasLikedStatus($status))
                            <li><a href="{{ route('status.dislike', ['statusId' => $status->id]) }}">Dislike</a></li>
                        @else
                            <li><a href="{{ route('status.like', ['statusId' => $status->id]) }}">Like</a></li>
                        @endif
                    @endif
                    <li>{{$status->likes->count()}} {{ str_plural('like', $status->likes->count()) }}</li>

                    @if($status->user->id == Auth::user()->id)
                    <li><a href="{{ route('status.edit', ['statusId' => $status->id]) }}">Edit</a></li>
                    @endif

                    @if($status->user->id == Auth::user()->id)
                    <li><a href="{{ route('status.delete', ['statusId' => $status->id]) }}">Delete</a></li>
                    @endif
                </ul><hr>

                <!-- replies -->
                @foreach($status->replies as $reply)
                <div class="media comment-block">
                    <a class="pull-left" href="{{ route('profile.index',['username' => $reply->user->username]) }}">
                        <img  style="height: 50px; width: 50px" src="{{ route('display.dp', ['filename' => $reply->user->displayPicture->filename]) }}" alt="{{ $reply->user->getNameOrUsername() }}" class="media-object">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="{{ route('profile.index',['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
                        <p>{{ $reply->body }}</p>
                        <ul class="list-inline">
                            <li>{{ $reply->created_at->diffForHumans() }}</li>
                            @if($reply->user->id !== Auth::user()->id)
                                @if(Auth::user()->hasLikedStatus($reply))
                                    <li><a href="{{ route('status.dislike', ['statusId' => $reply->id]) }}">Dislike</a></li>
                                @else
                                    <li><a href="{{ route('status.like', ['statusId' => $reply->id]) }}">Like</a></li>
                                @endif
                            @endif
                            <li>{{$reply->likes->count()}} {{ str_plural('like', $reply->likes->count()) }}</li>
                            @if($reply->user->id == Auth::user()->id)
                            <li><a href="{{ route('status.edit', ['statusId' => $reply->id]) }}">Edit</a></li>
                            @endif
                            @if($reply->user->id == Auth::user()->id)
                            <li><a href="{{ route('status.delete', ['statusId' => $reply->id]) }}">Delete</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
                @endforeach 

                <!-- reply form..show this form only if the currently authenticated user is friends with the user -->
                @if($authUserIsFriend || $user->id == Auth::user()->id)
                <form action="{{ route('status.reply', ['statusId' => $status->id]) }}" class="col-md-6" role="form" method="post">
                    <div class="form-group {{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}">
                        <textarea style="resize:none" name="reply-{{ $status->id }}" class="form-control" placeholder="Reply to this status.." rows="2"></textarea>
                        @if($errors->has("reply-{$status->id}"))
                        <span class="help-block">{{ $errors->first() }}</span>
                        @endif
                    </div>
                    <input type="submit" value="Reply" class="btn btn-primary btn-sm">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
                @endif
            </div>
        </div>
        @endforeach
        @endif
    </div>
    
    <!-- Friendlist -->
    <div class="col-md-6">
        <div class="friendlist">
            <!-- If the user has not yet accepted friend request of the authenticated user -->
            @if(Auth::user()->hasFriendRequestPending($user))
            <p> Waiting for {{ $user->getNameOrUsername() }} to accept your friend request. </p>

            <!-- If the user has receive a friend request from this current user, show accept friend request button -->
            @elseif (Auth::user()->hasFriendRequestReceived($user))
            <a href="{{ route('friend.accept', ['username' => $user->username]) }}" class="btn btn-primary">Accept friend request</a>

            <!-- If the authenticated user is already friends with the user -->
            @elseif(Auth::user()->isFriendsWith($user))
            <p>You and {{ $user->getNameOrUsername() }} are friends.</p>

            <!-- If none of the above and the user in not on his own profile page, show the add friend button -->
            @elseif(Auth::user()->id !== $user->id)
            <a href="{{ route('friend.add', ['username' => $user->username]) }}" class="btn btn-primary">Add as friend </a>
            @endif

            <div class="block-background" style="margin-top: 0; box-shadow: none">
                <h4>{{ $user->getFirstNameOrUsername() }}'s friendlist</h4><hr>
                @if (!$user->friends()->count())
                <p>{{ $user->getFirstNameOrUsername() }} has no friends.</p>        
                @else
                @foreach ($user->friends() as $user)
                <div class="friend-list">
                    @include('user.partials.userblock')<hr>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@stop 