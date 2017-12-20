<?php namespace app\Services;

use App\Helpers\Contracts\PaymentServiceContract;
use App\Models\Student;
use App\Models\Establishment;
use App\Models\PaymentPlan;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Cashflow;
use App\Models\Serie;
use App\Models\PaymentDetail;
use Exception;

class PaymentService implements PaymentServiceContract {

    public function makePaymentAcademic(Student $student, Establishment $establishment, PaymentPlan $plan)
    {
        
    }

    public function makePaymentRegistration(Student $student, Establishment $establishment, PaymentPlan $registrationPlan)
    {
        DB::beginTransaction();
        try {
            //Busqueda de parámetros
            $reg = PaymentPlan::findOrFail($registrationPlan->id);
            $stu = Student::findOrFail($student->id);
            //Pago a realizar
            $pay = $reg->price;
            
            //Se crea la instancia del pago a registrar
            $payment = new Payment();
            $payment->user_id = Auth::user()->id;
            $payment->date_time = Carbon::now();
            $payment->student_id = $stu->id;
            $payment->payment = $pay;
            $payment->customer = $stu->fullName;
            
            //Correlativo de series de recibos para la inscripción
            $serie = $this->nextSeries('registration', $establishment);
            $payment->document_series = $serie->serie;
            $payment->document_number = $serie->current;
            $payment->serie_id = $serie->id;
            
            $payment->save();
            
            //Se crea el detalle del pago a registrar
            $det = 'PAGO DE INSCRIPCIÓN';
            $detail = new PaymentDetail();
            $detail->payment_id = $payment->id;
            $detail->quantity = 1;
            $detail->detail = $det;
            $detail->unit_price = $pay;
            $detail->amount = $pay;
            
            $detail->save();

            //Registrando flujo de caja
            $this->registerPaymentCashflow($payment, $establishment, $det);
            
            DB::commit();
            return $payment->id;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            abort(404);
        }
    }

    public function makePaymentSales($client, Establishment $establishment, array $details)
    {
        
    }

    public function registerPaymentCashflow(Payment $payment, Establishment $establishment, $detail)
    {
        $cashflow = new Cashflow();
        $cashflow->document_number = $payment->document_series . '-' . $payment->document_number;
        $cashflow->customer = $payment->customer;
        $cashflow->detail = $detail;
        $cashflow->date_time = Carbon::now();
        $cashflow->credit = $payment->payment;
        $cashflow->user_id = Auth::user()->id;
        $cashflow->establishment_id = $establishment->id;
        $open = DB::table('cashflows')
                ->select(\Illuminate\Support\Facades\DB::raw('sum(IFNULL(credit,0))-sum(IFNULL(debit,0)) as open'))
                ->where('establishment_id', $establishment->id)
                ->first();
        if($open->open) {
            $cashflow->opening_balance = $open->open;
            $cashflow->final_balance = $open->open + $payment->payment;
        } else {
            $cashflow->opening_balance = 0;
            $cashflow->final_balance = $payment->payment;
        }
        $cashflow->save();
    }

    public function nextSeries($type, Establishment $establishment)
    {
        $serie = Serie::where('type', $type)->where('enabled', 1)->where('establishment_id', $establishment->id)->first();
        if(!$serie) {
            throw new Exception('NO SE HA ASIGNADO UNA SERIE DE RECIBOS PARA EJECUTAR LA OPERACIÓN');
        }
        
        $current = $serie->current;
        
        if($current>=$serie->max) {
            throw new Exception('SERIE DE RECIBOS: '.$serie->serie.' ALCANZÓ SU LÍMITE');
        }
        
        if($current+1==$serie->max) {
            $serie->enabled = 0;
        } 
        $serie->current = $current + 1;
        $serie->save();
        
        //VALOR DE RETORNO CON EL VALOR QUE SE ACTUALIZÓ LA TABLA
        $serie->current = $current;
        return $serie;
    }

}
