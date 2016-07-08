<?php

namespace Chatty\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Chatty\Models\User;
use Illuminate\Http\Request;

Class SearchController extends Controller {

    public function getResults(Request $request) {

        $query = $request->input('query');

        if (!$query) {
            return redirect()->route('home');
        }
       
        if(strlen($query) < 3) {
            return redirect()->route('home')->with('info', 'The search string must be of 3 characters or more!');
        }
        $users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
                ->orWhere('username', 'LIKE', "%{$query}%")
                ->get();
        
        return view('search.results')->with('users', $users);
    }

}
