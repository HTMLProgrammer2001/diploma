<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    public $fillable = ['title', 'from', 'to', 'hours', 'credits'];

    //relations
    public function category(){
        return $this->belongsTo(InternCategory::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    //helpers
    public function setCategory($categoryId){
        if(!$categoryId)
            return;

        $this->category_id = $categoryId;
        $this->save();
    }

    public function setPlace($placeId){
        if(!$placeId)
            return;

        $this->place_id = $placeId;
        $this->save();
    }

    public function setUser($userId){
        if(!$userId)
            return;

        $this->user_id = $userId;
        $this->save();
    }
}
