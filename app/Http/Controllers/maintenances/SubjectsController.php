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
        $subject = \App\Models\Subject::findOrFail($id);
        return view('maintenances/subjectshow')->withSubject($subject);
    }
    
    public function create() {
        $subject = new \App\Models\Subject();
        return view('maintenances/subjectcreate')->withSubject($subject);
    }
    
    public function store(\Illuminate\Http\Request $request) {
        $this->validate($request, [
            "title" => "required|min:5|max:50|unique:subjects",
            "min_mark" => "integer|min:0|max:100"
        ]);
        
        $input = $request->all();
        
        \App\Models\Subject::create($input);
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Curso creado con éxito');
        
        return redirect()->back();
    }
    
    public function edit($id) {
        $subject = \App\Models\Subject::findOrFail($id);
        return view('maintenances/subjectedit')->withSubject($subject);
    }
    
    public function update($id, \Illuminate\Http\Request $request) {
        $subject = \App\Models\Subject::findOrFail($id);
        $this->validate($request, [
            "title" => "required|min:5|max:50|unique:subjects,title,".$subject->id,
            "min_mark" => "integer|min:0|max:100"
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
        
        return redirect()->route('maintenances.subjects.index');
    }
}
