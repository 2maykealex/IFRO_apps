<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;

    public function activityNew($dados):Array {
        //dd($this);

        $this->descricao    = $dados['descricao'];
        $this->CHAtividade  = $dados['ch_activity'];
        $this->CHItem       = $dados['ch_item'];

        $activity = $this->save();

        if ($activity)
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
