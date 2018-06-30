<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function newStudent($data):Array{

        $student = new Student;
        
        $student->person_id     = $data['person_id'];
        $student->registration  = $data['registration'];
        $student->group         = $data['group'];
        $student->status        = $data['status'];
        $student->person_id     = $data['person_id'];

        $updated = $student->save();

        // dd($user->id);

        if ($updated){
            return [
                $student->id
            ];
        }
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }
    
}
