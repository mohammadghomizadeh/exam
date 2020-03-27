<?php
Auth::routes();
Route::get('/register', function () {return view('auth.login');});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {return view('welcome');});
Route::middleware(['auth'])->group(function () {
    Route::resource('/Companies','CompanyController');
    Route::post('/Companies/{id}','CompanyController@destroy')->name('companies.destroy');
    Route::resource('/Employees','EmployeeController');
    Route::post('/Employees/{id}','EmployeeController@destroy')->name('employees.destroy');
});
