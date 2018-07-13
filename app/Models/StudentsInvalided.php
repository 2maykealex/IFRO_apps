<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsInvalided extends Model
{
    public function newStudentInvalided($data):Array{
        
        $this->coord_user_id = $data['coord_user_id'];
        $this->name          = $data['name'];
        $this->cpf           = $data['cpf'];
        $this->telefones     = $data['telefones'];
        $this->registration  = $data['registration'];
        $this->group         = $data['group'];
        $this->status        = $data['status'];   
        
        $updated = $this->save();

        if ($updated){
            return [
                $this->id
            ];
        }
    }
}
