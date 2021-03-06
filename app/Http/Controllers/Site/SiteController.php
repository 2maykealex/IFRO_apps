<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Student;
use App\Models\Coordinator; 
use App\User;
use Session;

class SiteController extends Controller
{
    public function logout(){
        Session::flush(); 
        return Redirect::to('/');
    }
    
    public function passwordStore(Request $request){

        $user = User::where('email', $request->email)->get()->first();

        $updateUser['password'] = bcrypt($request->password);

        $update = $user->changePassword($updateUser);

        if ($update){
            return redirect()->route('check-user')->with('success', 'Senha alterada com sucesso!');
        }        
    }

    public function changePassword($reason=0){

        $user = auth()->user();

        if ($reason == 1) {
            $user['reason'] = $reason;
        }

        return view('site.home.changePassword', compact('user'));
    }

    public function home(){

        $user = auth()->user();
        $person = Person::where('user_id', $user->id)->get()->first();
        $student = Student::where('person_id', $person->id)->get()->first();

        if ($user->created_at == $user->updated_at){
            return redirect()->route('change.password', 1);  //reason = 1
        } 
        return view('site.home.home', compact('student'));
    }

    public function index(){

        $user = auth()->user();

        if (isset($user)){
            return redirect()->back();
        }
        
        return view('site.home.index');
    }

    public function checkUser(){  //Após efetuar o login é redirecionado pra cá e checa se é Student ou Coordinator

        $user = auth()->user();

        $profile = $user->userProfile->profileAccess->name;  //retorna o perfil dele

        // dd($profile);

        if ($user == null){
            return view('site.home.index');
        } else {
            
            // $person = Person::where('user_id', $user->id)->get()->first();

            // $student = Student::with('person')->where('person_id', $person->id)->get()->first();        
            
            // $coordinator = Coordinator::with('person')->where('person_id', $person->id)->get()->first();


    
            if ($profile == "site"){
                return redirect()->route('site.home');             //Redireciona para a rota de Student
            } else if ($profile == "coordinator"){
                return redirect()->route('coordinator.home');      //Redireciona para a rota de Coordinator
            } else if ($profile == "admin"){
                return redirect()->route('admin.home');      //Redireciona para a rota de Admin
            }

        }
        

    }

    
}
