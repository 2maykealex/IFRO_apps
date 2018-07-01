<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    public function newCoordinator($data):Array{

        $coordinator = new Coordinator;
        
        $coordinator->registration  = $data['registration'];
        $coordinator->person_id     = $data['person_id'];

        $updated = $coordinator->save();

        // dd($user->id);

        if ($updated){
            return [
                $coordinator->id
            ];
        }
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

}
