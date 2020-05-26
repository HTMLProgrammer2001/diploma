<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    public $fillable = ['title', 'hours', 'credits', 'code', 'from', 'to'];

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
    }

    public function setPlace($placeId){
        if(!$placeId)
            return;

        $this->place_id = $placeId;
    }

    public function setUser($userId){
        if(!$userId)
            return;

        $this->user_id = $userId;
    }

    public function getUserName(){
        if($this->user)
            return $this->user->getShortName();

        return null;
    }

    public function getCategoryName(){
        if($this->category)
            return $this->category->name;

        return 'Не встановлено';
    }

    public function getPlaceName(){
        if($this->place)
            return $this->place->name;

        return null;
    }

    public function getUserID(){
        if($this->user)
            return $this->user->id;
    }

    public function getCategoryID(){
        if($this->category)
            return $this->category->id;
    }

    public function getPlaceID(){
        if($this->place)
            return $this->place->id;
    }

    public function getUserShortName(){
        if($this->user)
            return $this->user->getShortName();
    }
}
