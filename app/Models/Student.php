<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function person(){
        return $this->morphOne(Person::class, 'personable');
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
