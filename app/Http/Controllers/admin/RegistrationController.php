<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Helpers\Contracts\PaymentServiceContract;
use \App\Models\PaymentPlan;
use Carbon\Carbon;
use DB;

class RegistrationController extends Controller {

    private $session_student = 'STUDENT';
    private $student_option = 'STUDENT_OPTION';
    private $classes_assign = 'CLASSES_ASIGN';
    private $grade_assign = 'GRADE_ASSIGN';
    private $establishment_assign = 'ESTABLISHMENT_ASSIGN';
    private $group_assign = 'GROUP_ASSIGN';
    private $plans_assign = 'PLAN_ASSIGN';
    private $period_assign = 'PERIOD_ASSIGN';
    private $registraton_assign = 'REGISTRATION_ASSIGN';
    
    /*
     * ---------------------------------------------
     * METODOS PARA MANEJOR DEL FORMULARIO DE INSCRIPCIÓN
     * --------------------------------------------- 
     */

    // PASO 1 GET: SELECCION DE ESTUDIANTE
    public function getStep1()
    {
        $data = array(
            'students' => \App\Models\Student::all()->pluck('idname', 'id'),
            'student_option' => Session::get($this->student_option, '0'),
            'student' => Session::get($this->session_student, new \App\Models\Student())
        );
        return view('registration/step1')->with($data);
    }

    // PASO 1 POST: GUARDAR EL ESTUDIANTE SELECCIONADO
    public function postStep1(\Illuminate\Http\Request $request)
    {

        $student_option = $request->get('student_option');
        if ($student_option == 'new')
        {
            $this->validate($request, [
                //"id_number" => "required|min:3|max:50|unique:students",
                "personal_code" => "max:100",
                "uic" => "max:100",
                "first_name" => "required|min:3|max:100",
                "last_name" => "min:3|max:100",
                "phone_number" => "nullable|min:8|max:20",
                "birth_date" => "required|date_format:d/m/Y",
                "cellphone_number" => "nullable|min:8|max:20",
                "gender" => "in:M,F",
                "user_id" => "exists:users"
            ]);

            $student = new \App\Models\Student();
            $student->fill($request->all());
            Session::put($this->session_student, $student);
            Session::put($this->student_option, $student_option);
        }
        else if ($student_option == 'old')
        {
            $this->validate($request, [
                "student" => "required|exists:students,id",
            ]);
            $student = new \App\Models\Student();
            $student->id = $request->get('student');
            Session::put($this->session_student, $student);
            Session::put($this->student_option, $student_option);
        }
        else
        {
            return redirect()->route('registration1')->withErrors('Error: debe seleccionar un estudiante');
        }
        return redirect()->route('registration2');
    }

    // PASO 2 GET: SELECCIÓN DE CURSOS A ASIGNAR
    public function getStep2()
    {
        $student = Session::get($this->session_student);
        $option = Session::get($this->student_option);

        if ($student && $option)
        {
            if ($option == 'old')
            {
                $student = \App\Models\Student::findOrFail($student->id);
            }
            $data = [
                'student' => $student,
                'establishments' => \App\Models\Establishment::all()->pluck('name', 'id'),
                'grades' => \App\Models\Grade::all()->pluck('name', 'id')
            ];
            return view('registration/step2')->with($data);
        }
        else
        {
            redirect()->route('registration1')->withErrors('Error: debe seleccionar un estudiante');
        }
    }

