<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    const QUALIFICATIONS = ['Молодший спеціаліст', 'Бакалавр', 'Магістр'];

    protected $table = 'educations';

    public $fillable = ['institution', 'graduate_year', 'qualification'];

    //relations
    public function user(){
        return $this->belongsTo(User::class);
    }

    //helpers
    public function setUser($id){
        if(!$id)
            return;

        $this->user()->associate($id);
    }

    public function getUserID(){
        if(!$this->user)
            return;

        return $this->user->id;
    }

    public function getUserName(){
        if(!$this->user)
            return;

        return $this->user->getShortName();
    }
}
