<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coordinator;
use App\Models\Person;
use App\Models\Course;
use App\Models\UserProfile;
use App\User;

class CoordinatorController extends Controller
{
    public function coordinatorStore(Request $request){
        $data = $request->all();

        // dd($data);

        $name      = utf8_encode($data['name']); 
        $nameArray = explode(" ", $name);      //transforma a string em array
        $firstName = $nameArray[0];                   //Obtendo o primeiro nome do array criado

        $cpf = trim($data['cpf']);
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("-", "", $cpf);        
        
        $user['name']             = $firstName;
        $user['email']            = $data['email'];
        $user['password']         = bcrypt($cpf);
        $user['image']            =  "";

        $newUser = new User;
        $newUserId = $newUser->newUser($user);
        
        if ($newUserId){
        
            $newPerson = new Person;
            
            $person['name']           = $data['name'];
            $person['cpf']            = $cpf;
            $person['telefones']      = $data['telefones'];
            $person['course_id']      = $data['course_id'];
            $person['user_id']        = $newUserId[0];

            $newPersonId = $newPerson->newPerson($person);

            if ($newPersonId){

                $newCoordinator = new Coordinator;
                
                $coordinator['registration']   = $data['registration'];
                $coordinator['person_id']      = $newPersonId[0];            //matriculado

                $newCoordinatorId = $newCoordinator->newCoordinator($coordinator);

                if ($newCoordinatorId){

                    $newUserProfile = new UserProfile;

                    $UserProfile['user_id']            = $newUserId[0];
                    $UserProfile['profile_access_id']  = 1;  //1 = admin

                    $newUserProfile_id = $newUserProfile->newUserProfile($UserProfile);

                    if ($newUserProfile_id){
                        return redirect()->route('admin.coordinators')->with('success', 'Cadastrado com sucesso!');
                    }
                }
            }
        }
    }

    public function coordinatorNew(){

        $courses = Course::all();

        // dd($courses);
        return view('admin.coordinator.new', compact('courses'));
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
