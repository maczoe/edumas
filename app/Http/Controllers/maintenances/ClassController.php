<?php

namespace App\Http\Controllers\maintenances;

use App\Http\Controllers\Controller;

class ClassController extends Controller
{
    public function index()
    {
        return view('maintenances/classes');
    }

    public function show($id)
    {
        $data = array(
            'groups' => \App\Models\Group::all()->pluck('name', 'id'),
            'subjects' => \App\Models\Subject::pluck('title', 'id'),
            'teachers' => \App\Models\Teacher::all()->pluck('fullname', 'id'),
            'establishments' => \App\Models\Establishment::pluck('name', 'id'),
            'class' => \App\Models\Class_::findOrFail($id)
        );
        return view('maintenances/classshow')->with($data);
    }

    public function create()
    {
        $data = array(
            'groups' => \App\Models\Group::all()->pluck('name', 'id'),
            'subjects' => \App\Models\Subject::pluck('title', 'id'),
            'teachers' => \App\Models\Teacher::all()->pluck('fullname', 'id'),
            'establishments' => \App\Models\Establishment::pluck('name', 'id'),
            'class' => new \App\Models\Class_()
        );
        return view('maintenances/classcreate')->with($data);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            "subject_id" => "required|exists:subjects,id",
            "teacher_id" => "required|exists:teachers,id",
            "group_id" => "required|exists:groups,id",
            "establishment_id" => "required|exists:establishments,id",
            "start_time" => "required|date_format:g:i A",
            "end_time" => "required|date_format:g:i A|after:start_time",
        ]);

        $input = $request->all();

        \App\Models\Class_::create($input);

        \Illuminate\Support\Facades\Session::flash('alert', 'Clase creada con éxito');

        return redirect()->back();
    }

    public function edit($id)
    {
        $data = array(
            'groups' => \App\Models\Group::all()->pluck('name', 'id'),
            'subjects' => \App\Models\Subject::pluck('title', 'id'),
            'teachers' => \App\Models\Teacher::all()->pluck('fullname', 'id'),
            'establishments' => \App\Models\Establishment::pluck('name', 'id'),
            'class' => \App\Models\Class_::findOrFail($id)
        );
        return view('maintenances/classedit')->with($data);
    }

    public function update($id, \Illuminate\Http\Request $request)
    {
        $class = \App\Models\Class_::findOrFail($id);
        $this->validate($request, [
            "subject_id" => "required|exists:subjects,id",
            "teacher_id" => "required|exists:teachers,id",
            "group_id" => "required|exists:groups,id",
            "establishment_id" => "required|exists:establishments,id",
            "start_time" => "required|date_format:g:i A",
            "end_time" => "required|date_format:g:i A|after:start_time",
        ]);

        $input = $request->all();

        $class->fill($input)->save();

        \Illuminate\Support\Facades\Session::flash('alert', 'Clase actualizada con éxito');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $class = \App\Models\Class_::findOrFail($id);

        $class->delete();

        \Illuminate\Support\Facades\Session::flash('alert', 'Clase eliminada con éxito');

        return redirect()->route('classes.index');
    }

    // ***** Implementacion de datatable API para uso de datatables.js
    public function getDatatable() {
    	return datatables()->of(\App\Models\Class_::all())->make(true);
    }
}