    // PASO 2 POST: GUARDAR CURSOS ASIGNADOS
    public function postStep2(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            "establishment" => "required|exists:establishments,id",
            "grade" => "required|exists:grades,id",
            "subjects" => "required|array|exists:subjects,id",
            "group" => "required|exists:groups,id",
            "period" => "required|exists:periods,id"
        ]);

        $establishment = $request->get('establishment');
        $grade = $request->get('grade');
        $subjects = $request->get('subjects');
        $group = $request->get('group');
        $period = $request->get('period');
        $classes = \App\Models\Class_::where('establishment_id', '=', $establishment)
                ->where('group_id', '=', $group)
                ->whereIn('subject_id', $subjects)
                ->get()
                ->pluck('id');
        if (empty($classes))
        {
            return redirect()->route('registration2')->withErrors('Error: no existen clases o cursos con estos parámetros');
        }
        $student = Session::get($this->session_student);
        $registration_previous = \App\Models\Registration::where('student_id', $student)->where('group_id', $group)->where('period_id', $period)->get();
        if(!empty($registration_previous)) {
            return redirect()->route('registration2')->withErrors('Error: este alumno ya esta inscrito y asignado a los cursos correspondientes a este grado');
        }

        Session::put($this->grade_assign, $grade);
        Session::put($this->classes_assign, $classes);
        Session::put($this->establishment_assign, $establishment);
        Session::put($this->group_assign, $group);
        Session::put($this->period_assign, $period);
        return redirect()->route('registration3');
    }

    // PASO 3 GET: ASIGNACIÓN DE PLANES DE PAGO E INSCRIPCIÓN
    public function getStep3()
    {
        $classes = Session::get($this->classes_assign);
        $student = Session::get($this->session_student);
        $grade = Session::get($this->grade_assign);
        $establishment = Session::get($this->establishment_assign);
        $option = Session::get($this->student_option);

        if ($student && $option)
        {
            if ($option == 'old')
            {
                $student = \App\Models\Student::findOrFail($student->id);
            }
        }
        else
        {
            redirect()->route('registration1')->withErrors('Error: debe seleccionar un estudiante');
        }

        if (!$classes)
        {
            redirect()->route('registration2')->withErrors('Error: no se asignaron correctamente los cursos al estudiante');
        }

        $subjects = \App\Models\Class_::whereIn('id', $classes)->groupBy('subject_id')->get()->pluck('subject_id');
        $plans = array();
        $rg = \App\Models\PaymentPlan::where('grade_id', '=', $grade)
                ->where('establishment_id', '=', $establishment)
                ->where('period', '=', 'registration')
                ->get();
        $registrations = array();
        foreach ($rg as $r)
        {
            $registrations[$r->id] = $r->priceCurrency . ' - ' . $r->periodLocal;
        }
        foreach ($subjects as $subject)
        {
            $sub = \App\Models\Subject::where('id', '=', $subject)->first();

            $plan = \App\Models\PaymentPlan::where('grade_id', '=', $grade)
                    ->where('establishment_id', '=', $establishment)
                    ->where('period', '!=', 'registration')
                    ->where('subject_id', '=', $sub->id)
                    ->get();
            $pl = array();
            foreach ($plan as $p)
            {
                $pl[$p->id] = $p->priceCurrency . ' - ' . $p->periodLocal;
            }
            $plans[$sub->id] = [$sub->title => $pl];
        }
        $data = [
            'student' => $student,
            'plans' => $plans,
            'registrations' => $registrations
        ];
        return view('registration/step3')->with($data);
    }

    // PASO 3 POST: GUARDAR Y PROCESAR LA ASIGNACIÓN DE CURSOS Y PAGOS
    public function postStep3(\Illuminate\Http\Request $request, PaymentServiceContract $service)
    {
        $rules = array();
        $classes = Session::get($this->classes_assign);
        $student = Session::get($this->session_student);
        $option = Session::get($this->student_option);
        $establishment = Session::get($this->establishment_assign);
        $group = Session::get($this->group_assign);
        $grade = Session::get($this->grade_assign);
        $period = Session::get($this->period_assign);
        $subjects = \App\Models\Class_::whereIn('id', $classes)->groupBy('subject_id')->get()->pluck('subject_id');
        foreach ($subjects as $subject)
        {
            $rules['subject_' . $subject] = "required|exists:payment_plans,id";
        }
        $rules['registration'] = "required|exists:payment_plans,id";
        $this->validate($request, $rules);

        $plans = array();
        foreach ($subjects as $subject)
        {
            array_push($plans, $request->get('subject_' . $subject));
        }
        Session::put($this->plans_assign, $plans);
        Session::put($this->registraton_assign, $request->get('registration'));

        $registration = PaymentPlan::findOrFail($request->get('registration'));
        
        //proceso para guardar todo en la base de datos
        if ($option == 'new')
        {
            $p = \App\Models\Period::findOrFail($period);   
            $student->id_number = $this->generateIdNumber($establishment, $p->name, $grade);
            $this->saveNewStudent($student);
        }
        $this->assignGroup($student, $group, $period);
        $this->assignPlans($student, $plans, $registration->id);
        $dummy = new \App\Models\Establishment();
        $dummy->id = $establishment;
        $p = $service->makePaymentRegistration($student, $dummy, $registration);

        return redirect()->route('registration4', ['payment' => $p]);
    }

    // PASO 4: IMPRESIÓN DE RECIBO DE INSCRIPCIÓN
    public function getStep4(\Illuminate\Http\Request $request)
    {
        $classes = Session::get($this->classes_assign);
        $plans = Session::get($this->plans_assign);
        $student = Session::get($this->session_student);
        $option = Session::get($this->student_option);
        $registration = Session::get($this->registraton_assign);
        if ($student && $option)
        {
            if ($option == 'old')
            {
                $student = \App\Models\Student::findOrFail($student->id);
            }
        }
        else
        {
            redirect()->route('registration1')->withErrors('Error: debe seleccionar un estudiante');
        }

        if (!$classes)
        {
            redirect()->route('registration2')->withErrors('Error: no se asignaron correctamente los cursos al estudiante');
        }

        if (!$plans)
        {
            redirect()->route('registration3')->withErrors('Error: no se asignaron correctamente los planos de pago');
        }

        $data = [
            'student' => $student,
            'plans' => \App\Models\PaymentPlan::whereIn('id', $plans)->get(),
            'classes' => \App\Models\Class_::whereIn('id', $classes)->get(),
            'registration' => \App\Models\PaymentPlan::where('id', '=', $registration)->first(),
            'payment' => $request->get('payment')
        ];

        //SE BORRA TODA LA SESSION DEL WIZARD YA QUE LOS DATOS YA FUERON GUARDADOS
        Session::forget($this->classes_assign);
        Session::forget($this->plans_assign);
        Session::forget($this->session_student);
        Session::forget($this->student_option);
        Session::forget($this->registraton_assign);
        Session::forget($this->grade_assign);
        Session::forget($this->establishment_assign);
        Session::forget($this->group_assign);

        return view('registration/step4')->with($data);
    }

    /*
     * ---------------------------------------------
     * METODOS AUXILIARES PARA PROCESAR LA INFORMACIÓN DE INSCRIPCIÓN
     * --------------------------------------------- 
     */
    public function saveNewStudent(\App\Models\Student $student)
    {
        $student->save();
    }

    public function assignGroup(\App\Models\Student $student, $group, $period)
    {
        $registration = new \App\Models\Registration;
        $registration->group_id = $group;
        $registration->student_id = $student->id;
        $registration->period_id = $period;
        $registration->save();
    }

    public function assignPlans(\App\Models\Student $student, $plans, $registration)
    {
        $student->paymentPlans()->sync($plans, false);
        $student->paymentPlans()->sync([$registration], false);
    }
    
    /*
     * ---------------------------------------------
     * METODOS QUE CONTROLAN EL API REST JSON
     * --------------------------------------------- 
     */

    public function getGroups(\Illuminate\Http\Request $request)
    {
        $grade = $request->get('grade');
        $groups = \App\Models\Group::where('grade_id', '=', $grade)
                ->get();
        $data = array();
        foreach ($groups as $group)
        {
            $data[$group->id] = $group->name;
        }
        return response()->json(['groups' => $data]);
    }

    public function getPeriods()
    {
        $periods = \App\Models\Period::whereDate('end_date', '>=', Carbon::today()->toDateString())
                ->get();
        $data = array();
        foreach ($periods as $period)
        {
            $data[$period->id] = $period->name;
        }
        return response()->json(['periods' => $data]);
    }

    public function getSubjects(\Illuminate\Http\Request $request)
    {
        $establishment = $request->get('establishment');
        $group = $request->get('group');
        $subjects = \App\Models\Subject::whereHas('classes', function($query) use (&$establishment, &$group) {
                    $query->where('group_id', '=', $group)
                            ->where('establishment_id', '=', $establishment);
                })->get();
        $data = array();
        foreach ($subjects as $subject)
        {
            $data[$subject->id] = $subject->title;
        }
        return response()->json(['subjects' => $data]);
    }

    public function generateIdNumber($establishment, $period, $grade) {
        $id = (DB::select("show table status like 'students'"))[0]->Auto_increment;
        return $establishment."-".$period."-".$grade."-".$id;
    }
}
