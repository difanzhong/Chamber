<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = ['name','pinyin','e_name' ,'n_name','birthday' ,'birth_place',	'address','occupation','o_nationality' ,'c_nationality' ,'findus' ,'hobby' ,'contact' ,'mobile','email' ,'wechat'];
}
