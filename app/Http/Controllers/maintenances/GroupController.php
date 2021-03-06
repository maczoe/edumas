<?php namespace App\Http\Controllers\maintenances;

use App\Http\Controllers\Controller;
use App\Models\Group;

class GroupController extends Controller {

    public function index()
    {
        return view('maintenances/groups');
    }

    public function show($id)
    {
        $data = array(
            'group' => \App\Models\Group::findOrFail($id),
            'grades' => \App\Models\Grade::pluck('name', 'id')
        );
        
        return view('maintenances/groupshow')->with($data);
    }

    public function create()
    {
        $data = array(
            'group' => new \App\Models\Group(),
            'grades' => \App\Models\Grade::pluck('name', 'id')
        );
        return view('maintenances/groupscreate')->with($data);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            "section" => "required",
            "grade_id" => "required",
            "start_time" => "required|date_format:g:i A",
            "end_time" => "required|date_format:g:i A|after:start_time",
        ]);

        $input = $request->all();

        \App\Models\Group::create($input);

        \Illuminate\Support\Facades\Session::flash('alert', 'Grupo creado con éxito');

        return redirect()->back();
    }

    public function edit($id)
    {
        $data = array(
            'group' => \App\Models\Group::findOrFail($id),
            'grades' => \App\Models\Grade::pluck('name', 'id')
        );
        return view('maintenances/groupsedit')->with($data);
    }

    public function update($id, \Illuminate\Http\Request $request)
    {
        $group = \App\Models\Group::findOrFail($id);
        $this->validate($request, [
            "section" => "required",
            "grade_id" => "required",
            "start_time" => "required|date_format:g:i A",
            "end_time" => "required|date_format:g:i A|after:start_time",
        ]);

        $input = $request->all();

        $group->fill($input)->save();

        \Illuminate\Support\Facades\Session::flash('alert', 'Grupo actualizado con éxito');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $group = \App\Models\Group::findOrFail($id);

        $group->delete();

        \Illuminate\Support\Facades\Session::flash('alert', 'Grupo eliminado con éxito');

        return redirect()->route('groups.index');
    }

    // ***** Implementacion de datatable API para uso de datatables.js
    public function getDatatable() {
    	return datatables()->of(Group::with("grade")->get())->make(true);
    }

}