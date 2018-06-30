<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\User;

class Person extends Model
{

    public function newPerson($data):Array{

        $person = new Person;

        // dd($data);

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

    public function importPeople($users, $people, $students):Array {
        
        $count = count($students);

        for ($x = 1; $x <= 2 ; $x++){
            $user   = new User;
            $studs  = new Student;
            $person = new Person;
            $profileAccess = new UserProfile;

            $user->name       = strtoupper($users[$x][0]);
            $user->email      =  $users[$x][1];
            $user->password   =  bcrypt($users[$x][2]);
            $user->image      =  "";

            $salvedUser = $user->save();
            
            $lastId = $user->id;

            $profileAccess->user_id = $lastId;
            $profileAccess->profile_access_id = 2;  //perfil: site

            // dd($profileAccess);
            $salvedProfileAccess = $profileAccess->save();

            $person->user_id    =  $lastId;        //Count(User::all()) + 1;
            $person->course_id  =  $people[$x][2];
            $person->name       =  strtoupper($people[$x][0]);
            $person->cpf        =  $people[$x][1];            
            $person->telefones  =  strtoupper($people[$x][3]);
            
            $person->save();

            $lastId = $person->id;

            $studs->person_id    = $lastId;
            $studs->registration = $students[$x][0];
            $studs->group        = $students[$x][1];
            $studs->status       = $students[$x][2];

            // dd($students[$x][0]);
            
            $salvedStudents = $studs->save();

            


            // echo $user->name.'<br>';
            // $studs  = $this->save();
        }

        if ($salvedUser and $salvedProfileAccess and $salvedStudents)
            return [
                'success' => true,
                'message' => 'Nova atividade foi cadastrada com sucesso!'
            ];

        return [
            'success' => false,
            'message' => 'Não foi possível realizar este cadastro. Verifique!'
        ];

        // dd($person);

        // foreach ($people as $person){


        //     $this->area_id     = $dados['area_id'];
        //     $this->name        = $dados['name'];
        //     $this->qtSem       = $dados['qtSem'];
        //     $this->chCourse    = $dados['chCourse'];
        //     $this->modalidade  = $dados['modalidade'];
        // }

        

        // $course = $this->save();

        // if ($course)
        //     return [
        //         'success' => true,
        //         'message' => 'Nova atividade foi cadastrada com sucesso!'
        //     ];

        // return [
        //     'success' => false,
        //     'message' => 'Não foi possível realizar este cadastro. Verifique!'
        // ];
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
