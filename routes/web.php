<?php

use Illuminate\Support\Facades\Route;

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

//Clear Cache facade value:
Route::get('/cache-clear', function() {
    Artisan::call('optimize:clear');
    return '<h1>All Cache cleared</h1>';
});


Route::group(['middleware' => ['web'], 'as' => 'auth.','prefix'=>'auth'], function () {
    
    Route::view('login', 'auth.admin.login')->name('login');

});    


Route::group(['middleware' => ['preventBackHistory']], function () {

    Route::group(['as' => 'admin.','prefix'=>'admin'], function () {
        
        Route::view('dashboard', 'admin.index')->name('dashboard');
        Route::view('package', 'admin.package.index')->name('package');
        Route::view('testimonial', 'admin.testimonial.index')->name('testimonial');
        Route::view('faq', 'admin.faq.index')->name('faq');


    });

});