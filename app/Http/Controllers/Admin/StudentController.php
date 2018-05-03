<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function student(){
        $student = Student::with(['people' , 'course'])->where('id','1')->get();

        echo $student->person->name.'<br>';
        echo $student->person->address.'<hr>';
        
        dd($student);
    }
}
