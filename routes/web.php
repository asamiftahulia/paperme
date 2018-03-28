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
    return view('welcome');
});

Route::resource('dashboard','DashboardController');
Route::resource('customer','CustomerController');
Route::resource('/create','CustomerController');
// Route::resource('time-deposit','TimeDepositController');
Route::resource('time-deposit','TDController');
Route::resource('test','TestController');
Route::resource('masterbank','MasterBankController');
Route::resource('user','UserController');
Route::resource('tipe-deposito','TipeDepositoController');
Route::resource('trx-time-deposit','TransactionTimeDepositController');
