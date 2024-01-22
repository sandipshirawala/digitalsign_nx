<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\formController;
use App\Http\Controllers\dashboardController;

use App\Http\Middleware\checkLogin;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

/*
Route::get('/dashboard', function () {
    return view('dashboard');
});
*/

Route::get('/dashboard', 'App\Http\Controllers\dashboardController@dashboard')->name('dashboard');

/*
Route::get('/get_signature', function () {
    return view('get_signature');
});
*/

Route::get('/get_signature', 'App\Http\Controllers\getsignController@get_signature')->name('get_signature');
Route::post('/send_signature_form', 'App\Http\Controllers\getsignController@send_signature_form')->name('send_signature_form');
Route::get('/sent_doc', 'App\Http\Controllers\getsignController@sent_doc')->name('sent_doc');
Route::get('/signed_doc', 'App\Http\Controllers\getsignController@signed_doc')->name('signed_doc');

/*
Route::get('/sent_doc', function () {
    return view('sent_doc');
});

Route::get('/signed_doc', function () {
    return view('signed_doc');
});
*/

Route::get('/forms', function () {
    return view('forms');
});

/*
Route::get('/add_form', function () {
    return view('add_form');
});
*/
/*
Route::get('/customer_sign', function () {
    return view('customer_sign');
});
*/
/*
Route::get('/customer_sign_2', function () {
    return view('customer_sign_2');
});
*/
/*
Route::get('/customer_sign_option', function () {
    return view('customer_sign_option');
});
*/
Route::get('/customer_sign_option', 'App\Http\Controllers\customerController@customer_sign_option')->name('customer_sign_option');
Route::get('/customer_sign_2', 'App\Http\Controllers\customerController@customer_sign_2')->name('customer_sign_2');
Route::get('/customer_sign', 'App\Http\Controllers\customerController@customer_sign')->name('customer_sign');
Route::post('/upload_reply', 'App\Http\Controllers\customerController@upload_reply')->name('upload_reply');
Route::post('/save_file', 'App\Http\Controllers\customerController@save_file')->name('save_file');




Route::get('/add_form', 'App\Http\Controllers\formController@add_form')->name('add_form');
Route::post('/upload_form', 'App\Http\Controllers\formController@upload_form')->name('upload_form');
Route::get('/form_list', 'App\Http\Controllers\formController@form_list')->name('form_list');

//added 14_10_2023
Route::get('/download_file_by_id/{form_id}', 'App\Http\Controllers\formController@download_file_by_id')->name('download_file_by_id');
Route::get('/form_delete/{form_id}', 'App\Http\Controllers\formController@form_delete')->name('form_delete');

//added 14_10_2023



Route::get('/download/{file}', 'customerController@download')->name('download');


Route::get('/categories', 'App\Http\Controllers\settingsController@categories')->name('categories');
Route::get('/delete_category/{category_id}', 'App\Http\Controllers\settingsController@delete_category')->name('delete_category');
Route::post('/add_category', 'App\Http\Controllers\settingsController@add_category')->name('add_category');



Route::get('/get_status/{document_id}/{form_id}', 'App\Http\Controllers\getsignController@get_status')->name('get_status');

Route::get('/download_signedfile_by_id/{document_reply_id}', 'App\Http\Controllers\getsignController@download_signedfile_by_id')->name('download_signedfile_by_id');
Route::get('/documentreply_delete/{document_reply_id}', 'App\Http\Controllers\getsignController@documentreply_delete')->name('documentreply_delete');


Route::get('/document_delete/{document_id}/{form_id}', 'App\Http\Controllers\getsignController@document_delete')->name('document_delete');
Route::get('/get_file_original_name/{form_id}', 'App\Http\Controllers\getsignController@get_file_original_name')->name('get_file_original_name');


//flatten file
Route::post('/save_flatten_file', 'App\Http\Controllers\customerController@save_flatten_file')->name('save_flatten_file');
//flatten file


Route::get('/resend_email/{document_id}/{form_id}', 'App\Http\Controllers\getsignController@resend_email')->name('resend_email');

//LOGIN - REGISTER
Route::get('/login', 'App\Http\Controllers\registerController@login')->name('login');
Route::get('/register', 'App\Http\Controllers\registerController@register')->name('register');

Route::post('/save_company', 'App\Http\Controllers\registerController@save_company')->name('save_company');
Route::post('/login_check', 'App\Http\Controllers\registerController@login_check')->name('login_check');

Route::get('/logout', 'App\Http\Controllers\registerController@logout')->name('logout');


Route::get('/otp', 'App\Http\Controllers\registerController@otp')->name('otp');
Route::get('/regenerate_otp', 'App\Http\Controllers\registerController@regenerate_otp')->name('regenerate_otp');
Route::post('/otp_check', 'App\Http\Controllers\registerController@otp_check')->name('otp_check');


Route::fallback(function () {
    return redirect()->route('dashboard');
});


//certificate
Route::get('/generate_certificate', 'App\Http\Controllers\customerController@generate_certificate')->name('generate_certificate');
Route::get('/certificate', 'App\Http\Controllers\customerController@certificate')->name('certificate');
Route::get('/merge_pdf', 'App\Http\Controllers\customerController@merge_pdf')->name('merge_pdf');

Route::post('/merge_flatten_file', 'App\Http\Controllers\customerController@merge_flatten_file')->name('merge_flatten_file');


Route::get('/cancel_review', 'App\Http\Controllers\customerController@cancel_review')->name('cancel_review');
