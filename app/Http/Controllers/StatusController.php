<?php

namespace Chatty\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Chatty\Models\User;
use Chatty\Models\Status;
use Illuminate\Http\Request;

Class StatusController extends Controller {

	/* post a status */
	public function postStatus(Request $request) {
		
		$this->validate($request,[
			'status' => 'required|max:1000',
		]);

		Auth::user()->statuses()->create([
			'body' => $request->input('status'),
		]);

		return redirect()
			->route('home')
			->with('info', 'Status Posted');

	}

	/* Reply to a status */
	public function postReply(Request $request, $statusId) {

		$this->validate($request,[
			"reply-{$statusId}" => 'required|max:1000',
		], [
			'required' => 'You must type a reply first!'
		]);

		/* find the status that we need to reply to */
		$status = Status::notReply()->find($statusId); 

		// If the status does not exist return to home
		if(!$status) {
			return redirect()->route('home');
		}

		// If the currently authenticated user is not friends with the owner 
		// of the status or does not own the status himself then don't allow
		// him to reply to the status...
		if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id) {
			return redirect()->route('home');
		} 

		// associate() works from the belongsTo side of the relationship
		// a particular reply is associated with the user who made that
		$reply = Status::create([
			'body' => $request->input("reply-{$statusId}"),
		])->user()->associate(Auth::user());

		$status->replies()->save($reply);

		return redirect()->back();

	}

	/* delete a status or a reply. If it is a status delete associated replies */
	public function deleteReply($statusId) {

		$status = Status::find($statusId);
		if(!$status) {
			return redirect()->route('home');
		}

		if($status->user->id !== Auth::user()->id) {
			return redirect()->route('home');
		}

		$replies = Status::where('parent_id', $statusId)->get();

		if($replies) {
			foreach ($replies as $reply) {
				$reply->delete();
			}
		}

		$status->delete();
		return redirect()->back();
		

	}

	public function editReply($statusId) {

		$status = Status::find($statusId);
		if(!$status) {
			return redirect()->route('home');
		}

		if($status->user->id !== Auth::user()->id) {
			return redirect()->route('home');
		}

		return view('timeline.edit')->with('status', $status);
	}

	public function postEditReply (Request $request, $statusId) {

		$this->validate($request,[
			"edit-{$statusId}" => 'required|max:1000',
		], [
			'required' => 'This field can not be left blank'
		]);

		$status = Status::find($statusId);
		$status->body = $request->input("edit-{$statusId}");
		$status->update();
		return redirect()->route('home');

	}

	public function getLike ($statusId) {

		$status = Status::find($statusId);

		/*
		** If the status does not exist or the authenticated user 
		** is not friends with the status user or the user has already
		** liked the status yet, redirect back to the previous page
		*/
		if(
			!$status ||
			!Auth::user()->isFriendsWith($status->user) ||
			Auth::user()->hasLikedStatus($status)
			) {
			return redirect()->back();
		}

		$like = $status->likes()->create([]);
		Auth::user()->likes()->save($like);

		return redirect()->back();

	}

	/* dislike a status */ 
	public function getDislike($statusId) {

		$status = Status::find($statusId);

		/*
		** If the status does not exist or the authenticated user 
		** is not friends with the status user or the user has not
		** liked the status yet, redirect back to the previous page
		*/
		if(
			!$status ||
			!Auth::user()->isFriendsWith($status->user) ||
			!Auth::user()->hasLikedStatus($status)
			)
	    {
			return redirect()->back();
		}

		$status->likes()->delete();
		return redirect()->back();
	}

}