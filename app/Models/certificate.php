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

    public function rejected(){
        return $this->hasOne(ReasonRejected::class);
    }

    public function certificateNew($data):Array {

        $this->person_id             = $data['person_id'];
        $this->activity_id           = $data['activity_id'];
        $this->description           = $data['description'];
        $this->local                 = $data['local'];
        $this->period                = $data['period'];
        $this->chCertificate         = $data['chCertificate'];
        $this->certificateValided    = $data['certificateValided'];
        $this->image                 = $data['image'];
        $this->linkValidation        = $data['linkValidation'];
        $this->validationCode        = $data['validationCode'];

        $certificate = $this->save();

        if ($certificate)
            return [
                'success' => true,
                'message' => 'Novo certificado foi cadastrado com sucesso!'
            ];

        return [
            'success' => false,
            'message' => 'Não foi possível realizar este cadastro. Verifique!'
        ];
    }
    public function certificateUpdate($data):Array {

        $this->exists = true;
        $this->id  = $data['certId'];

        $this->person_id             = $data['person_id'];
        $this->activity_id           = $data['activity_id'];
        $this->description           = $data['description'];
        $this->local                 = $data['local'];
        $this->period                = $data['period'];
        $this->chCertificate         = $data['chCertificate'];
        $this->certificateValided    = $data['certificateValided'];

        if(isset($data['image'])){
            $this->image                 = $data['image'];
        }
        
        $this->linkValidation        = $data['linkValidation'];
        $this->validationCode        = $data['validationCode'];

        $certificate = $this->update();

        if ($certificate)
            return [
                'success' => true,
                'message' => 'O certificado foi atualizado com sucesso!'
            ];

        return [
            'success' => false,
            'message' => 'Não foi possível atualizar este certificado. Verifique!'
        ];
    }
}
