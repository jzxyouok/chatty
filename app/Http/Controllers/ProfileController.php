<?php

namespace Chatty\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Chatty\Models\User;
use Chatty\Models\displayPicture;
use Storage;
use File;
use Response;
use Image;
use Illuminate\Http\Request;

Class ProfileController extends Controller {

    public function getProfile($username) {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        $statuses = $user->statuses()->notReply()->orderBy('created_at', 'desc')->get();

        return view('profile.index')
                        ->with('user', $user)
                        ->with('statuses', $statuses)
                        ->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
    }

    public function getEdit() {
        return view('profile.edit');
    }

    public function postEdit(Request $request) {

        $this->validate($request, [
            'first_name' => 'alpha|max:50',
            'last_name' => 'alpha|max:50',
            'location' => 'max:20'
        ]);

        Auth::user()->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location'),
        ]);
        
        return redirect()->route('profile.edit')->with('info', 'Your profile has been successfully updated!');
    }

    public function getAdd($username) {
        dd($username);
    }

    /* upload a profile picture */
    public function uploadPicture(Request $request) {
        
        /* if no image file is selected, redirect back to the previous page */
        if(!$request->hasFile('dp')) {
            return redirect()->back()->with('info', 'No image is selected!');
        }

        /* validate whether the file is an image */
        $this->validate($request, [
            'dp' => 'required|image|max:1024',
        ]);

        $dp = $request->file('dp');

        /* set the filename */
        $filename = Auth::user()->id.'_'.str_random(6).'.jpg';
                
        /* store and redirect */
        Storage::put('user_image/'.$filename, file_get_contents($dp));

        $name = Auth::user()->displayPicture->filename;

        /* If the user has already uploaded an image, which is not the default image, delete it */
        if($name !== 'default_dp.jpg') {
            Storage::delete('user_image/'.$name);
        }

        /* store the name of the picture in the database */
        Auth::user()->displayPicture()->update([
            'filename' => $filename,
        ]);

        return redirect()->back()->with('info', 'Image successfully uploaded!');
    }

    /* retrive an user picture from the storage */
    public function displayPicture ($filename) {

        // get the complete storage path from the filename
        $path = storage_path().'\app\user_image\\'.$filename;

        // get the file from specified path
        $image = File::get($path);

        // if the specified image doesnot exist, abort with a 404
        if(!File::exists($path)) {
            abort(404);
        }

        // determine the mimi type of the file
        $type = File::mimeType($path);

        // create the response, set the header and return the response
        $response = Response::make($image, 200);
        $response->header('Content-Type', $type);
        return $response;
    }


}
