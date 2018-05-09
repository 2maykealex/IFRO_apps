<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;

class StudentController extends Controller
{

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

    
}
