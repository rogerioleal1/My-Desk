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


Auth::routes(['register' => false]);

Route::middleware(['auth', 'check.user', 'permissions'])->group(function () {
    
    Route::get('/', 'HomeController@index');    
    
    Route::get('home', 'HomeController@index')->name('home');

    Route::get('edit-profile', 'ChangeProfile@index')->name('profile.edit');
	Route::put('save-profile', 'ChangeProfile@update')->name('profile.update');

    Route::resource('users', 'UserController');
    Route::resource('groups', 'GroupController');

    Route::post('groups-permissions', 'GroupPermissionController@store')->name('groups.permissions.store');
    Route::delete('groups-permissions/{group_id}/{permission_id}', 'GroupPermissionController@destroy')->name('groups.permissions.destroy');

    Route::get('profile', 'ProfileController')->name('profile');
    
    Route::resource('settings', 'SettingController');
    Route::resource('messages', 'MessageController');
    Route::resource('companies', 'CompanyController');
    Route::resource('systems', 'SystemController');
    Route::resource('permissions', 'PermissionController');
    
    Route::resource('categories', 'CategoryController');
    Route::resource('tickets', 'TicketController');
    
    Route::put('tickets/{id}/feedback', 'TicketController@feedback')->name('tickets.feedback');
    Route::post('tickets/followup', 'TicketController@followup')->name('tickets.followup');
    
    Route::delete('documents/{id}', 'DocumentController@destroy')->name('documents.destroy');
    
    // Reports
    Route::get('users-report', 'HomeController@index')->name('users.report');
    Route::get('tickets-report', 'HomeController@index')->name('tickets.report');

});
