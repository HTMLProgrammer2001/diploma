<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = ['name', 'description', 'date'];

    //relations
    public function user(){
        return $this->belongsTo(User::class);
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
