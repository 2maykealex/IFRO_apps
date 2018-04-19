<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function newActivity(){
        return view('admin.activity.new');
    }

    public function activities(){
        $activities = Activity::all();   
        return view('admin.activity.activities', compact('activities'));
    }

    public function activityStore(Request $request, Activity $activities){
        
        $dataForm = $request->all();
        
        $response = $activities->activityNew($dataForm);

        if ($response['success'])
            return redirect()->route('admin.activities')
                             ->with('success', $response['message']);

        return redirect()->back()
                         ->with('error', $response['message']);
        
    }


}
