<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Linkedin;
use Config;
use Response;
use Carbon;
use View;
use App\User;
use App\College;
use App\Department;
use App\Position;
use App\Posts;
use App\Status;
use App\Events;
use App\Publication;
use \Auth;
use Redirect;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Http\Requests;

class UserController extends BaseController {

	public function index() {
		if ( Auth::check() ) {
			$posts = Posts::where(function($query) {
				return $query->where('user_id', Auth::user()->id)->orWhereIn('user_id', Auth::user()->followersofmine()->lists('id'));
			})
			->orderBy('created_at', 'desc')
			->get();

			$posts->map(function ($post) {
				//dd($status->id);
				if($post->type == 0) {
					$status_details = Status::where('post_id', $post->id)->get(['body'])->first();
					$post['body'] = $status_details->body;
				}
				else if($post->type == 1) {
					$status_details = Events::where('post_id', $post->id)->get()->first();
					$pieces = explode(" ", $status_details->date_time);
					//dd($pieces);
					$post['name'] = $status_details->name;
					$post['date'] = $pieces[0];
					$post['time'] = $pieces[1];
					$post['location'] = $status_details->location;
					$post['description'] = $status_details->description;

					//$lec_date = Carbon::createFromTimeStamp( strtotime( $status_details->date_time ) )->diffForHumans();
					//dd($lec_date);
				}
				else if($post->type == 2) {
					$status_details = Publication::where('post_id', $post->id)->get()->first();
					//dd($pieces);
					$post['name'] = $status_details->name;
					$post['url'] = $status_details->url;
					$post['description'] = $status_details->description;
				}
			});
			//dd($posts);
			return View::make('timeline.index', [
				'user' => Auth::user(),
				'statuses' => $posts,
			]);
		}
		return view('home');
	}

