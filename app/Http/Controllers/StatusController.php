<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Illuminate\Http\Request;

use App\Http\Requests;

class StatusController extends Controller {
    public function postStatus(Request $request) {
    	//Uncomment when validation and flash messages are added
    	/*$this->validate($request, [
    		'status' => 'required|max:1000'
    	]);*/

		Auth::user()->statuses()->create([
			'body' => $request->input('status'),
		]);

		return Redirect::route('home');
    }


}
