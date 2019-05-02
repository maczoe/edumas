<?php

namespace App\Http\Controllers\maintenances;

use App\Http\Controllers\Controller;
use App\Models\Subject;

class SubjectsController extends Controller
{
    public function index() {
        $subjects = Subject::all();
        return view('maintenances/subjects', ['subjects' => $subjects]);
    }
    
     public function show($id) {
        $data = array(
            'grades' => \App\Models\Grade::all()->pluck('name', 'id'),
            'subject' => \App\Models\Subject::findOrFail($id)
        );
        return view('maintenances/subjectshow')->with($data);
    }
    
    public function create() {
        $data = array(
            'grades' => \App\Models\Grade::all()->pluck('name', 'id'),
            'subject' => new \App\Models\Subject()
        );
        return view('maintenances/subjectcreate')->with($data);
    }
    
    public function store(\Illuminate\Http\Request $request) {
        $this->validate($request, [
            "title" => "required|min:3|max:50|unique:subjects",
            "min_mark" => "integer|min:0|max:100",
            "grade_id" => "integer|exists:grades,id",
        ]);
        
        $input = $request->all();
        
        \App\Models\Subject::create($input);
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Curso creado con éxito');
        
        return redirect()->back();
    }
    
    public function edit($id) {
        $data = array(
            'grades' => \App\Models\Grade::all()->pluck('name', 'id'),
            'subject' => \App\Models\Subject::findOrFail($id)
        );
        return view('maintenances/subjectedit')->with($data);
    }
    
    public function update($id, \Illuminate\Http\Request $request) {
        $subject = \App\Models\Subject::findOrFail($id);
        $this->validate($request, [
            "title" => "required|min:3|max:50|unique:subjects,title,".$subject->id,
            "min_mark" => "integer|min:0|max:100",
            "grade_id" => "integer|exists:grades,id",
        ]);
        
        $input = $request->all();
        
        $subject->fill($input)->save();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Curso actualizado con éxito');
        
        return redirect()->back();
    }
    
    public function destroy($id) {
        $subject = \App\Models\Subject::findOrFail($id);
        
        $subject->delete();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Curso eliminado con éxito');
        
        return redirect()->route('subjects.index');
    }

    // ***** Implementacion de datatable API para uso de datatables.js
    public function getDatatable() {
    	return datatables()->of(Subject::all())->make(true);
    }
}
