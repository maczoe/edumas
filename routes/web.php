<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    Route::get('admin', [
            'uses' => 'admin\AdminController@index',
            'as' => 'admin'
        ]);
        
        Route::get('registration-step1', [
            'uses' => 'admin\RegistrationController@getStep1',
            'as' => 'registration1'
        ]);
        
        Route::post('registration-step1', [
            'uses' => 'admin\RegistrationController@postStep1',
            'as' => 'registration1'
        ]);
        
        Route::get('registration-step2', [
            'uses' => 'admin\RegistrationController@getStep2',
            'as' => 'registration2'
        ]);
        
        Route::post('registration-step2', [
            'uses' => 'admin\RegistrationController@postStep2',
            'as' => 'registration2'
        ]);
        
        Route::get('registration-step3', [
            'uses' => 'admin\RegistrationController@getStep3',
            'as' => 'registration3'
        ]);
        
        Route::post('registration-step3', [
            'uses' => 'admin\RegistrationController@postStep3',
            'as' => 'registration3'
        ]);
        
        Route::get('registration-step4', [
            'uses' => 'admin\RegistrationController@getStep4',
            'as' => 'registration4'
        ]);
        
        Route::get('print_invoice', [
            'uses' => 'admin\PaymentsController@printInvoice',
            'as' => 'print_invoice'
        ]);
        
        Route::get('payments', [
            'uses' => 'admin\PaymentsController@index',
            'as' => 'payments'
        ]);
        
        Route::post('payments', [
            'uses' => 'admin\PaymentsController@search',
            'as' => 'payments'
        ]);
        
        Route::get('payments-reprint/$id', [
            'uses' => 'admin\PaymentsController@reprint',
            'as' => 'payments.reprint'
        ]);
        
        Route::get('payments-cancel/$id', [
            'uses' => 'admin\PaymentsController@cancel',
            'as' => 'payments.cancel'
        ]);
        
        Route::get('payments-do', [
            'uses' => 'admin\PaymentsController@doPayment',
            'as' => 'payments.do'
        ]);
        
        Route::get('marks', [
            'uses' => 'admin\MarksController@index',
            'as' => 'marks'
        ]);
        
        Route::get('marks-export', [
            'uses' => 'admin\MarksController@export',
            'as' => 'marks.export'
        ]);
        
        Route::resource('maintenances/students', 'maintenances\StudentsController');
        Route::resource('maintenances/establishments', 'maintenances\EstablishmentsController');
        Route::resource('maintenances/teachers', 'maintenances\TeachersController');
        Route::resource('maintenances/subjects', 'maintenances\SubjectsController');
        Route::resource('maintenances/grades', 'maintenances\GradesController');
        Route::resource('maintenances/groups', 'maintenances\GroupController');
        Route::resource('maintenances/classes', 'maintenances\ClassController');
        Route::resource('maintenances/payment_plans', 'maintenances\PaymentPlansController');
        Route::resource('maintenances/products', 'maintenances\ProductsController');
        Route::resource('maintenances/series', 'maintenances\SeriesController');
});
