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

                $email = $emapData[11];
                $name      = utf8_encode($emapData[0]); 
                $nameArray = explode(" ", $name);      //transforma a string em array
                $firstName = $nameArray[0];                   //Obtendo o primeiro nome do array criado
                $cpf       = $emapData[5];
                $cpf = trim($cpf);
                $cpf = str_replace(".", "", $cpf);
                $cpf = str_replace("-", "", $cpf);

                $password  = $cpf;

                $users[$row][0] = $firstName;
                $users[$row][1] = $email;
                $users[$row][2] = $password;    
                
                $people[$row][0] = $name;  //name
                $people[$row][1] = $cpf;
                $people[$row][2] = $personCoord->course_id;     // Id do curso do Coordenador Logado
                $people[$row][3] = trim(utf8_encode(substr($emapData[12], 0,99)));  //explode(";", $emapData[12]) ;               // Telefones

                $students[$row][0] = $emapData[13];   //matrícula
                $students[$row][1] = $emapData[17];   //última turma vinculada

                //STATUS
                if ($emapData[18] == 'MATRICULADO'){
                    $students[$row][2] = 1;   //MATRICULADO
                } else {
                    $students[$row][2] = 0;   //TRANCADO/EVADIDO/OUTROS
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
        
        $update = $importPeople->importPeople($users, $people, $students);

        return redirect()->route('admin.students')->with('success', 'Alunos importados com sucesso!');

        // return view('admin.student.import', ["users" => $users, "people" => $people, "students" => $students,  "studentsInvalideds" => $studentsInvalided]);
    }

    public function newStudent(){
        $courses = Course::with('area')->get();
        return view('admin.student.new', compact('courses'));
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
