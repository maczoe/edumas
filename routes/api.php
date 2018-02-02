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
