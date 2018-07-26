<?php

namespace App\Http\Controllers\Coordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function newActivity(){
        return view('coordinator.activity.new');
    }

    public function activities(){
        $activities = Activity::all();   
        return view('coordinator.activity.activities', compact('activities'));
    }

    public function activityStore(Request $request, Activity $activities){
        
        $dataForm = $request->all();
        
        $response = $activities->activityNew($dataForm);

        if ($response['success'])
            return redirect()->route('coordinator.activities')
                             ->with('success', $response['message']);

        return redirect()->back()
                         ->with('error', $response['message']);
        
    }


}
