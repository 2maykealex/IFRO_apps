<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Area;

class Course extends Model
{    
    public $timestamps = false;

    protected $fillable = ['descricao'];

    public function area(){
        return $this->belongsTo(Area::class);
        
    }

    public function courseNew($dados):Array {

        $this->area_id     = $dados['area_id'];
        $this->name        = $dados['name'];
        $this->qtSem       = $dados['qtSem'];
        $this->chCourse    = $dados['chCourse'];
        $this->modalidade  = $dados['modalidade'];
        $this->chMin       = $dados['chMin'];

        $course = $this->save();

        if ($course)
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
