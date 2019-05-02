<?php

namespace App\Http\Controllers\maintenances;

use App\Http\Controllers\Controller;
use App\Models\Student;

class StudentsController extends Controller
{
    public function index() { 
        $students = Student::paginate(10);
        return view('maintenances/students', ['students' => $students]);
    }
    
     public function show($id) {
        $student = \App\Models\Student::findOrFail($id);
        return view('maintenances/studentshow')->withStudent($student);
    }
    
    public function create() {
        $student = new \App\Models\Student();
        return view('maintenances/studentcreate')->withStudent($student);
    }
    
    public function store(\Illuminate\Http\Request $request) {
        $this->validate($request, [
            "id_number" => "required|min:3|max:50|unique:students",
            "personal_code" => "max:100",
            "uic" => "max:100",
            "first_name" => "required|min:3|max:100",
            "last_name" => "min:3|max:100",
            "phone_number" => "nullable|min:8|max:20",
            "cellphone_number" => "nullable|min:8|max:20",
            "gender" => "in:M,F",
            "user_id" => "exists:users"
        ]);
        
        $input = $request->all();
        
        \App\Models\Student::create($input);
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Estudiante creado con éxito');
        
        return redirect()->back();
    }
    
    public function edit($id) {
        $student = \App\Models\Student::findOrFail($id);
        return view('maintenances/studentedit')->withStudent($student);
    }
    
    public function update($id, \Illuminate\Http\Request $request) {
        $student = \App\Models\Student::findOrFail($id);
        $this->validate($request, [
            "id_number" => "required|min:3|max:50|unique:students,id_number,".$student->id,
            "personal_code" => "max:100",
            "uic" => "max:100",
            "first_name" => "required|min:3|max:100",
            "last_name" => "min:3|max:100",
            "phone_number" => "nullable|min:8|max:20",
            "cellphone_number" => "nullable|min:8|max:20",
            "gender" => "in:M,F",
            "user_id" => "exists:users"
        ]);
        
        $input = $request->all();
        
        $student->fill($input)->save();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Estudiante actualizado con éxito');
        
        return redirect()->back();
    }
    
    public function destroy($id) {
        $student = \App\Models\Student::findOrFail($id);
        
        $student->delete();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Estudiante eliminado con éxito');
        
        return redirect()->route('students.index');
    }

    // ***** Implementacion de datatable API para uso de datatables.js
    public function getDatatable() {
    	return datatables()->of(Student::all())->make(true);
    }
}
