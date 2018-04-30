<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    public function person(){
        return $this->morphOne(Person::class, 'personable');
    }

    public function people(){
        return $this->morphMany(Person::class, 'personable');
    }

}
