<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    public function person(){
        return $this->morphOne(Person::class, 'personable');
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function people(){
        return $this->morphMany(Person::class, 'personable');
    }

}
