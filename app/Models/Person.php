<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\User;

class Person extends Model
{

    public function importPeople($users, $people, $students):Array {
        
        $count = count($students);

        for ($x = 1; $x <= 3 ; $x++){
            $user   = new User;
            $studs  = new Student;
            $person = new Person;
            $profileAccess = new UserProfile;

            $user->name       =  $users[$x][0];
            $user->email      =  $users[$x][1];
            $user->password   =  bcrypt($users[$x][2]);
            $user->image      =  "";

            $user->save();
            
            $lastId = $user->id;

            $profileAccess->user_id = $lastId;
            $profileAccess->profile_access_id = 2;  //perfil: site

            // dd($profileAccess);
            $profileAccess->save();

            $person->user_id    =  $lastId;        //Count(User::all()) + 1;
            $person->course_id  =  $people[$x][2];
            $person->name       =  $people[$x][0];
            $person->cpf        =  $people[$x][1];            
            $person->telefones  =  $people[$x][3];
            
            $person->save();

            $lastId = $person->id;

            $studs->person_id    = $lastId;
            $studs->registration = $students[$x][0];
            $studs->group        = $students[$x][1];
            $studs->status       = $students[$x][2];

            // dd($students[$x][0]);
            
            $studs->save();

            


            // echo $user->name.'<br>';
            // $studs  = $this->save();
        }

        if ($user)
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
}
