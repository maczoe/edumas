<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role' => $faker->randomElement(['admin', 'user', 'student', 'teacher', 'super-admin'])
    ];
});

$factory->define(App\Models\Student::class, function (Faker\Generator $faker) {
    $users = App\Models\User::all()->where('role', 'student')->pluck('id')->all();
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'id_number' => $faker->unique()->numerify('######'),
        'phone_number' => $faker->numerify("####-####"),
        'cellphone_number' => $faker->numerify("####-####"),
        'address' => $faker->address,
        'birth_date' => $faker->dateTimeBetween($startDate = '-60 years')->format('d/m/Y'),
        'gender' => $faker->randomElement(['M', 'F']),
        'comment' => $faker->text(100),
        'user_id' => $faker->randomElement($users)
    ];
});

$factory->define(App\Models\Subject::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->unique()->title,
        'comment' => $faker->text(100),
        'min_mark' => $faker->randomElement([61, 70, 60]),
    ];
});

$factory->define(App\Models\Teacher::class, function (Faker\Generator $faker) {
    $users = App\Models\User::all()->where('role', 'teacher')->pluck('id')->all();
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'id_number' => $faker->unique()->numerify('######'),
        'phone_number' => $faker->numerify("####-####"),
        'cellphone_number' => $faker->numerify("####-####"),
        'address' => $faker->address,
        'comment' => $faker->text(100),
        'user_id' => $faker->randomElement($users)
    ];
});

$factory->define(App\Models\Grade::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->title,
    ];
});

$factory->define(App\Models\Group::class, function (Faker\Generator $faker) {
    $grades = App\Models\Grade::all()->pluck('id')->all();
    $start = $faker->date();
    $starttime = $faker->time('g:i A');
    return [
        'section' => $faker->randomLetter,
        'days' => implode(",", $faker->randomElements(array(1,2,3,4,5,6,7), $faker->numberBetween(1, 7))),        
        'start_date' => $start,
        'end_date' => $faker->dateTimeBetween($start, '+3 months'),
        'start_time' => $starttime."",
        'end_time' => $starttime."",
        'grade_id' => $faker->randomElement($grades)
    ];
});

$factory->define(App\Models\Establishment::class, function (Faker\Generator $faker) {
    return [
        'id_number' => $faker->numerify('######'),
        'name' => $faker->name,
        'phone_number' => $faker->phoneNumber,
        'address' => $faker->address,
        'comment' => $faker->text(100)
    ];
});

$factory->define(App\Models\Class_::class, function (Faker\Generator $faker) {
    $subject = App\Models\Subject::all()->pluck('id')->all();
    $teacher = App\Models\Teacher::all()->pluck('id')->all();
    $group = App\Models\Group::all()->pluck('id')->all();
    $establishment = App\Models\Establishment::all()->pluck('id')->all();
    $starttime = $faker->time('g:i A');
    return [
        'start_time' => $starttime."",
        'end_time' => $starttime."",
        'subject_id' => $faker->randomElement($subject),
        'teacher_id' => $faker->randomElement($teacher),
        'group_id' => $faker->randomElement($group),
        'establishment_id' => $faker->randomElement($establishment)
    ];
});

$factory->define(App\Models\PaymentPlan::class, function (Faker\Generator $faker) {
    $subject = App\Models\Subject::all()->pluck('id')->all();
    $grades = App\Models\Grade::all()->pluck('id')->all();
    $establishment = App\Models\Establishment::all()->pluck('id')->all();
    return [
        'comment' => $faker->text(100),
        'pay_day' => $faker->numberBetween(1,29),
        'period' => $faker->randomElement(['monthly', 'weekly', 'quarterly', 'biannual', 'annual']),
        'price' => $faker->randomFloat(2, 100, 1000),
        'fault' => $faker->randomFloat(2, 10, 100),
        'establishment_id' => $faker->randomElement($establishment),
        'subject_id' => $faker->randomElement($subject),
        'grade_id' => $faker->randomElement($grades)
    ];
});

$factory->define(App\Models\Payment::class, function (Faker\Generator $faker) {
    $prices = App\Models\PaymentPlan::all()->pluck('price')->all();
    $users = App\Models\User::all()->pluck('id')->all();
    $students = App\Models\Student::all()->pluck('id')->all();
    return [
        'document_number' => $faker->numerify('#######'),
        'document_series' => $faker->randomLetter,
        'date_time' => $faker->dateTime,
        'payment' => $faker->randomElement($prices),
        'user_id' => $faker->randomElement($users),
        'student_id' => $faker->randomElement($students)
    ];
});

$factory->define(App\Models\Attendance::class, function (Faker\Generator $faker) {
    $class = App\Models\Class_::all()->pluck('id')->all();
    $users = App\Models\User::all()->pluck('id')->all();
    $students = App\Models\Student::all()->pluck('id')->all();
    return [
        'date' => $faker->date(),
        'attended' => $faker->boolean(90),
        'class_id' => $faker->randomElement($class),
        'user_id' => $faker->randomElement($users),
        'student_id' => $faker->randomElement($students)
    ];
});

$factory->define(App\Models\Mark::class, function (Faker\Generator $faker) {
    $class = App\Models\Class_::all()->pluck('id')->all();
    $students = App\Models\Student::all()->pluck('id')->all();
    return [
        'mark' => $faker->numberBetween(10, 100),
        'detail' => $faker->text(100),
        'class_id' => $faker->randomElement($class),
        'student_id' => $faker->randomElement($students)
    ];
});
