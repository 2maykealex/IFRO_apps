<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Area;

class CourseController extends Controller
{
    public function areaCurso(){
        $course = Course::find(2); #criar uma função que retorne um curso

        echo $course->name.'<br>';

        dd($course->area);
        
    }

    public function newCourse(){

        $areas = Area::all();

        return view('admin.course.new', compact('areas'));
    }

    public function courses(){
        $courses = Course::with('area')->get();

        // dd($courses);

        return view('admin.course.courses', compact('courses'));
    }

    public function courseStore(Request $request, Course $course){
        
        $dataForm = $request->all();
        
        $response = $course->courseNew($dataForm);  #chamando metodo na model.

        if ($response['success'])
            return redirect()->route('admin.courses')
                             ->with('success', $response['message']);

        return redirect()->back()
                         ->with('error', $response['message']);
        
    }
}
