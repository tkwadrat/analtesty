<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function test(){
        return $this->belongsTo('App\Test');
    }

    public function question(){
        return $this->belongsTo('App\Question');
    }
}
