<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Input;
use App\User;
use Auth;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Http\Requests;

class SearchController extends Controller {
 	
	public function getResults() {
		$user = Auth::user();
		$id = $user->id;
		$query = Input::get('query');

		if(!$query) {
			return Redirect::route('home');
		}

		$users = User::where('firstname','LIKE','%'.$query.'%', 'AND', 'id', ' != '.$id)->get(['id', 'firstname', 'lastname']);
		$total_count = $users->count();


		return View::make('results', array(
			'users' => $users
		));
	}

}
