<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    public $fillable = ['order', 'title', 'date_presentation'];

    //relations
    public function user(){
        return $this->belongsTo(User::class);
    }

    //helpers
    public function getUserName(){
        if(!$this->user)
            return null;

        return $this->user->getShortName();
    }

    public function getUserID(){
        if(!$this->user)
            return null;

        return $this->user->id;
    }

    public function changeActive($value){
        $this->active = !!$value;
    }

    public function setUser($user_id){
        if(!$user_id)
            return;

        $this->user()->associate(User::find($user_id));
    }
}
