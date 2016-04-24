<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {
    
	protected $table = 'status_posts';

	protected $fillable = [
		'body'
	];

}
