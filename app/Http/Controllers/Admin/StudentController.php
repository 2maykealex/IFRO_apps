<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Person;
use App\Models\Activity;
use App\Models\Certificate;
use App\Models\Course;
use App\User;

class StudentController extends Controller
{

    public function importExcel(){        
        return view('admin.student.import');
    }

    public function importExcelStore(Request $request){

        $userCoord = auth()->user(); 
        $personCoord = Person::where('user_id', $userCoord->id)->get()->first();


        $filename = $_FILES['fileStudents']['tmp_name'];
        $handle = fopen("$filename", "r");
        
        $row = 1;
        $studentsInvalided = Array();

        while (($emapData = fgetcsv($handle, 10000, ";")) !== FALSE){
            $num = count($emapData);
            // dd($emapData);

            if (filter_var($emapData[11], FILTER_VALIDATE_EMAIL)){

                $email = $emapData[11];
                $name      = $emapData[0]; 
                $nameArray = explode(" ", $name);      //transforma a string em array
                $firstName = $nameArray[0];                   //Obtendo o primeiro nome do array criado
                $cpf       = $emapData[5];
                $cpf = trim($cpf);
                $cpf = str_replace(".", "", $cpf);
                $password  = md5($cpf);

                $users[$row][0] = $firstName;
                $users[$row][1] = $email;
                $users[$row][2] = $password;    
                
                $people[$row][0] = $name;  //name
                $people[$row][1] = $cpf;
                $people[$row][2] = $personCoord->course_id;     // Id do curso do Coordenador Logado
                $people[$row][3] = trim($emapData[12]);  //explode(";", $emapData[12]) ;               // Telefones

                $students[$row][0] = $emapData[13];   //matrícula
                $students[$row][1] = $emapData[17];   //última turma vinculada

                //STATUS
                if ($emapData[18] == 'MATRICULADO'){
                    $students[$row][2] = 1;   //MATRICULADO
                } else {
                    $students[$row][2] = 0;   //TRANCADO/EVADIDO/OUTROS
                }
                
            } else{
                //recebe os dados que não estão completos para inserir aluno por importação
                //fazer filtragem dos campos que interessa
                $studentsInvalided [$row] = $emapData;
            }
            //fazer a inserção na model
            
            $row++;
            
        }

        // dd($students);
        fclose($handle);
        
        return view('admin.student.import', ["users" => $users, "people" => $people, "students" => $students,  "studentsInvalideds" => $studentsInvalided]);
    }

    public function newStudent(){

        $courses = Course::with('area')->get();
        return view('admin.student.new', compact('courses'));
    }

    public function student(){
        $student = Student::find(1)::with(['person'])->get()->first();

        // echo $student->person->name.'<br>';
        // echo $student->person->address.'<hr>';
        
        dd($student);
    }

    public function students(){ 
        $students = Student::with(['person'])->get();

        // dd($students);s

        // return view('admin.student.students', compact('students') );
        return view('admin.student.students', compact('students') );
    }

    public function uploadCertificate(){
        $user = auth()->user();  //verificar para puxar Person e Student através do User Logado

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = Activity::all();

        $student = Student::with(['person' , 'course'])->get();

        $value = 0;
        
        // dd($person);

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

        //dd($activityData);

        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->get()->first();

        $data['person_id'] = $person->id;  //add no final de $data   
        
        $activity = Activity::where('id', $activityData)->get()->first();

        isset($data['linkValidation']) ?  : '';

        isset($data['linkValidation']) ? $data['linkValidation'] : '';

        if($data['chCertificate'] > $activity->CHAtividade ){  //verifica se as horas colocadas no certifado é maior que o permitido por item
            $data['chCertificate'] = $activity->CHAtividade;   //caso seja maior, é colocado somente a hora máxima de uma atividade
        }

        // $certificate = new Certificate;
        
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

    public function certificatesPending(){
        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = [];

        // $certificates = Certificate::all();        
        
        // $activities   = Certificate::with(['activity'])->get();        
        $certificates = Certificate::with(['activity'])->orderby('description')->get();        
        
        $certificates = $certificates->where('person_id', $person->id);

        $personActivities = Certificate::where('person_id', $person->id)->where('certificateValided', 0)
                                                                        ->orderby('activity_id') 
                                                                        ->get();

                                                                        

        //Para poder obter os ids das atividades que já possuem certificados (sem repetição)
        $count = 0;
        $lastId = 0;

        foreach ($personActivities as $personActivity){
            if ($lastId != $personActivity->activity->id){
                $activities[$personActivity->activity->id] = $personActivity->activity->descricao;
            }

            $lastId = $personActivity->activity->id;
            $count = $count + 1;
        }
        
        $count = 0;
        $soum  = 0;
        $idActivity = isset($certificates[0]->activity_id) ? $certificates[0]->activity_id : '';
        // dd($nextActivity);


        return view('admin.student.certificates', compact(['person', 'certificates', 'activities', 'idActivity', 'count','soum']));
    }

    public function certificatesAccepted(){
        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = [];

        // $certificates = Certificate::all();        
        
        // $activities   = Certificate::with(['activity'])->get();        
        $certificates = Certificate::with(['activity'])->orderby('description')->get();        
        
        $certificates = $certificates->where('person_id', $person->id);

        $personActivities = Certificate::where('person_id', $person->id)->where('certificateValided', 1)
                                                                        ->orderby('activity_id') 
                                                                        ->get();

                                                                        

        //Para poder obter os ids das atividades que já possuem certificados (sem repetição)
        $count = 0;
        $lastId = 0;

        foreach ($personActivities as $personActivity){
            if ($lastId != $personActivity->activity->id){
                $activities[$personActivity->activity->id] = $personActivity->activity->descricao;
            }

            $lastId = $personActivity->activity->id;
            $count = $count + 1;
        }
        
        $count = 0;
        $soum  = 0;
        $idActivity = isset($certificates[0]->activity_id) ? $certificates[0]->activity_id : '';


        return view('admin.student.certificatesAccepted', compact(['person', 'certificates', 'activities', 'idActivity', 'count','soum']));
    }

    public function certificatesRejected(){
        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = [];

        $certificates = Certificate::with(['activity'])->get();        
        
        $certificates = $certificates->where('person_id', $person->id);

        $personActivities = Certificate::where('person_id', $person->id)->where('certificateValided', 2)->get();

        

        //Para poder obter os ids das atividades que já possuem certificados (sem repetição)
        $count = 0;
        $lastId = 0;

        foreach ($personActivities as $personActivity){
            if ($lastId != $personActivity->activity->id){
                $activities[$personActivity->activity->id] = $personActivity->activity->descricao;
            }

            $lastId = $personActivity->activity->id;
            $count = $count + 1;
        }

        $count = 0;
        $soum  = 0;
        $idActivity = $certificates[0]->activity_id;


        return view('admin.student.certificatesRejected', compact(['person', 'certificates', 'activities', 'idActivity', 'count','soum']));
    }

    
}
