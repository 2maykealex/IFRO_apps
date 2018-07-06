<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Person;
use App\Models\Activity;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\UserProfile;
use App\User;

class StudentController extends Controller
{

    public function importExcel(){        
        return view('admin.student.import');
    }

    public function importExcelStore(Request $request, Person $importPeople){

        $userCoord = auth()->user(); 
        $personCoord = Person::where('user_id', $userCoord->id)->get()->first();

        $filename = $_FILES['fileStudents']['tmp_name'];
        $handle = fopen("$filename", "r");
        
        $row = 1;
        $studentsInvalided = Array();

        while (($emapData = fgetcsv($handle, 10000, ";")) !== FALSE){
            $num = count($emapData);

            if (filter_var($emapData[11], FILTER_VALIDATE_EMAIL)){

                $newUser   = new User;
                $newStuds  = new Student;
                $newPerson = new Person;
                $newUserProfile = new UserProfile;

                $email = $emapData[11];
                $name      = utf8_encode($emapData[0]); 
                $nameArray = explode(" ", $name);      //transforma a string em array
                $firstName = $nameArray[0];                   //Obtendo o primeiro nome do array criado
                $cpf       = $emapData[5];
                $cpf = trim($cpf);
                $cpf = str_replace(".", "", $cpf);
                $cpf = str_replace("-", "", $cpf);

                $password  = bcrypt($cpf);

                $users['name']     = $firstName;
                $users['email']    = $email;
                $users['password'] = $password;    
                $users['image']    = '';    

                $newUserId   = $newUser->newUser($users);
                
                if($newUserId){
                    $person['name'] = $name;  //name
                    $person['cpf'] = $cpf;
                    $person['course_id'] = $personCoord->course_id;     // Id do curso do Coordenador Logado
                    $person['telefones'] = trim(utf8_encode(substr($emapData[12], 0,99)));  //explode(";", $emapData[12]) ;               // Telefones
                    $person['user_id'] = $newUserId[0];

                    $newPersonId   = $newPerson->newPerson($person); 

                    if ($newPersonId){
                        $student['person_id']    = $newPersonId[0];   //matrícula
                        $student['registration'] = $emapData[13];   //matrícula
                        $student['group']        = $emapData[17];   //última turma vinculada;

                        //STATUS
                        if ($emapData[18] == 'MATRICULADO'){
                            $student['status'] = 1;   //MATRICULADO
                        } else {
                            $student['status'] = 0;   //TRANCADO/EVADIDO/OUTROS
                        }

                        $newStudentId   = $newStuds->newStudent($student);   //mudar para Person

                        if ($newStudentId){

                            $UserProfile['user_id']            = $newUserId[0];
                            $UserProfile['profile_access_id']  = 2;  //2 = site

                            $newUserProfile_id = $newUserProfile->newUserProfile($UserProfile);
                        }
                    }
                }

                $row++;
                
            } else{
                //recebe os dados que não estão completos para inserir aluno por importação
                //fazer filtragem dos campos que interessa
                $studentsInvalided [$row] = $emapData;
            }
            //fazer a inserção na model            
        }
       
        // dd($studentsInvalided);
        
        fclose($handle);


        return redirect()->route('admin.students')->with('success', 'Alunos importados com sucesso!');



        // return view('admin.student.import', ["users" => $users, "people" => $people, "students" => $students,  "studentsInvalideds" => $studentsInvalided]);
    }

    public function studentStore(Request $request){
        $data = $request->all();

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
                        return redirect()->route('admin.students')->with('success', 'Cadastrado com sucesso!');
                    }
                }
            }
        }
    }

    public function newStudent(){
        $userCoord = auth()->user(); 
        $personCoord = Person::where('user_id', $userCoord->id)->get()->first();
        $course = $personCoord->course_id;

        // dd($course);
        return view('admin.student.new', compact('course'));
    }

    public function student(){
        $student = Student::find(1)::with(['person'])->get()->first();
    }

    public function students(){ 

        $user = auth()->user();       

        $person = Person::where('user_id', $user->id)->get()->first();

        $course = $person->course_id;

        $students = Student::with(['person' => function($q) use($course) {
            $q->where('course_id', $course);
        }])
        ->get()->sortBy('person.name');

        // dd($students);
        
        // $students = Student::with(['person'])->get();
        return view('admin.student.students', compact('students') );
    }

    public function uploadCertificate(){
        $user = auth()->user();  //verificar para puxar Person e Student através do User Logado

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = Activity::all();

        $student = Student::with(['person' , 'course'])->get();

        $value = 0;

        return view('admin.student.uploadCertificate', compact(['person', 'activities', 'value']));
    }

    public function validateCertificate($id, $value){

        $data = Certificate::where('id', $id)->get()->first();

        $data->certificateValided = $value;

        $data->save();

        if ($value == 1){
            return redirect()->route('admin.student.certificatesAccepted');
        }else if($value == 2){
            return redirect()->route('admin.student.certificatesRejected');
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

        return redirect()->route('admin.student.certificates')->with('success', 'Certificado carregado com sucesso!');
        // return redirect()->back()->with('success', 'Certificado carregado com sucesso!');

    }
    
}
