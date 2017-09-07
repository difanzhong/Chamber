<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
	protected $fillable = ['title', 'type', 'imgURI', 'text', 'link', 'created_at', 'updated_at'];

    protected $table = 'homePage';

}
