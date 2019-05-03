<?php

namespace App\Http\Controllers\maintenances;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Support\Facades\Session;

class PeriodsController extends Controller
{
    public function index() {
        return view('maintenances/periods');
    }
    
     public function show($id) {
        $period = Period::findOrFail($id);
        return view('maintenances/periodsshow')->withPeriod($period);
    }
    
    public function create() {
        $period = new Period();
        return view('maintenances/periodscreate')->withPeriod($period);
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            "name" => "required|max:50",
            "start_date" => "required|date_format:d/m/Y",
            "end_date" => "required|date_format:d/m/Y|after:start_date"
        ]);
        
        $input = $request->all();
        
        Period::create($input);
        
        Session::flash('alert', 'Ciclo creado con éxito');
        
        return redirect()->back();
    }
    
    public function edit($id) {
        $period = Period::findOrFail($id);
        return view('maintenances/periodsedit')->withPeriod($period);
    }
    
    public function update($id, Request $request) {
        $period = Period::findOrFail($id);
        $this->validate($request, [
            "name" => "required|max:50",
            "start_date" => "required|date_format:d/m/Y",
            "end_date" => "required|date_format:d/m/Y|after:start_date"
        ]);
        
        $input = $request->all();
        
        $period->fill($input)->save();
        
        Session::flash('alert', 'Ciclo actualizado con éxito');
        
        return redirect()->back();
    }
    
    public function destroy($id) {
        $period = Period::findOrFail($id);
        
        $period->delete();
        
        Session::flash('alert', 'Ciclo eliminado con éxito');
        
        return redirect()->route('periods.index');
    }

    // ***** Implementacion de datatable API para uso de datatables.js
    public function getDatatable() {
    	return datatables()->of(Period::all())->make(true);
    }
}
