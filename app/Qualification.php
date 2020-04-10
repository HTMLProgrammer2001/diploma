<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = ['name', 'description'];

    //relations
    public function user(){
        return $this->belongsTo(User::class);
    }

    //accessors
    public function setDateAttribute($date){
        if(!$date)
            $this->attributes['date'] = null;
        else{
            $formattedDate = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
            $this->attributes['date'] = $formattedDate;
        }
    }

    public function getDateAttribute(){
        if(!$this->attributes['date'])
            return null;

        $formattedDate = Carbon::createFromFormat('Y-m-d', $this->attributes['date'])->format('m/d/Y');
        return $formattedDate;
    }

    //helpers
    public function setUser($id){
        if(!$id)
            return;

        $this->user_id = $id;
    }

    public function getUserShortName(){
        if(!$this->user)
            return;

        return $this->user->getShortName();
    }

    public static function getQualificationNames(){
        return [
            'Учитель 1 категории',
            'Учитель 2 категории',
            'Учитель высшей категории'
        ];
    }
}
