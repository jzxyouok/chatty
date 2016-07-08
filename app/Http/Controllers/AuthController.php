<?php

namespace Chatty\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Chatty\Models\User;
use Chatty\Models\DisplayPicture;
use Illuminate\Http\Request;

Class AuthController extends Controller {

    public function getSignup() {
        return view('auth.signup');
    }

    /* Signs up a user */
    public function postSignup(Request $request) {
        $this->validate($request, [
            'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
        ]);
        
        /* create the user data in the database */
        $new_user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        /* Create a default picture for the user. the user can change it later  */
        $new_user->displayPicture()->create([
            'filename' => 'default_dp.jpg',
        ]);
        
        /* return a redirect to the home route with the appropiate message */
        return redirect()
                ->route('home')
                ->with('info', 'Your account has been created, you can now log in!');
    }
    
    /* returns the sign in view */
    public function getSignin() {
        return view('auth.signin');
    }
    
    public function postSignin (Request $request) {
        
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if(!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->back()->with('info', 'Wrong credentials');
        }
        
        return redirect()->route('home')->with('info', 'You are now signed in!');
        
    }
    
    public function getSignout() {
        Auth::logout();
        return redirect()->route('home')->with('info', 'You are now signed out!');
    }

}
