<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model {
    protected $table = 'posts';

    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
