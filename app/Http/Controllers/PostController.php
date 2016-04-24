<?php

namespace App\Http\Controllers;

use Auth;
use Input;
use Redirect;
use App\Posts;
use App\Status;
use App\Events;
use App\Publication;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller {
    public function postStatus(Request $request) {
    	//Uncomment when validation and flash messages are added
    	/*$this->validate($request, [
    		'status' => 'required|max:1000'
    	]);*/

		/*Auth::user()->statuses()->create([
			'body' => $request->input('status'),
		]);*/
		$user_id = Auth::user()->id;
		$post = new Posts;
		$post->user_id = $user_id;
		$post->type = 0;
		$post->save();

		$status = new Status;
		$status->post_id = $post->id;
		$status->body = $request->input('status');
		$status->save();

		return Redirect::route('home');
    }
     public function postEvent(Request $request) {
    	//Uncomment when validation and flash messages are added
    	/*$this->validate($request, [
    		'status' => 'required|max:1000'
    	]);*/

		/*Auth::user()->statuses()->create([
			'body' => $request->input('status'),
		]);*/
		
		//dd( $request->input('event_date'));
		$time = $request->input('event_date')." ".$request->input('time').":00";

		$user_id = Auth::user()->id;
		$post = new Posts;
		$post->user_id = $user_id;
		$post->type = 1;
		$post->save();

		$event = new Events;
		$event->post_id = $post->id;
		$event->name = $request->input('name');
		$event->date_time = $time;
		$event->location = $request->input('location');
		$event->description = $request->input('description');
		$event->save();

		
		return Redirect::route('home');
    }
    public function postPublication(Request $request) {

    	$input = Input::all();
    	//dd($input);

    	$file = array_get($input,'file');
        // SET UPLOAD PATH

        $destinationPath = 'uploads';
        // GET THE FILE EXTENSION

        $extension = $file->getClientOriginalExtension();
        // RENAME THE UPLOAD WITH RANDOM NUMBER

        $fileName = rand(11111, 99999) . '.' . $extension;
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY

        $upload_success = $file->move($destinationPath, $fileName);
        
        // IF UPLOAD IS SUCCESSFUL SEND SUCCESS MESSAGE OTHERWISE SEND ERROR MESSAGE
        if ($upload_success) {
        	$user_id = Auth::user()->id;
			$post = new Posts;
			$post->user_id = $user_id;
			$post->type = 2;
			$post->save();

			$event = new Publication;
			$event->post_id = $post->id;
			$event->name = $request->input('name');
			$event->url = $fileName;
			$event->description = $request->input('description');
			$event->save();

            return Redirect::route('home');
        }

		return Redirect::route('home');
    }


}
