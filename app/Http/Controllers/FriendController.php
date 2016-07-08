<?php

namespace Chatty\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Chatty\Models\User;
use Illuminate\Http\Request;

Class FriendController extends Controller {

    public function getIndex() {

        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequest();

        return view('friends.index')
                        ->with('friends', $friends)
                        ->with('requests', $requests);
    }

    /* Add an user as friend */
    public function getAdd($username) {
    	/* First, retreive the user using the username */
        $user = User::where('username', $username)->first();

        /* Check if the user exists, if not, redirect to the home page */
        if(!$user){
        	return redirect()
        		->route('home')
        		->with('info', 'User not found!');
        }

        /* Check if a friend request is already pending either from the authenticated user or the user */
        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
        	return redirect()
	        	->route('profile.index', ['username' => Auth::user()->username])
	        	->with('info', 'Friend request already pending!');
        }

        /* Prevent a user to send himself a friend request */
        if(Auth::user()->id === $user->id) {
        	return redirect()->route('home');
        }

        /* If the users are already friends, don't let them add each other again */
        if(Auth::user()->isFriendsWith($user)) {
        	return redirect()
	        	->route('profile.index', ['username' => Auth::user()->username])
	        	->with('info', 'You are already friends!');
        }

        /* If everything is ok, add the user as friend to the authenticated user. */
        Auth::user()->addFriend($user);

        return redirect()
	        	->route('profile.index', ['username' => $user->username])
	        	->with('info', 'Friend request sent!');

    }

    /* Accept a friend request */ 
    public function getAccept($username) {

    	/* First, retreive the user using the username */
        $user = User::where('username', $username)->first();

        /* Check if the user exists, if not, redirect to the home page */
        if(!$user){
        	return redirect()
        		->route('home')
        		->with('info', 'User not found!');
        }

        /* first check whether the user actually has received a friend request */
        if(!Auth::user()->hasFriendRequestReceived($user)) {
        	return redirect()->route('home');
        }

        // Accept the friend request then redirect the user
        Auth::user()->acceptFriendRequest($user);

        return redirect()
        	->route('profile.index', ['username' => $username])
        	->with('info', 'Friend request accepted.');

    }

}
