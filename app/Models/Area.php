<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
