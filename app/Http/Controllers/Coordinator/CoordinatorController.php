<?php

namespace App\Http\Controllers\Coordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoordinatorController extends Controller
{
    public function index(){
        return view('coordinator.home.index');
    }

    public function coordinator(){
        $coordinator = Coordinator::find(1)::with('person')->get()->first();

        echo $coordinator->person->name.'<br>';
        echo $coordinator->person->address.'<hr>';
        
        dd($coordinator);
    }

    public function coordinators(){ 
        $coordinators = Coordinator::with(['person'])->get();
        return view('admin.coordinator.coordinators', compact('coordinators') );
    }

    public function course(){ 
        $coordinators = Coordinator::with(['people' , 'course'])->get();

        dd($coordinators);
    }
}
