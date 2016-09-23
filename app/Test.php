<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    public function answer(){
        return $this->hasMany('App\Answer');
    }

    public function userTest(){
        return $this->hasMany('App\UserTest');
    }

    public function course(){
        return $this->belongsTo('App\Course');
    }

}
