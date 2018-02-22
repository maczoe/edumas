<?php namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Student;
use \App\Models\Payment;
use \Carbon\Carbon;
use \App\Models\PaymentDetail;

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
            'students' => Student::all()->pluck('idname', 'id')
        );
        return view('payments/payments')->with($data);
    }

    //Buscar el próximo pago del estudiante y el historial de pagos
    public function search(Request $request)
    {
        $this->validate($request, [
            "student" => "required|exists:students,id",
        ]);
        $student_id = $request->get('student');
        $student = Student::findOrFail($student_id);
        $payments = Payment::where('student_id', $student_id)->orderBy('date_time', 'desc')->get();
        
        $data = array(
            'student' => $student,
            'payments' => $payments
        );

        return view('payments/payment')->with($data);
    }
    
    public function doPayment() {
        //TODO Buscar siguiente pago de estudiante
        $payment = new Payment();
        $payment->serie_id = 1;
        $payment->document_number = 5;
        $payment->document_series = 'A';
        $payment->date_time = Carbon::now();
        $payment->user_id = 2;
        $payment->customer = 'Jayce Rippin';
        $payment->student_id = 2;
        $payment->payment = 500;
        $payment->save();
        $detail = new PaymentDetail();
        $detail->payment_id = $payment->id;
        $detail->quantity = 1;
        $detail->detail = 'PAGO DE MENSUALIDAD OPERADOR EN COMPUTADORAS MES DE JULIO';
        $detail->unit_price = 500;
        $detail->amount = 500;
        $detail->save();
        return view('payments/invoice')->withPayment($payment);
    }
    
    //Re imprimir recibo 
    public function reprint(Request $request) {
        $id = $request->get('id');
        $payment = \App\Models\Payment::findOrFail($id);
        return view('payments/invoice')->withPayment($payment);
    }
    
    public function cancel() {
        
    }

}