	public function user() {
		if(Auth::check()){
			$profile = Input::get('id');
			if(!empty($profile)) {
				$id = $profile;
			}
			else {
				$id = Auth::user()->id;
			}
			$details =  User::whereId($id)->get()->first();

			//Get college name
			$details->college = College::whereId($details->college)->get(['name'])->first()->name;
			//Get department name
			$details->department = Department::whereId($details->department)->get(['name'])->first()->name;
			//Get position name
			$details->position = Position::whereId($details->position)->get(['name'])->first()->name;

			$response = array(
				'status' => 'logged_in',
				'user' => array(
					'id' => $details->id,
					'firstname' => $details->firstname,
					'lastname' => $details->lastname,
					'profilephoto' => $details->profilephoto==null?"img/default_profile_photo.jpg":$details->profilephoto,
					'email' => $details->email,
					'phone' => $details->phone,
					'college' => $details->college,
					'department' => $details->department,
					'position' => $details->position
				)
			);


			return Response::json($response)->setCallback(Input::get('callback'));
		}else{
			return Response::json(['status'=>'not_logged_in'])->setCallback(Input::get('callback'));
		}
	}
    public function login() {
    	$code = Input::get('code');
    	if (!$code) {
	        /*// If we don't have an authorization code, get one
	        $return_details = array(
				'response' => 'failure',
				'reason' => 'user not authenticated'
			);
	        return Response::json($return_details)->setCallback(Input::get('callback'));*/
	        $provider = new Linkedin(Config::get('services.linkedin'));
	        $provider->authorize();
	    } else {
			$provider = new Linkedin(Config::get('services.linkedin'));
	        // Try to get an access token (using the authorization code grant)
	        $t = $provider->getAccessToken('authorization_code', array('code' => $code));
	        try {
	        	//Get user details
	            $resource = '/v1/people/~';
	            $params = array('oauth2_access_token' => $t->getToken(), 'format' => 'json');
	            $url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
	            $context = stream_context_create(array('http' => array('method' => 'GET')));
	            $response = file_get_contents($url, false, $context);
	            $data = json_decode($response);

	            $resource2 = '/v1/people/~:(email-address,picture-url,public-profile-url,picture-urls::(original))';
	            $params = array('oauth2_access_token' => $t->getToken(), 'format' => 'json');
	            $url2 = 'https://api.linkedin.com' . $resource2 . '?' . http_build_query($params);
	            $context2 = stream_context_create(array('http' => array('method' => 'GET')));
	            $response2 = file_get_contents($url2, false, $context2);
	            $data2 = json_decode($response2);

	            //dd($data2);
	            //return Redirect::to('/')->with('data',$data);
			    //return Response::json($data)->setCallback(Input::get('callback'));
			    $user = User::where('linkedin_id', '=', $data->id)->get();

			    if($user->count() == 0) {
			    	$user = new User;
			    	$user->linkedin_id = $data->id;
			    	$user->save();
			    	return View::make('linkedin_login_complete', array(
						'firstName' => $data->firstName,
						'lastName' => $data->lastName,
						'id' => $data->id,
						'profilePictureLarge' => $data2->pictureUrls->values[0],
						'profilePictureSmall' => $data2->pictureUrl,
						'emailAddress' => $data2->emailAddress,
						'linkedinProfile' => $data2->publicProfileUrl,
						'page' => 'signup',
					));
			    }
			    else {
				    if($user[0]['attributes']['email'] == null || $user[0]['attributes']['phone']==null || $user[0]['attributes']['college']==null || $user[0]['attributes']['department']==null || $user[0]['attributes']['position']==null){
				    	//$result = User::where('linkedin_id', '=', $data->id)->get(['email']);
				    	//dd($result[0]['attributes']['email']);
				    	return View::make('linkedin_login_complete', array(
							'firstName' => $data->firstName,
							'lastName' => $data->lastName,
							'id' => $data->id,
							'profilePictureLarge' => $data2->pictureUrls->values[0],
							'profilePictureSmall' => $data2->pictureUrl,
							'emailAddress' => $data2->emailAddress,
							'linkedinProfile' => $data2->publicProfileUrl,
							'page' => 'signup',
						));
				    }
				    else {
				    	$user = $user->first();
				    	//dd($user);
				    	Auth::loginUsingId($user->id);
				    	return Redirect::route('home');
				    }		
				}	    	
	            
	        } catch (Exception $e) {
	            $return_details = array(
					'response' => 'failure',
					'reason' => 'Unable to get user details'
				);
			    return Response::json($return_details)->setCallback(Input::get('callback'));
	        }

	        /*} catch (Exception $e) {
	            $return_details = array(
					'response' => 'failure',
					'reason' => 'Unable to get access token'
				);
			    return Response::json($return_details)->setCallback(Input::get('callback'));
	        }*/
	    }
    }
    public function linkedinCompletePost() {

    	$user = User::where('linkedin_id', '=', Input::get('linkedin_id'))->first();
    	$user->firstname = Input::get('firstname');
    	$user->lastname = Input::get('lastname');
    	$user->email = Input::get('email');
    	$user->phone = Input::get('phone');
    	$user->college = Input::get('college');
    	$user->department = Input::get('department');
    	$user->position = Input::get('position');
    	$user->linkedinURL = Input::get('linkedin');
    	$user->facebookURL = Input::get('facebook');
    	$user->save();

    	Auth::loginUsingId($user->id);
    	return Redirect::route('home');
    }

    public function logout(){
		Auth::logout();

		return Redirect::route('home');
	}

	public function users() {
		//Make sure user is logged in.
		if(Auth::check()){
			$user =  Auth::user();
			$id = $user->id;
		}
		else {
			return Response::json(['result'=>'fail', 'reason'=>'not_logged_in'])->setCallback(Input::get('callback'));
		}

		$query = Input::get('q', '');

		if(strlen($query) >= 2){
		

			$users = User::where('firstname','LIKE','%'.$query.'%', 'AND', 'id', ' != '.$id);


			
			$users = $users->get(['id', 'firstname', 'lastname']);
			$total_count = $users->count();
		}else{
			$total_count = 0;
			$users = [];
			return Response::json([
				'result' => 'too_small_query'
				])->setCallback(Input::get('callback'));
		}
		//dd('firstname','LIKE','%'.$query.'% AND id != '.$id);
		$users->each(function($user){
			$user->full_name = $user->firstname." ".$user->lastname;

			return $user;
		});

		return Response::json([
			'total_count' => $total_count,
			'id' => $id,
			'users' => $users
			])->setCallback(Input::get('callback'));
	}

}
