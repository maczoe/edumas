<?php

namespace App\Http\Controllers\maintenances;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class TeachersController extends Controller
{
    public function index() {
        $teachers = Teacher::all();
        return view('maintenances/teachers', ['teachers' => $teachers]);
    }
    
     public function show($id) {
        $teacher = \App\Models\Teacher::findOrFail($id);
        return view('maintenances/teachershow')->withTeacher($teacher);
    }
    
    public function create() {
        $teacher = new \App\Models\Teacher();
        return view('maintenances/teachercreate')->withTeacher($teacher);
    }
    
    public function store(\Illuminate\Http\Request $request) {
        $this->validate($request, [
            "id_number" => "required|min:5|max:50|unique:teachers",
            "first_name" => "required|min:5|max:100",
            "last_name" => "min:5|max:100",
            "phone_number" => "min:8|max:20",
            "cellphone_number" => "min:8|max:20",
            "gender" => "in:M,F",
            "user_id" => "exists:users"
        ]);
        
        $input = $request->all();
        
        \App\Models\Teacher::create($input);
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Profesor creado con éxito');
        
        return redirect()->back();
    }
    
    public function edit($id) {
        $teacher = \App\Models\Teacher::findOrFail($id);
        return view('maintenances/teacheredit')->withTeacher($teacher);
    }
    
    public function update($id, \Illuminate\Http\Request $request) {
        $teacher = \App\Models\Teacher::findOrFail($id);
        $this->validate($request, [
            "id_number" => "required|min:5|max:50|unique:teachers,id_number,".$teacher->id,
            "first_name" => "required|min:2|max:100",
            "last_name" => "min:2|max:100",
            "phone_number" => "min:8|max:20",
            "cellphone_number" => "min:8|max:20",
            "gender" => "in:M,F",
            "user_id" => "exists:users"
        ]);
        
        $input = $request->all();
        
        $teacher->fill($input)->save();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Profesor actualizado con éxito');
        
        return redirect()->back();
    }
    
    public function destroy($id) {
        $teacher = \App\Models\Teacher::findOrFail($id);
        
        $teacher->delete();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Profesor eliminado con éxito');
        
        return redirect()->route('maintenances.teachers.index');
    }
}
