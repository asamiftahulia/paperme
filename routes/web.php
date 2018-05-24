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
Route::resource('timedeposit','TimeDepositController');
Route::resource('time-deposit','TDController');
Route::get('/summary', 'TDController@show')->name('summary');
Route::resource('master-bank','MasterBankController');
Route::resource('master-branch','MasterBranchController');
Route::resource('user','UserController');
Route::resource('tipe-deposito','TipeDepositoController');
Route::resource('trx-time-deposit','TransactionTimeDepositController');
Route::resource('test','TestController');
Route::get('/downloadPDF/{id}','TestController@downloadPDF');
Route::get('/uploadFile','UploadFileController@index');
Route::post('/uploadfile','UploadFileController@showUploadFile');

// time deposit

Route::resource('td','TDController');
Route::resource('trx','TransactionTimeDepositController');
Route::get('/summary','TDController@show')->name('summary');
Route::get('downloadSummary/{id}','TDController@downloadSummary');
Route::get('timeline/{id}','TDController@timeline');
Route::post('td/revisi/{id}','TDController@revisi');
Route::post('trx/reject/{id}','TransactionTimeDepositController@reject');
Route::get('td/updateStatus/{id}','TransactionTimeDepositController@validasiApprover');
Route::resource('special-rate','MasterSpecialRateController');
//toastr
Route::get('/tost', function(){
    return view('test-toastr');
});

Route::post('/submitdata','TestController@toastrFunction');

//route to show the login form
 Route::get('login',array('uses'=>"LoginApiController@showLogin"));

//route to process the form
Route::post('login', array('uses'=>'LoginApiController@doLogin'));

Route::get('logout',array('uses'=>'LoginApiController@logout'));
Route::post('verify',function(){
    
    var_dump($_POST);
});

