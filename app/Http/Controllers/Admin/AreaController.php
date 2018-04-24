<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;

class AreaController extends Controller
{
    public function courses(){
        $area = Area::find(1);

        echo $area->descricao.'<hr>';
        
        $courses = $area->courses;

        foreach ($courses as $course){
            echo ' - '.$course->name.'<br>';
        }

        // dd($area);
    }
}
