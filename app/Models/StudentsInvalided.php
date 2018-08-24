<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsInvalided extends Model
{
    public function newStudentInvalided($data):Array{

        $user = StudentsInvalided::where('cpf', $data['cpf'])->where('registration', $data['registration'])->get()->first(); //verifica se existe o email de novo usuário no banco 
        
        if (!$user){
            $this->coord_user_id = $data['coord_user_id'];
            $this->name          = $data['name'];
            $this->cpf           = $data['cpf'];
            $this->telefones     = $data['telefones'];
            $this->course_id     = $data['course_id'];
            $this->registration  = $data['registration'];
            $this->group         = $data['group'];
            $this->status        = $data['status'];   
            
            $updated = $this->save();

            if ($updated){
                return [
                    $this->id
                ];
            }
        } else{
            return [0];
        }
    }
}
