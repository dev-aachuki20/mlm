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
    Route::view('forget-password', 'auth.admin.forget-password')->name('forget-password');
    Route::view('reset-password/{token}/{email}', 'auth.admin.reset-password')->name('reset-password');
});    


Route::group(['middleware' => ['auth','preventBackHistory']], function () {

    Route::view('admin/profile', 'auth.profile.index')->name('auth.admin-profile');
    Route::view('user/profile', 'auth.profile.index')->name('auth.user-profile');

    Route::group(['as' => 'admin.','prefix'=>'admin'], function () {
        
        Route::view('dashboard', 'admin.index')->name('dashboard');
        Route::view('package', 'admin.package.index')->name('package');
        Route::view('testimonial', 'admin.testimonial.index')->name('testimonial');
        Route::view('faq', 'admin.faq.index')->name('faq');
        Route::view('slider', 'admin.slider.index')->name('slider');

    });

    Route::group(['as' => 'user.','prefix'=>'user'], function () {
        
        Route::view('dashboard', 'user.index')->name('dashboard');

    });

});