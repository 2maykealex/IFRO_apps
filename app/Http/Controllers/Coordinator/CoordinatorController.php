<?php

namespace App\Http\Controllers\Coordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Coordinator;

class CoordinatorController extends Controller
{
    public function signStore(Request $request){
        $data = $request->all();

        // dd($data);

        $coordinator = new Coordinator;
    }
    
    public function home(){
        $user = auth()->user();
        $person = Person::where('user_id', $user->id)->get()->first();
        $coordinator = Coordinator::with('person')->where('person_id', $person->id)->get()->first();

        // dd($coordinator->person->course);   

        return view('coordinator.home.home', compact('coordinator'));
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

    // public function course(){ 
    //     $coordinators = Coordinator::with(['people' , 'course'])->get();

    //     dd($coordinators);
    // }
}
