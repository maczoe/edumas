<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes
    //REST API Routes
        // Route::get('registration/api/groups', [
        //     'as' => 'api_get_groups',
        //     'uses' => 'admin\RegistrationController@getGroups'
        // ]);
        // Route::get('registration/api/subjects', [
        //     'as' => 'api_get_subjects',
        //     'uses' => 'admin\RegistrationController@getSubjects'
        // ]);
});

Route::get('registration/api/groups', [
    'as' => 'api_get_groups',
    'uses' => 'admin\RegistrationController@getGroups'
]);

Route::get('registration/api/periods', [
    'as' => 'api_get_periods',
    'uses' => 'admin\RegistrationController@getPeriods'
]);

Route::get('registration/api/subjects', [
    'as' => 'api_get_subjects',
    'uses' => 'admin\RegistrationController@getSubjects'
]);

//****** Rutas API Datatables **********
Route::get('maintenances/establishments', [
    'as' => 'api_get_establishments_datatable',
    'uses' => 'maintenances\EstablishmentsController@getDatatable'
]);

Route::get('maintenances/students', [
    'as' => 'api_get_students_datatable',
    'uses' => 'maintenances\StudentsController@getDatatable'
]);

Route::get('maintenances/teachers', [
    'as' => 'api_get_teachers_datatable',
    'uses' => 'maintenances\TeachersController@getDatatable'
]);

Route::get('maintenances/subjects', [
    'as' => 'api_get_subjects_datatable',
    'uses' => 'maintenances\SubjectsController@getDatatable'
]);

Route::get('maintenances/grades', [
    'as' => 'api_get_grades_datatable',
    'uses' => 'maintenances\GradesController@getDatatable'
]);

Route::get('maintenances/classes', [
    'as' => 'api_get_classes_datatable',
    'uses' => 'maintenances\ClassController@getDatatable'
]);

Route::get('maintenances/periods', [
    'as' => 'api_get_periods_datatable',
    'uses' => 'maintenances\PeriodsController@getDatatable'
]);

Route::get('maintenances/payment_plans', [
    'as' => 'api_get_paymentplans_datatable',
    'uses' => 'maintenances\PaymentPlansController@getDatatable'
]);

Route::get('maintenances/series', [
    'as' => 'api_get_series_datatable',
    'uses' => 'maintenances\SeriesController@getDatatable'
]);