<?php

namespace App\Http\Controllers;

use Auth;
use View;
use Redirect;
use App\User;
use App\College;
use App\Department;
use App\Position;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller {
    
	public function getProfile($id) {

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

				$follower->college = College::whereId($follower->college)->get(['name'])->first()->name;
				//Get department name
				$follower->department = Department::whereId($follower->department)->get(['name'])->first()->name;
				//Get position name
				$follower->position = Position::whereId($follower->position)->get(['name'])->first()->name;
			});
			$following = User::join('followers', 'users.id', '=', 'followers.follower_id')->where('followers.user_id', '=', $id)->get();
			
			$following->map(function($followee) {
				$followee->id = $followee->follower_id;

				$followee->college = College::whereId($followee->college)->get(['name'])->first()->name;
				//Get department name
				$followee->department = Department::whereId($followee->department)->get(['name'])->first()->name;
				//Get position name
				$followee->position = Position::whereId($followee->position)->get(['name'])->first()->name;
			});

			return View::make('profile.index', array(
				'user' => $details,
				'followers' => $followers,
				'following' => $following,
			));

		
	}

}
