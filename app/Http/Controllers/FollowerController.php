<?php

namespace App\Http\Controllers;

use View;
use Auth;
use Redirect;
use App\User;
use App\Follower;
use App\College;
use App\Department;
use App\Position;
use Illuminate\Http\Request;

use App\Http\Requests;

class FollowerController extends Controller {
    
	public function getIndex() {
		$id = Auth::user()->id;

		$details =  User::whereId($id)->get()->first();

		if(!$details) {
			abort(404);
		}

		//Get college name
		$details->college = College::whereId($details->college)->get(['name'])->first()->name;
		//Get department name
		$details->department = Department::whereId($details->department)->get(['name'])->first()->name;
		//Get position name
		$details->position = Position::whereId($details->position)->get(['name'])->first()->name;

		$followers = User::join('followers', 'users.id', '=', 'followers.user_id')->where('followers.follower_id', '=', $id)->get();
		$followers->map(function($follower) {
			$follower->id = $follower->user_id;
			//Get college name
			$follower->college = College::whereId($follower->college)->get(['name'])->first()->name;
			//Get department name
			$follower->department = Department::whereId($follower->department)->get(['name'])->first()->name;
			//Get position name
			$follower->position = Position::whereId($follower->position)->get(['name'])->first()->name;
		});
		$new_followers = User::join('followers', 'users.id', '=', 'followers.user_id')->where('followers.follower_id', '=', $id)->where('seen', false)->get();
		$new_followers->map(function($follower) {
			$follower->id = $follower->user_id;
		});

		//dd($followers);
		return View::make('followers.index', array(
			'user' => $details,
			'followers' => $followers,
			'new_followers' => $new_followers,
		));
	}
	public function follow($id) {
		$current_user = Auth::user()->id;
		$user_to_follow = User::where('id', $id)->first()->id;

		if(!$user_to_follow) {
			return Redirect::route('timeline.index');
		}

		//check if already following
		$check = Follower::where('user_id', $current_user)->where('follower_id', $user_to_follow)->get();
		if($check->count() != 0) {
			return Redirect::route('profile.index', array(
				'id' => $id
			));
		}

		$new_follower = new Follower;
		$new_follower->user_id = $current_user;
		$new_follower->follower_id = $user_to_follow;
		$new_follower->seen = false;
		$new_follower->save();

		return Redirect::route('profile.index', array(
			'id' => $id,
		));
	}

	public function acknowledge($id) {
		$current_user = Auth::user()->id;
		$user_to_follow = User::where('id', $id)->first()->id;

		if(!$user_to_follow) {
			return Redirect::route('timeline.index');
		}

		$check = Follower::where('user_id', $current_user)->where('follower_id', $user_to_follow)->get();
		if($check->count() == 0) {
			return Redirect::route('followers.index');
		}
		else {
			$updated_follower = Follower::where('user_id', $user_to_follow)->where('follower_id', $current_user)->update(array('seen' => true));

			return Redirect::route('followers.index');
		}

		//
		//return Redirect::route('profile.index', array())
	}
}
