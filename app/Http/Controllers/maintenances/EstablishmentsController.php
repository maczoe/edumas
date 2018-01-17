<?php

namespace App\Http\Controllers\maintenances;

use App\Http\Controllers\Controller;
use \App\Models\Establishment;

class EstablishmentsController extends Controller
{
    public function index() {
        $establishments = Establishment::all();
        return view('maintenances/establishments', ['establishments' => $establishments]);
    }
    
     public function show($id) {
        $establishment = \App\Models\Establishment::findOrFail($id);
        return view('maintenances/establishmentshow')->withEstablishment($establishment);
    }
    
    public function create() {
        $establishment = new \App\Models\Establishment();
        return view('maintenances/establishmentcreate')->withEstablishment($establishment);
    }
    
    public function store(\Illuminate\Http\Request $request) {
        $this->validate($request, [
            "id_number" => "required|min:5|max:50|unique:establishments",
            "name" => "required|min:5|max:100",
            "phone_number" => "min:8|max:20"
        ]);
        
        $input = $request->all();
        
        \App\Models\Establishment::create($input);
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Establecimiento creado con éxito');
        
        return redirect()->back();
    }
    
    public function edit($id) {
        $establishment = \App\Models\Establishment::findOrFail($id);
        return view('maintenances/establishmentedit')->withEstablishment($establishment);
    }
    
    public function update($id, \Illuminate\Http\Request $request) {
        $establishment = \App\Models\Establishment::findOrFail($id);
        $this->validate($request, [
            "id_number" => "required|min:5|max:50|unique:establishments,id_number,".$establishment->id,
            "name" => "required|min:5|max:100",
            "phone_number" => "min:8|max:20"
        ]);
        
        $input = $request->all();
        
        $establishment->fill($input)->save();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Establecimiento actualizado con éxito');
        
        return redirect()->back();
    }
    
    public function destroy($id) {
        $establishment = \App\Models\Establishment::findOrFail($id);
        
        $establishment->delete();
        
        \Illuminate\Support\Facades\Session::flash('alert', 'Establecimiento eliminado con éxito');
        
        return redirect()->route('establishments.index');
    }
}
