<?php

namespace App\Helpers\Contracts;

use App\Models\Student;
use App\Models\Establishment;
use App\Models\PaymentPlan;

Interface PaymentServiceContract {
    public function makePaymentRegistration(Student $student, Establishment $establishment, PaymentPlan $registrationPlan);
    public function makePaymentAcademic(Student $student, $details, PaymentPlan $plan, Establishment $establishment, $comment);
    public function makePaymentSales($client, Establishment $establishment, array $details);
}

