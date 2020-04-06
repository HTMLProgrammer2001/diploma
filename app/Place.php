<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public $fillable = ['name', 'address'];

    //relations
    public function internships(){
        $this->hasMany(Internship::class);
    }
}
