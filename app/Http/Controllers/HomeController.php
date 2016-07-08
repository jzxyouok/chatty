<?php

namespace Chatty\Http\Controllers;

use Auth;
use Chatty\Models\Status;

Class HomeController extends Controller {
    
    /* Return the home view of the user.
     * If the user is logged in return their timeline
     * else retrn a default welcome view.  */
    public function index() {

    	if(Auth::check()) {

            /* Load the statuses of the current logged in user and user's friends and pass them to the view */
            $statuses = Status::notReply()->where(function($query) {
                return $query->where('user_id', Auth::user()->id)
                    ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

    		return view('timeline.index')
                ->with('statuses', $statuses);
    	}
    	
        return view('home');
    }
}
