<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coordinator;

class CoordinatorController extends Controller
{
    public function coordinator(){
        $coordinator = Coordinator::find(1)::with('person')->get()->first();

        echo $coordinator->person->name.'<br>';
        echo $coordinator->person->address.'<hr>';
        
        dd($coordinator);
    }

    public function coordinators(){ 
        $coordinators = Coordinator::with(['people' , 'course'])->get();

        // dd($coordinators);
        return view('admin.coordinator.coordinators', compact('coordinators') );
    }

    public function course(){ 
        $coordinators = Coordinator::with(['people' , 'course'])->get();

        dd($coordinators);
    }
}
