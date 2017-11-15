<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['user_id', 'message'];

    protected $with = ['user'];


    public function user(){
        return $this->belongsTo('App\User');
    }

}
