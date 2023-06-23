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
use App\Http\Controllers\Auth\VerificationController;


// Route::get('/', function () {
//     return view('welcome');
// });

//Clear Cache facade value:
Route::get('/cache-clear', function() {
    Artisan::call('optimize:clear');
    return '<h1>All Cache cleared</h1>';
});

Auth::routes(['verify' => true]);

Route::get('email/verify/{id}/{hash}', [VerificationController::class,'verify'])->name('verification.verify');

// Auth Routes
Route::group(['middleware' => ['web','guest','preventBackHistory'], 'as' => 'auth.','prefix'=>''], function () {
    
    Route::view('signup/{referral_id?}/{package_uuid?}', 'auth.admin.register')->name('register');
    Route::view('login', 'auth.admin.login')->name('login');
    Route::view('forget-password', 'auth.admin.forget-password')->name('forget-password');
    Route::view('reset-password/{token}/{email}', 'auth.admin.reset-password')->name('reset-password');
 
});    

// Frontend Routes
Route::group(['middleware' => [], 'as' => 'front.','prefix'=>''], function () {

    Route::view('/', 'frontend.home')->name('home');
    Route::view('/about-us', 'frontend.about-us')->name('about-us');
    Route::view('/contact-us', 'frontend.contact-us')->name('contact-us');
    Route::view('/package/{uuid}', 'frontend.package.show')->name('package.show');


});

// Admin Routes
Route::group(['middleware' => ['auth','preventBackHistory']], function () {

    Route::view('admin/profile', 'auth.profile.index')->name('auth.admin-profile')->middleware('role:admin');
    Route::view('user/profile', 'auth.profile.index')->name('auth.user-profile')->middleware('role:user');

    Route::group(['middleware'=>['role:admin'],'as' => 'admin.','prefix'=>'admin'], function () {
        
        Route::view('dashboard', 'admin.index')->name('dashboard');
        Route::view('packages', 'admin.package.index')->name('package');
        Route::view('testimonials', 'admin.testimonial.index')->name('testimonial');
        Route::view('faqs', 'admin.faq.index')->name('faq');
        Route::view('sliders', 'admin.slider.index')->name('slider');

        Route::view('settings', 'admin.setting.index')->name('setting');
        Route::view('page-manage', 'admin.page-manage.index')->name('page-manage');
        Route::view('user-manage', 'admin.user-manage.index')->name('user-manage');
        Route::view('courses', 'admin.course.index')->name('course');
        Route::view('courses/{course_id}', 'admin.video-group.index')->name('getAllVideos');

    });

    Route::group(['middleware'=>['role:user'],'as' => 'user.','prefix'=>'user'], function () {
        
        Route::view('dashboard', 'user.index')->name('dashboard');

    });

});