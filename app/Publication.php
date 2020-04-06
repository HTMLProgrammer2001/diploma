<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public $fillable = ['title', 'description', 'another_authors'];

    //relations
    public function authors(){
        return $this->belongsToMany(User::class, 'users_publications', 'publication_id');
    }

    public function setDateOfPublicationAttribute($date){
        if(!$date)
            $this->attributes['date_of_publication'] = null;
        else{
            $formattedDate = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
            $this->attributes['date_of_publication'] = $formattedDate;
        }
    }

    public function getDateOfPublicationAttribute(){
        if(!$this->attributes['date_of_publication'])
            return null;

        $formattedDate = Carbon::createFromFormat('Y-m-d', $this->attributes['date_of_publication'])
            ->format('m/d/Y');
        return $formattedDate;
    }

    //helpers
    public function setAuthors($ids){
        if(!$ids || !sizeof($ids))
            return;

        $this->authors()->sync($ids);
        $this->save();
    }

    public function getAuthorsString(){
        $names = [];
        foreach ($this->authors as $author)
            $names[] = $author->getShortName();

        $authorsStr = implode(', ', $names);

        if($this->another_authors)
            $authorsStr .= ', ' . $this->another_authors;

        return $authorsStr;
    }
}
