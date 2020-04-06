<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternCategory extends Model
{
    protected $table = 'internship_categories';

    public $fillable = ['name'];

    //relations
    public function internships(){
        return $this->hasMany(Internship::class);
    }
}
