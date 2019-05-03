<?php

namespace App\Http\Controllers\maintenances;

use App\Http\Controllers\Controller;

class PaymentPlansController extends Controller
{
    public function index()
    {
        return view('maintenances/paymentplans');
    }

    public function show($id)
    {
        $data = array(
            'grades' => \App\Models\Grade::all()->pluck('name', 'id'),
            'subjects' => \App\Models\Subject::pluck('title', 'id'),
            'establishments' => \App\Models\Establishment::pluck('name', 'id'),
            'plan' => \App\Models\PaymentPlan::findOrFail($id)
        );
        return view('maintenances/paymentplanshow')->with($data);
    }

    public function create()
    {
        $data = array(
            'grades' => \App\Models\Grade::all()->pluck('name', 'id'),
            'subjects' => \App\Models\Subject::pluck('title', 'id'),
            'establishments' => \App\Models\Establishment::pluck('name', 'id'),
            'plan' => new \App\Models\PaymentPlan()
        );
        return view('maintenances/paymentplancreate')->with($data);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            "subject_id" => "exists:subjects,id",
            "grade_id" => "exists:grades,id",
            "establishment_id" => "required|exists:establishments,id",
            "pay_day" => "required|integer|min:1|max:28",
            "period" => "required|in:weekly,monthly,total,registration",
            "price" => "required|numeric|min:0",
            "fault" => "required|numeric|min:0",
        ]);

        $input = $request->all();

        \App\Models\PaymentPlan::create($input);

        \Illuminate\Support\Facades\Session::flash('alert', 'Plan de pago creado con éxito');

        return redirect()->back();
    }

    public function edit($id)
    {
        $data = array(
            'grades' => \App\Models\Grade::all()->pluck('name', 'id'),
            'subjects' => \App\Models\Subject::pluck('title', 'id'),
            'establishments' => \App\Models\Establishment::pluck('name', 'id'),
            'plan' => \App\Models\PaymentPlan::findOrFail($id)
        );
        return view('maintenances/paymentplanedit')->with($data);
    }

    public function update($id, \Illuminate\Http\Request $request)
    {
        $plan = \App\Models\PaymentPlan::findOrFail($id);
       $this->validate($request, [
            "subject_id" => "exists:subjects,id",
            "grade_id" => "exists:grades,id",
            "establishment_id" => "required|exists:establishments,id",
            "pay_day" => "required|integer|min:1|max:28",
            "period" => "required|in:weekly,monthly,total,registration",
            "price" => "required|numeric|min:0",
            "fault" => "required|numeric|min:0",
        ]);

        $input = $request->all();

        if(!$request->get('grade_id')) {
            $plan->grade_id = null;
        }
        if(!$request->get('subject_id')) {
            $plan->subject_id = null;
        }
        $plan->fill($input)->save();

        \Illuminate\Support\Facades\Session::flash('alert', 'Plan de pago actualizado con éxito');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $plan = \App\Models\PaymentPlan::findOrFail($id);

        $plan->delete();

        \Illuminate\Support\Facades\Session::flash('alert', 'Plan de pago eliminado con éxito');

        return redirect()->route('payment_plans.index');
    }

    // ***** Implementacion de datatable API para uso de datatables.js
    public function getDatatable() {
    	return datatables()
    			->of(\App\Models\PaymentPlan::
    			with("subject")
    			->with("grade")
    			->with("establishment")
    			->get())
    			->make(true);
    }
}
