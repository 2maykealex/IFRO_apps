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
}
