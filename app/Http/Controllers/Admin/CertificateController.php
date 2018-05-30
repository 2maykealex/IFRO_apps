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

class CertificateController extends Controller
{
    public function upload(){
        $user = auth()->user();  //verificar para puxar Person e Student através do User Logado

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = Activity::all();

        $student = Student::with(['person' , 'course'])->get();

        $value = 0;

        return view('admin.certificate.upload', compact(['person', 'activities', 'value']));
    }

    public function validateCertificate($id, $value){

        $data = Certificate::where('id', $id)->get()->first();

        $data->certificateValided = $value;
        
        $data->save();
        
        if ($value == 1){
            return redirect()->route('admin.certificate.accepted');
        }else if($value == 2){
            return redirect()->route('admin.certificate.rejected');
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

        return redirect()->route('admin.certificates')->with('success', 'Certificado carregado com sucesso!');
        // return redirect()->back()->with('success', 'Certificado carregado com sucesso!');

    }

    public function certificatesReport(){

        // $user = auth()->user();

        $person = Person::where('user_id', 3)->with('course')->get()->first();

        $activities = [];
    
        $certificates = Certificate::where('person_id',$person->id)->with(['activity', 'person'])->orderby('description')->get();        
        
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

        // dd($activities);
        return view('admin.certificate.certificatesReport', compact(['person', 'certificates', 'activities', 'idActivity', 'count','soum', 'color', 'lastKey']));

                                                                       
        // return view('admin.certificate.certificatesReport', compact(['$certificates', '$personActivities','person']));
    }

    public function certificatesPending(){
        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = [];

        $certificates = Certificate::where('certificateValided', 0)->with(['activity', 'person'])->orderby('description')->get();   
        
        $personActivities = Certificate::where('certificateValided', 0)->orderby('activity_id') 
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
        
        return view('admin.certificate.certificates', compact(['person', 'certificates', 'activities', 'idActivity', 'count','soum']));
    }

    public function certificatesAccepted(){
        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = [];
    
        $certificates = Certificate::with(['activity', 'person'])->orderby('description')->get();        
        
        $personActivities = Certificate::where('certificateValided', 1)->orderby('activity_id') 
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


        return view('admin.certificate.accepted', compact(['person', 'certificates', 'activities', 'idActivity', 'count','soum']));
    }

    public function certificatesRejected(){
        $user = auth()->user();

        $person = Person::where('user_id', $user->id)->get()->first();

        $activities = [];

        $certificates = Certificate::with(['activity'])->get();        

        $personActivities = Certificate::where('certificateValided', 2)->get();

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


        return view('admin.certificate.rejected', compact(['person', 'certificates', 'activities', 'idActivity', 'count','soum']));
    }
}
