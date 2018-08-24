<?php

namespace App\Http\Controllers\Coordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Person;
use App\Models\Activity;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\UserProfile;
use App\Models\StudentsInvalided;
use App\User;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function teste(){
        return "teste";
    }

    
    public function importExcel(){        
        return view('coordinator.student.import');
    }

    public function importExcelStore(Request $request, Person $importPeople){

        $userCoord = auth()->user(); 
        $personCoord = Person::where('user_id', $userCoord->id)->get()->first();

        $filename = $_FILES['fileStudents']['tmp_name'];
        $handle = fopen("$filename", "r");
        
        $count = 1;
    
        $studentsInvalided = Array();

        while (($emapData = fgetcsv($handle, 10000, ";")) !== FALSE){

            if ($emapData[0] != "" and $emapData[5] != "" and $emapData[13] != "" and $emapData[17] != "") {
                $num = count($emapData);

                $name         = utf8_encode($emapData[0]); 
                $nameArray    = explode(" ", $name);             //transforma a string em array
                $firstName    = $nameArray[0];                   //Obtendo o primeiro nome do array criado
                $cpf          = $emapData[5];
                $cpf          = trim($cpf);
                $cpf          = str_replace(".", "", $cpf);
                $cpf          = str_replace("-", "", $cpf);


                $telefones    = explode(";", $emapData[12]);  // cria array de telefones

                $telefone = trim(str_replace("Celular", "", $telefones[0])); //Remove String "Celular" e espaços
            
                $telefones    = trim(utf8_encode($telefone));   //
                
                // dd($telefones);

                $telefones    = str_replace(";", " / ", $telefones);
                
                $registration = $emapData[13];   //matrícula
                $group        = $emapData[17];          //última turma vinculada;

                //STATUS
                if ($emapData[18] == 'MATRICULADO'){
                    $status = 1;   //MATRICULADO
                } else {
                    $status = 0;   //TRANCADO/EVADIDO/OUTROS
                }

                if (filter_var($emapData[11], FILTER_VALIDATE_EMAIL)){

                    $newUser        = new User;
                    $newStuds       = new Student;
                    $newPerson      = new Person;
                    $newUserProfile = new UserProfile;

                    $email = $emapData[11];                

                    $password  = bcrypt($cpf);

                    $users['name']     = $firstName;
                    $users['email']    = $email;
                    $users['password'] = $password;    
                    $users['image']    = 'default_user.png';    

                    $newUserId   = $newUser->newUser($users);

                    // dd($newUserId);
                    
                    if($newUserId[0] > 0){  
                        $person['name']      = $name;  //name
                        $person['cpf']       = $cpf;
                        $person['course_id'] = $personCoord->course_id;     // Id do curso do Coordenador Logado
                        $person['telefones'] = $telefones;
                        $person['user_id']   = $newUserId[0];

                        $newPersonId   = $newPerson->newPerson($person); 

                        if ($newPersonId){
                            $student['person_id']    = $newPersonId[0];   //matrícula
                            $student['registration'] = $registration;
                            $student['group']        = $group;
                            $student['status']       = $status;

                            $newStudentId   = $newStuds->newStudent($student);   //mudar para Person

                            if ($newStudentId){

                                $UserProfile['user_id']            = $newUserId[0];
                                $UserProfile['profile_access_id']  = 2;  //2 = site

                                $newUserProfile_id = $newUserProfile->newUserProfile($UserProfile);
                            }
                        }
                    }
                
                    $count++;
                        
                } else{
                    //recebe os dados que não estão completos ao inserir aluno por importação
                    $newStudentInvalided = new StudentsInvalided;

                    $notValided['coord_user_id'] = $userCoord->id;
                    $notValided['name']          = $name;
                    $notValided['cpf']           = $cpf;
                    $notValided['telefones']     = $telefones;
                    $notValided['course_id']     = $personCoord->course_id;
                    $notValided['registration']  = $registration;
                    $notValided['group']         = $group;
                    $notValided['status']        = $status;

                    $newStudentInvalided_id = $newStudentInvalided->newStudentInvalided($notValided);
                }   
            }      
            
        }
        
        fclose($handle);

        // dd($studentsInvalided);

        return redirect()->route('coordinator.students')->with('success', 'Alunos importados com sucesso!');
    }

    public function studentStore(Request $request){
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
        $user['image']            = 'default_user.png';               //ajustar para imagem default  -- o aluno alterará sua imagem depois

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

                $newStudent = new Student;
                
                $student['registration']   = $data['registration'];
                $student['group']          = $data['group'];
                $student['status']         = 1;            //matriculado
                $student['person_id']      = $newPersonId[0];            //matriculado

                $newStudentId = $newStudent->newStudent($student);

                if ($newStudentId){

                    $newUserProfile = new UserProfile;

                    $UserProfile['user_id']            = $newUserId[0];
                    $UserProfile['profile_access_id']  = 2;  //2 = site

                    $newUserProfile_id = $newUserProfile->newUserProfile($UserProfile);

                    if ($newUserProfile_id){
                    
                        if (isset($data['studentInvalid'])){
                            $studentInvalided = StudentsInvalided::where('id', $data['studentInvalid'])->get()->first();

                            $deleteStudentInvalided = $studentInvalided->delete();

                            if ($deleteStudentInvalided){
                                return redirect()->route('coordinator.students')->with('success', 'Cadastrado com sucesso!');
                            }
                        }

                        return redirect()->route('coordinator.students')->with('success', 'Cadastrado com sucesso!');
                    }                    
                }
            }
        }
    }

    public function newStudent($student=0){
        $userCoord = auth()->user(); 
        $personCoord = Person::where('user_id', $userCoord->id)->get()->first();
        $course = $personCoord->course_id;

        if ($student > 0){
            $student = StudentsInvalided::where('id', $student)->get()->first();
        }

        // dd($course);
        return view('coordinator.student.new', compact('course', 'student'));
    }

    public function student(){
        $student = Student::find(1)::with(['person'])->get()->first();
    }

    public function students($group="", $id=0){ 

        $user = auth()->user();       

        $person = Person::where('user_id', $user->id)->get()->first();

        $course = $person->course_id;

        $students = Student::with(['person' => function($q) use($course) {
            $q->where('course_id', $course);
        }])
        ->get()->sortBy('person.name');

        if ($group != ""){
            $students = $students->where('group', $group);
        }

        $groups = DB::select(
            DB::raw('SELECT DISTINCT `group` FROM `students` ORDER BY `group` DESC
            ')
        );        

        return view('coordinator.student.students', compact('students','groups','group') );
    }

    public function studentsinvalided(){ 

        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->with('course')->get()->first();

        $courseName = $person->course->name;

        $course = $person->course_id;
        $count = 1;

        $students = StudentsInvalided::where('coord_user_id', $user->id)->orderBy('name')->get();
        
        return view('coordinator.student.StudentsInvalided', compact('students', 'courseName', 'count') );
    }

    public function uploadCertificate(){
        $user = auth()->user();  //verificar para puxar Person e Student através do User Logado

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = Activity::all();

        $student = Student::with(['person' , 'course'])->get();

        $value = 0;

        return view('coordinator.student.uploadCertificate', compact(['person', 'activities', 'value']));
    }

    public function validateCertificate($id, $value){

        $data = Certificate::where('id', $id)->get()->first();

        $data->certificateValided = $value;

        $data->save();

        if ($value == 1){
            return redirect()->route('coordinator.student.certificatesAccepted');
        }else if($value == 2){
            return redirect()->route('coordinator.student.certificatesRejected');
        }
        
    }

    public function certificateStore(Request $request, Certificate $certificate){

        $data = $request->all();

        $activityData = $data['activity_id'];

        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->get()->first();

        $data['person_id'] = $person->id;  //add no final de $data   
        
        $activity = Activity::where('id', $activityData)->get()->first();

        isset($data['linkValidation']) ?  : '';

        isset($data['linkValidation']) ? $data['linkValidation'] : '';

        if($data['chCertificate'] > $activity->CHAtividade ){  //verifica se as horas colocadas no certifado é maior que o permitido por item
            $data['chCertificate'] = $activity->CHAtividade;   //caso seja maior, é colocado somente a hora máxima de uma atividade
        }
        
        if($request->hasFile('image') && $request->file('image')->isValid() ){
            
            $date = date('Y-m-d-H-i');

            $name = $person->id.'-'.kebab_case($date);
            //dd($name);
            $extension = $request->image->extension();
            $nameFile  = "{$name}.{$extension}";

            $data['image'] = $nameFile;
            $upload = $request->image->storeAs('certificates', $nameFile);

            if(!$upload)
                return redirect()->back()->with('error', 'Falha ao carregar a imagem do certificado!');

        }   
        
        $update = $certificate->certificateNew($data);

        return redirect()->route('coordinator.student.certificates')->with('success', 'Certificado carregado com sucesso!');
        // return redirect()->back()->with('success', 'Certificado carregado com sucesso!');

    }
}
