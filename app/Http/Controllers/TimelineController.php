<?php

namespace App\Http\Controllers;

use View;
use Auth;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class TimelineController extends Controller {
    
	public function getIndex() {
		$user = Auth::user();
		/*$statuses = Post::where(function($query) {
				return $query->where('user_id', Auth::user()->id)->orWhereIn('user_id', Auth::user()->followersofmine()->lists('id'));
			})
			->orderBy('created_at', 'desc')
			->get();
	*/
		return View::make('timeline.index', array(
			'user' => $user,
			
		));
	}

}
