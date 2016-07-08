@extends('templates.default')

@section('title')

Chatty | Search Results

@stop

@section('content')

<div class="col-md-8">
    <h3>Your search results for "{{ Request::input('query') }}"</h3><hr>
    @if (!$users->count())
    <h5>Sorry! No result found!</h5>
    @else
    <div class="row">
        @foreach ($users as $user)
            <div class="block-background">
                @include('user.partials.userblock')
                @if(!$user->friends()->count())
                    <p>Add friend</p>
                @else
                    <p>Already friends</p>
                @endif
            </div>
        @endforeach
    </div>
    @endif
</div>
@stop