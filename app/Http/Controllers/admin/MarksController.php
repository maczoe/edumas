<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use \App\Models\Subject;
use \App\Models\Group;
use App\Models\Student;

class MarksController extends Controller
{
    public function index() {
        $subjects = Subject::all()->pluck('title','id');
        $groups = Group::all()->pluck('name', 'id');
        $students = Student::all();
        $data = array(
            'subjects' => $subjects,
            'groups' => $groups,
            'students' => $students
        );
        return view('marks.index')->with($data);
    }
    
    public function export() {
        $file = "notas.xlsx";
        return Response::download($file);
    }
}
