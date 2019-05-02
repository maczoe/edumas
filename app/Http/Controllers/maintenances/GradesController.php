<?php

namespace App\Http\Controllers\maintenances;

use App\Http\Controllers\Controller;
use App\Models\Grade;

class GradesController extends Controller
{
    public function index() {
        $grades = Grade::all();
        return view('maintenances/grades', ['grades' => $grades]);
    }
    
     public function show($id) {
        $grade = \App\Models\Grade::findOrFail($id);
        return view('maintenances/gradeshow')->withGrade($grade);
    }
    
    public function create() {
        $grade = new \App\Models\Grade();
        return view('maintenances/gradecreate')->withGrade($grade);
    }
    
    public function store(\Illuminate\Http\Request $request) {
        $this->validate($request, [
            "name" => "required|max:50"
        ]);
        
        $input = $request->all();
        
        \App\Models\Grade::create($input);
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Grado creado con éxito');
        
        return redirect()->back();
    }
    
    public function edit($id) {
        $grade = \App\Models\Grade::findOrFail($id);
        return view('maintenances/gradeedit')->withGrade($grade);
    }
    
    public function update($id, \Illuminate\Http\Request $request) {
        $grade = \App\Models\Grade::findOrFail($id);
        $this->validate($request, [
             "name" => "required|max:50"
        ]);
        
        $input = $request->all();
        
        $grade->fill($input)->save();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Grado actualizado con éxito');
        
        return redirect()->back();
    }
    
    public function destroy($id) {
        $grade = \App\Models\Grade::findOrFail($id);
        
        $grade->delete();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Grado eliminado con éxito');
        
        return redirect()->route('grades.index');
    }

    // ***** Implementacion de datatable API para uso de datatables.js
    public function getDatatable() {
    	return datatables()->of(Grade::all())->make(true);
    }
}
