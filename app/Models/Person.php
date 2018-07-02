<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\User;

class Person extends Model
{

    public function newPerson($data):Array{

        $person = new Person;

        $person->course_id   = $data['course_id'];
        $person->user_id     = $data['user_id'];
        
        $person->name        = $data['name'];
        $person->cpf         = $data['cpf'];
        $person->telefones   = $data['telefones'];

        $updated = $person->save();

        if ($updated){
            return[$person->id];
        }
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function courses(){
        return $this->hasMany(Course::class)->with('');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
