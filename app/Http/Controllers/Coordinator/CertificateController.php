<?php

namespace App\Http\Controllers\Coordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Person;
use App\Models\Coordinator;
use App\Models\Activity;
use App\Models\Certificate;
use App\Models\ReasonRejected;
use App\Models\Course;
use App\User;
use Illuminate\Support\Facades\DB;

class CertificateController extends Controller
{
    public function checkChComplete(){       //listar todos os alunos que sua carga horária APROVADA, atinja ou ultrapasse 
                                             //a carga horária que cada curso exige
        $students = DB::select(
            DB::raw('SELECT P.id, S.registration, P.name as "studentName", c.name as "courseName", S.group as "group"

                FROM (SELECT person_id, SUM(chCertificate) as ch FROM certificates 
                        WHERE certificateValided = 1 GROUP BY person_id) as T

                inner join people as P on P.id = T.person_id 
                inner join students as S on S.person_id = T.person_id  
                inner join courses as C on C.id = P.course_id  
                
                WHERE (T.ch >= C.chMin)
                ORDER BY S.group, P.name
            ')
        );
        
        return view('coordinator.reports.studendsForCollation', compact('students'));        
    }

    public function upload(){
        $user = auth()->user();  //verificar para puxar Person e Student através do User Logado

        $person = Person::where('user_id', $user->id)->get()->first();

        $course = $person->course_id;

        $students = Student::with(['person' => function($q) use($course) {
            $q->where('course_id', $course);
        }])
        ->get()->sortBy('person.name');

        $activities = Activity::all();

        // $student = Student::with(['person'])->get();

        $value = 0;

        return view('coordinator.certificate.upload', compact(['students', 'person', 'activities', 'value']));
    }
    public function validateCertificate( $id, $value){
    
        $certificateId = $id;
        $op            = $value;

        $data = Certificate::where('id', $certificateId)->get()->first();

        $data->certificateValided = $op;
        
        $update = $data->save();

        if ($update){
            
            return redirect()->route('coordinator.certificates', ['accepted', ''])->with('success', 'O certificado foi aprovado!');
        }
    }
    public function rejectCertificate(Request $request){
        
        $certificateId = $request->idCert;
        $op            = $request->operation;
        
        $data = Certificate::where('id', $certificateId)->get()->first();

        $data->certificateValided = $op;
        
        $update = $data->save();

        if ($update){

            $reason = new ReasonRejected;

            $reason->certificate_id = $certificateId;
            $reason->description    = $request->reason;
            
            $updateReason = $reason->save();

            if ($updateReason){
                return redirect()->route('coordinator.certificates', ['rejected', ''])->with('error', 'O certificado foi rejeitado!');
            }            
        }
    }
    public function certificateStore(Request $request, Certificate $certificate){

        $data = $request->all();

        $activityData = $data['activity_id'];

        // dd($data);

        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->get()->first();

        $data['person_id'] = $data['idStudent']; //$person->id;  //add no final de $data   
        
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
        
        $data['certificateValided'] = 1;  //Já aceita o certificado automáticamente ao fazer o UPLOAD

        $update = $certificate->certificateNew($data);

        return redirect()->route('coordinator.certificates', ['accepted', ''])->with('success', 'Certificado carregado com sucesso!');

    }
    public function attestationReport($id){

        $userCoord = auth()->user();
        $person = Person::where('user_id', $userCoord->id)->get()->first();
        
        $coordinator = Coordinator::with(['person'])->where('person_id', $person->id)->get()->first();

        $students = Student::with(['person' => function($q) use($id) {
            $q->where('id', $id)
              ->with('course');
        }])
        ->get();

        foreach ($students as $student){
            if ($student->person){
                break;
            }
        }
    
        $certificates = Certificate::where('person_id',$student->person->id)->with(['activity', 'person'])->orderby('description')->get();        

        $activities = [];
        
        $personActivities = Certificate::where('certificateValided', 1)->orderby('activity_id') 
                                                                       ->get();
                 
        $count = 0;
        $lastId = 0;
        $color = '#D8D8D8';
        $lastKey = 0;

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

        setlocale(LC_TIME, 'portuguese'); 
        date_default_timezone_set('America/Manaus');
        $date = date('Y-m-d');
        $date = strftime("%d de %B de %Y", strtotime($date));

        return view('coordinator.reports.attestationReport', compact(['id','coordinator', 'student', 'certificates', 'activities', 'idActivity', 'count','soum', 'color', 'lastKey', 'date']));
    }
    public function listCertificates($status, $id = 0){
        if ($status == 'pending'){
            $valided = 0;
        } else if ($status == 'accepted'){
            $valided = 1;
        } else if ($status == 'rejected' ){
            $valided = 2;
        }else{
            return redirect()->back()->with('error', 'Este local não existe no sistema!');
        }

        $user = auth()->user();       

        $person = Person::where('user_id', $user->id)->get()->first();

        $course = $person->course_id;

        $students = Student::with(['person' => function($q) use($course) {
            $q->where('course_id', $course);
        }])
        ->get()->sortBy('person.name');


        if ($id == 0){
            $certificates = Certificate::with('person', 'activity')->whereHas('person', function($query) use($course) {
                $query->where('course_id', $course);
            } )
            ->where('certificateValided', $valided)
            ->orderby('activity_id') 
            ->get();  

        } else {
            $certificates = Certificate::with('person', 'activity', 'rejected')->whereHas('person', function($query) use($course, $id) {
                $query->where('course_id', $course)
                      ->where('id',$id);
            } )
            ->where('certificateValided', $valided)
            ->orderby('activity_id') 
            ->get();  
        }

        //Para poder obter os ids das atividades que já possuem certificados (sem repetição)
        $activities = [];
        foreach ($certificates as $certificate){
            $activities[$certificate->activity->id] = $certificate->activity->descricao;
        }

        $count = 0;
        $soum  = 0;
        $idActivity = isset($certificates[0]->activity_id) ? $certificates[0]->activity_id : '';

        if ($valided == 0){
            return view('coordinator.certificate.certificates', compact(['id', 'activities', 'students', 'person', 'certificates', 'count','soum']));
        }else if ($valided == 1){
            return view('coordinator.certificate.accepted', compact(['id', 'activities', 'students', 'person', 'certificates', 'count','soum']));
        }
        else if ($valided == 2){
            return view('coordinator.certificate.rejected', compact(['id', 'activities', 'students', 'person', 'certificates', 'count','soum']));
        }
    }

}