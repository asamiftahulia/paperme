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
Route::get('/summaryCol', 'TDCollectiveController@show')->name('summary');
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
Route::resource('ajax','WelcomeController');
Route::post('{id}/getRequest','WelcomeController@getRequest');
Route::resource('tdc','TDCollectiveController');
Route::resource('trx','TransactionTimeDepositController');
Route::get('/summary','TDController@show')->name('summary');
Route::get('downloadSummary/{id}','TDController@downloadSummary');
Route::get('timeline/{id}','TDController@timeline');
Route::get('/timelineCol/{id_memmo}',[
    'as' => 'tdc.timeline',
    'uses' => 'TDCollectiveController@timelineCollective'
]);


Route::get('CollectiveNewTD/{id}','TDController@insertTdUserForCollectiveTDNew');
Route::patch('/InsertCol',[
    'as' => 'td.storeCol',
    'uses' => 'TDController@storeCol'
]);

Route::get('/td-finish',[
    'as' => 'td.indexFinish',
    'uses' => 'TDController@indexFinish'
]);

Route::get('/tab-menu',[
    'as' => 'td.tab',
    'uses' => 'TDController@tabMenu'
]);

Route::post('td/revisi/{id}','TDController@revisi');
Route::get('td/renew/{id}','TDController@renew');
Route::post('trx/revisi/{id}','TransactionTimeDepositController@revisi');
Route::post('trx/reject/{id}','TransactionTimeDepositController@reject');
Route::get('td/updateStatus/{id}','TransactionTimeDepositController@validasiApprover');
Route::resource('special-rate','MasterSpecialRateController');
//renew
Route::patch('td/renew/{id}',[
    'as' => 'td.renew',
    'uses' => 'TDController@renew'
]);

Route::post('td/CreateRenew',[
    'as' => 'td.CreateRenew',
    'uses' => 'TDController@CreateRenew'
]);

Route::post('trx/storeCol',[
    'as' => 'trx.storeCol',
    'uses' => 'TransactionTimeDepositController@storeCol'
]);


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

Route::get('image-upload-with-validation',['as'=>'getuploadimage','uses'=>'ImageUploadController@getUploadImage']);
Route::get('image-upload-with-validation',['as'=>'viewImage','uses'=>'ImageUploadController@viewImage']);
Route::post('image-upload-with-validation',['as'=>'postuplodeimage','uses'=>'ImageUploadController@postUplodeImage']);
