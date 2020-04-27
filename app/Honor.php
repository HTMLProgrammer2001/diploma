<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    public $fillable = ['order', 'title'];

    //relations
    public function user(){
        return $this->belongsTo(User::class);
    }

    //accessors
    public function setDatePresentationAttribute($date){
        if(!$date)
            $this->attributes['date_presentation'] = null;
        else{
            $formattedDate = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
            $this->attributes['date_presentation'] = $formattedDate;
        }
    }

    public function getDatePresentationAttribute(){
        if(!$this->attributes['date_presentation'])
            return null;

        $formattedDate = Carbon::createFromFormat('Y-m-d', $this->attributes['date_presentation'])
            ->format('m/d/Y');
        return $formattedDate;
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
        $this->active = $value;
    }

    public function setUser($user_id){
        if(!$user_id)
            return;

        $this->user()->associate(User::find($user_id));
    }
}
