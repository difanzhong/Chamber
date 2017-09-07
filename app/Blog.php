<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [ 'title', 'thumbnail', 'event_date', 'display' ,'content', 'venue', 'created_at', 'updated_at' ];
}
