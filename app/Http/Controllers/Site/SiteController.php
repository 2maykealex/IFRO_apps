<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Student;
use App\Models\Coordinator; 
use App\User;

class SiteController extends Controller
{
    public function home(){
        return view('site.home.home');
    }

    public function index(){

        $user = auth()->user();

        if (isset($user)){
            return redirect()->route('check-user');
        }
        
        return view('site.home.index');
    }

    public function checkUser(){  //Após efetuar o login é redirecionado pra cá e checa se é Student ou Coordinator

        $user = auth()->user();

        if ($user == null){
            return view('site.home.index');
        } else {
            
            $person = Person::where('user_id', $user->id)->get()->first();

            $student = Student::with('person')->where('person_id', $person->id)->get()->first();        
            
            $coordinator = Coordinator::with('person')->where('person_id', $person->id)->get()->first();
    
            if ($student != null){
                return redirect()->route('site.home');       //Redireciona para a rota de Student
            } else {
                return redirect()->route('admin.home');      //Redireciona para a rota de Coordinator
            }

        }

    }

    
}
