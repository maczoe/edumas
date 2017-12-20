<?php

namespace App\Http\Controllers\maintenances;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\Support\Facades\Session;

class SeriesController extends Controller
{
    public function index() {
        $series = Serie::all();
        return view('maintenances/series', ['series' => $series]);
    }
    
     public function show($id) {
         $types = array(
             'registration' => trans('attrib.registration'),
             'payment' => trans('attrib.payment'),
             'sale' => trans('attrib.sale')
         );
         $data = array(
            'establishments' => \App\Models\Establishment::pluck('name', 'id'),
            'serie' => Serie::findOrFail($id),
            'types' => $types
        );
        return view('maintenances/serieshow')->with($data);
    }
    
    public function create() {
        $types = array(
             'registration' => trans('attrib.registration'),
             'payment' => trans('attrib.payment'),
             'sale' => trans('attrib.sale')
         );
         $data = array(
            'establishments' => \App\Models\Establishment::pluck('name', 'id'),
            'serie' => new Serie(),
            'types' => $types
        );
        return view('maintenances/seriecreate')->with($data);
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            "serie" => "required|min:1",
            "min" => "required|integer|min:1",
            "max" => "required|integer|min:".$request->get('min'),
            "type" => "required|in:registration,payment,sale",
            "establishment_id" => "required|exists:establishments,id",
        ]);
        
        $input = $request->all();
        $input['current'] = $request->get('min');
        $input['enabled'] = 1;
        Serie::create($input);
        
        Session::flash('alert', 'Serie creada con éxito');
        
        return redirect()->back();
    }
    
    public function edit($id) {
        $types = array(
             'registration' => trans('attrib.registration'),
             'payment' => trans('attrib.payment'),
             'sale' => trans('attrib.sale')
         );
         $data = array(
            'establishments' => \App\Models\Establishment::pluck('name', 'id'),
            'serie' => Serie::findOrFail($id),
            'types' => $types
        );
        return view('maintenances/serieedit')->with($data);
    }
    
    public function update($id, Request $request) {
        $serie = Serie::findOrFail($id);
        $this->validate($request, [
            "serie" => "required|min:1",
            "max" => "required|integer|min:".$serie->min,
            "type" => "required|in:registration,payment,sale",
            "establishment_id" => "required|exists:establishments,id",
        ]);
        
        $input = $request->all();
        $input['enabled'] = isset($input['enabled']) ? 1 : 0;
        
        $serie->fill($input)->save();
        
        Session::flash('alert', 'Serie actualizada con éxito');
        
        return redirect()->back();
    }
    
    public function destroy($id) {
        $serie = Serie::findOrFail($id);
        
        $serie->delete();
        
        Session::flash('alert', 'Serie eliminada con éxito');
        
        return redirect()->route('maintenances.series.index');
    }
}
