<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class certificate extends Model
{
    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function activity(){
        return $this->belongsTo(Activity::class);
    }

    public function certificateNew($data):Array {

        // dd($data);
        // var_dump($data);
        $this->person_id             = $data['person_id'];
        $this->activity_id           = $data['activity_id'];
        $this->description           = $data['description'];
        $this->chCertificate         = $data['chCertificate'];
        $this->certificateValided    = $data['certificateValided'];
        $this->image                 = $data['image'];
        $this->linkValidation        = $data['linkValidation'];
        $this->validationCode        = $data['validationCode'];

        $certificate = $this->save();

        if ($certificate)
            return [
                'success' => true,
                'message' => 'Nova atividade foi cadastrada com sucesso!'
            ];

        return [
            'success' => false,
            'message' => 'Não foi possível realizar este cadastro. Verifique!'
        ];
    }
}
