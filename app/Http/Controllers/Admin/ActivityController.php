<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AtividadesComplementares;

class ActivityController extends Controller
{
    public function index(){
        $activities = AtividadesComplementares::all();
        //var_dump($activities);
        return view('admin.activity.index', compact('activities'));
    }

    public function activities(){
        $activities = AtividadesComplementares::all();

        

        return view('admin.activity.index', compact('activities'));

    }
}
