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

    public function newStudent(){

        $courses = Course::with('area')->get();
        return view('admin.student.new', compact('courses'));
    }

    public function student(){
        $student = Student::find(1)::with(['person', 'course'])->get()->first();

        // echo $student->person->name.'<br>';
        // echo $student->person->address.'<hr>';
        
        dd($student);
    }

    public function students(){ 
        $students = Student::with(['person' , 'course'])->get();

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

    public function acceptCertificate($id){

        $data = Certificate::where('id', $id)->get()->first();

        $data->certificateValided = 2;
    
        //dd($data);

        $data->save();

        return redirect()->back()->with('success', 'Certificado foi aceito com sucesso!');

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

    // public function certificatesAccepted(){
    //     $user = auth()->user();

    //     $person = Person::where('user_id', $user->id)->get()->first();

    //     $activities = [];

    //     // $certificates = Certificate::all();        
        
    //     // $activities   = Certificate::with(['activity'])->get();        
    //     $certificates = Certificate::with(['activity'])->get();        
        
    //     $certificates = $certificates->where('person_id', $person->id);

    //     $personActivities = Certificate::where('person_id', $person->id)->where('chCertificateValided', 1)->get();

        

    //     //Para poder obter os ids das atividades que já possuem certificados (sem repetição)
    //     $count = 0;
    //     $lastId = 0;

    //     foreach ($personActivities as $personActivity){
    //         if ($lastId != $personActivity->activity->id){
    //             $activities[$personActivity->activity->id] = $personActivity->activity->descricao;
    //         }

    //         $lastId = $personActivity->activity->id;
    //         $count = $count + 1;
    //     }

    //     // $count = 0;
    //     // foreach ($personActivities as $personActivity){
    //     //     //dd($personActivity->description);
    //     //     //dd($activities);
    //     //     if (!in_array($personActivity->activity->id, $activities)) {   //existe um valor no array
    //     //         $activities[$count] = $personActivity->activity->id;
                
    //     //         $count = $count + 1;
    //     //     }
    //     // }

    //     // dd($activities);

        
    //     $count = 0;
    //     $soum  = 0;
    //     $idActivity = $certificates[0]->activity_id;
    //     // dd($nextActivity);


    //     return view('admin.student.certificates.accepted', compact(['person', 'certificates', 'activities', 'idActivity', 'count','soum']));
    // }

    // public function certificatesRejected(){
    //     $user = auth()->user();

    //     $person = Person::where('user_id', $user->id)->get()->first();

    //     $activities = [];

    //     // $certificates = Certificate::all();        
        
    //     // $activities   = Certificate::with(['activity'])->get();        
    //     $certificates = Certificate::with(['activity'])->get();        
        
    //     $certificates = $certificates->where('person_id', $person->id);

    //     $personActivities = Certificate::where('person_id', $person->id)->where('chCertificateValided', 3)->get();

        

    //     //Para poder obter os ids das atividades que já possuem certificados (sem repetição)
    //     $count = 0;
    //     $lastId = 0;

    //     foreach ($personActivities as $personActivity){
    //         if ($lastId != $personActivity->activity->id){
    //             $activities[$personActivity->activity->id] = $personActivity->activity->descricao;
    //         }

    //         $lastId = $personActivity->activity->id;
    //         $count = $count + 1;
    //     }

    //     // $count = 0;
    //     // foreach ($personActivities as $personActivity){
    //     //     //dd($personActivity->description);
    //     //     //dd($activities);
    //     //     if (!in_array($personActivity->activity->id, $activities)) {   //existe um valor no array
    //     //         $activities[$count] = $personActivity->activity->id;
                
    //     //         $count = $count + 1;
    //     //     }
    //     // }

    //     // dd($activities);

        
    //     $count = 0;
    //     $soum  = 0;
    //     $idActivity = $certificates[0]->activity_id;
    //     // dd($nextActivity);


    //     return view('admin.student.certificates.rejected', compact(['person', 'certificates', 'activities', 'idActivity', 'count','soum']));
    // }

    
}
