<?php namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Student;
use \App\Models\Payment;
use \Carbon\Carbon;
use \App\Models\PaymentDetail;
use \App\Models\PaymentPlan;
use \App\Models\Period;
use \App\Models\Registration;
use \App\Models\Establishment;
use \App\Models\Grade;
use App\Helpers\Contracts\PaymentServiceContract;
use Illuminate\Database\Eloquent\Collection;

class PaymentsController extends Controller {

    public function printInvoice(Request $request)
    {
        $id = $request->get('payment');
        $payment = \App\Models\Payment::findOrFail($id);
        return view('payments/invoice')->withPayment($payment);
    }

    public function index()
    {
        $data = array(
            'students' => Student::all()->pluck('idname', 'id'),
            'establishments' => Establishment::pluck('name', 'id'),
            'grades' => Grade::pluck('name', 'id')
        );
        return view('payments/payments')->with($data);
    }

    //Buscar el próximo pago del estudiante y el historial de pagos
    public function search(Request $request)
    {
        $this->validate($request, [
            "student" => "required|exists:students,id",
            "establishment" => "required|exists:students,id",
            "grade" => "required|exists:students,id",
        ]);
        $student_id = $request->get('student');
        $establishment_id = $request->get('establishment');
        $grade_id = $request->get('grade');
        $student = Student::findOrFail($student_id);
        $payments = Payment::where('student_id', $student_id)->whereNotNull('payment_plan_id')->orderBy('payment_date', 'desc')->get();

        $details = self::getActualPaymentDetail($student_id, $establishment_id, $grade_id);
        $total = 0;
        foreach ($details as $det) {
            $total += ($det['price']+$det['fault']);
        }
        $data = array(
            'establishment' => $establishment_id,
            'student' => $student,
            'payments' => $payments,
            'details' => $details,
            'total' => $total
        );

        return view('payments/payment')->with($data);
    }
    
    public function doPayment(Request $request, PaymentServiceContract $service) {
        setlocale(LC_TIME, 'es_ES');
        $student = Student::findOrFail($request->get('student'));
        $establishment = Establishment::findOrFail($request->get('establishment'));
        $comment = $request->get('comment');

        $rows = $request->get("i");
        $details = new Collection();

        for($i=0; $i<$rows; $i++) {
            if(!isset($plan)) {
                $plan = PaymentPlan::findOrFail($request->get('id_'.$i));
            }
            $price = $request->get('price_'.$i);
            $fault = $request->get('fault_'.$i);
            $carbon_date = Carbon::createFromFormat('d/m/Y', $request->get('date_'.$i));
            $subtotal = $price+$fault;
            $detail = new PaymentDetail();
            $detail->quantity = 1;
            $detail->detail = 'PAGO MENSUALIDAD: '.$request->get('subject_'.$i).' CORRESPONDIENTE AL MES DE '.strtoupper($carbon_date->formatLocalized("%B"));
            $detail->unit_price = $subtotal;
            $detail->amount = $subtotal; 
            $detail->created_at = $carbon_date;
            $details->push($detail); 
        }
        $payment_id = $service->makePaymentAcademic($student, $details, $plan, $establishment, $comment);
        $payment = Payment::findOrFail($payment_id);
        return view('payments/invoice')->withPayment($payment);
    }
    
    //Re imprimir recibo 
    public function reprint(Request $request) {
        $id = $request->get('id');
        $payment = \App\Models\Payment::findOrFail($id);
        return view('payments/invoice')->withPayment($payment);
    }
    
    public function cancel(Request $request) {
        $payment_id = $request->get('id');
        $payment = \App\Models\Payment::findOrFail($payment_id);
        $payment->status = 'Anulado';
        $payment->save();
        \Illuminate\Support\Facades\Session::flash('alert', 'Pago anulado exitosamente');
        return redirect()->route('payments');
    }

    public function getActualPaymentDetail($student, $establishment, $grade) {
        $details = Array();

        $plans = PaymentPlan::whereHas('students', function($q) use ($student) {
            $q->where('id', $student);  
        })->where('establishment_id', $establishment)->where('grade_id', $grade)->where('period', '!=', 'registration')->get();

        $i = 0;
        foreach ($plans as $plan) {
            $date = self::getNextPaymentDate($student, $plan);
            if($date) {
                $fault = (Carbon::now()->gt($date)) ? $plan->fault : 0; 
                $last = Payment::where('payment_plan_id', $plan->id);
                $details[$i] = [
                    "id" => $plan->id,
                    "subject" => $plan->subject->title,
                    "date" => $date,
                    "price" => $plan->price,
                    "fault" => $fault
                ];
                $i++;
            }
        }
        return $details;
    }

    public function getNextPaymentDate($student_id, $paymentPlan) {
        $last = Payment::where('student_id', $student_id)->where('payment_plan_id', $paymentPlan->id)->where('status', '!=', 'canceled')->orderBy('payment_date', 'desc')->first();
        //VERIFICA SI EL PAGO TOTAL YA SE REALIZO
        if($last) {
            if($paymentPlan->period=='total') {
                return null;
            }
        }

        $lastPeriod = Period::whereHas('registrations', function($q) use ($student_id) {
            $q->where('student_id', $student_id);  
        })->orderBy('start_date', 'desc')->first();

        //SI EL ALUMNO ESTA INSCRITO
        if($lastPeriod) {
            //SI YA REALIZO POR LO MENOS UN PAGO
            if($last) {
                $lastMonth = $last->payment_date->month;
                $lastPeriodMonth = $lastPeriod->end_date->month;
                //VERIFICAR SI EL ULTIMO PAGO SE REALIZO ANTES DE TERMINAR EL CICLO ESCOLAR
                if($lastMonth<$lastPeriodMonth) {
                    return Carbon::createFromDate($lastPeriod->start_date->year, $last->payment_date->addMonth()->month, $paymentPlan->pay_day);
                } else {
                    return null;
                }
            } else {
                return Carbon::createFromDate($lastPeriod->start_date->year, $lastPeriod->start_date->month, $paymentPlan->pay_day);
            }
        } else {
            return null;
        }
    }

}
