<?php

namespace App;
use App\College;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
	use Authenticatable;

	protected $table = 'users';

	protected $fillable = [
		'firstname',
		'lastname',
		'email',
		'phone',
		'college',
		'department',
		'position',
		'linkedinURL',
		'facebookURL',

	];

	public function fullname() {
		if($this->firstname && $this->lastname) {
			return $this->firstname." ".$this->lastname;
		}
		return null;
	}   

	public function followers() {
		return $this->belongsToMany('App\User', 'followers', 'user_id', 'follower_id');
	} 

	public function followersofmine() {
		return $this->belongsToMany('App\User', 'followers', 'user_id', 'follower_id')->get();
	}

	public function followerof() {
		return $this->belongsToMany('App\User', 'followers', 'follower_id', 'user_id')->get();
	}

	public function newfollowers() {
		return $this->join('followers', 'users.id', '=', 'followers.user_id')->where('followers.follower_id', '=', $this->id)->where('seen', false)->get();
	}
	
	public function acknowledgefollower(User $user) {
		return $this->newfollowers()->where('id', $user->id)->first()->update([
			'seen' => true,
		]);
	}

	public function youareafollower(User $user) {
		
		return (bool) $this->join('followers', 'users.id', '=', 'followers.user_id')->where('followers.user_id', $this->id)->where('followers.follower_id', $user->id)->get()
		->count();
	}
	public function isafollower(User $user) {
		return (bool) $this->join('followers', 'users.id', '=', 'followers.user_id')->where('followers.user_id', $user->id)->get()
		->count();
	}

}
