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
use App\Http\Controllers\PageController;


// Route::get('/', function () {
//     return view('welcome');
// });

//Clear Cache facade value:
Route::get('/cache-clear', function() {
    Artisan::call('optimize:clear');
    return '<h1>All Cache cleared</h1>';
});

// Auth::routes(['verify' => true,'login' => false,'register'=>false]);

Route::get('email/verify/{id}/{hash}', [VerificationController::class,'verify'])->name('verification.verify');

// Auth Routes
Route::group(['middleware' => ['web','guest','preventBackHistory'], 'as' => 'auth.','prefix'=>''], function () {
    
    Route::view('signup-with-package/{package_uuid?}', 'auth.admin.register')->name('registerWithPlan');
    Route::view('signup/{referral_id?}/{package_uuid?}', 'auth.admin.register')->name('register');
    Route::view('login', 'auth.admin.login')->name('login');
    Route::view('forget-password', 'auth.admin.forget-password')->name('forget-password');
    Route::view('reset-password/{token}/{email}', 'auth.admin.reset-password')->name('reset-password');
 
});    

// Frontend Routes
Route::group(['middleware' => [], 'as' => 'front.','prefix'=>''], function () {

    Route::view('/', 'frontend.home')->name('home');
    Route::view('/about-us', 'frontend.about-us')->name('about-us');
    Route::view('/how-myfuturebiz-works', 'frontend.how-myfuturebiz-works')->name('how-myfuturebiz-works');
    Route::view('/teams', 'frontend.teams')->name('teams');
    Route::view('/testimonials', 'frontend.testimonial')->name('testimonials');
    Route::view('/contact-us', 'frontend.contact-us')->name('contact-us');
    Route::view('/package/{uuid}', 'frontend.package.show')->name('package.show');

    //Other pages
    Route::get('/{slug}', [PageController::class,'show'])->name('pages.show');

});

// Admin Routes
Route::group(['middleware' => ['auth','preventBackHistory']], function () {

    Route::view('admin/profile', 'auth.profile.index')->name('auth.admin-profile')->middleware('role:admin');
    Route::view('user/profile', 'auth.profile.index')->name('auth.user-profile')->middleware('role:user,role:ceo,role:management');

    
    Route::view('admin/change-password', 'auth.profile.change-password')->name('auth.admin-change-password')->middleware('role:admin');
    Route::view('user/change-password', 'auth.profile.change-password')->name('auth.user-change-password')->middleware('role:user,role:ceo,role:management');

    Route::group(['middleware'=>['role:admin'],'as' => 'admin.','prefix'=>'admin'], function () {
        Route::view('dashboard', 'admin.index')->name('dashboard');
        Route::view('packages', 'admin.package.index')->name('package');
        Route::view('testimonials', 'admin.testimonial.index')->name('testimonial');
        Route::view('faqs', 'admin.faq.index')->name('faq');
        Route::view('sliders', 'admin.slider.index')->name('slider');

        Route::view('settings', 'admin.setting.index')->name('setting');
        Route::view('page-manage', 'admin.page-manage.index')->name('page-manage');
        Route::view('teams', 'admin.team.index')->name('team');
        Route::view('user-manage', 'admin.user-manage.index')->name('user-manage');
        Route::view('courses', 'admin.course.index')->name('course');
        Route::view('courses/{course_id}', 'admin.video-group.index')->name('getAllVideos');
        Route::view('leaderboard', 'admin.partials.leaderboard')->name('leaderboard');
        Route::view('kyc', 'admin.kyc.index')->name('kyc');
        Route::view('webinars', 'admin.webinar.index')->name('webinar');
        Route::view('sales-report', 'admin.report.sales-report')->name('sales-report');

    });

    Route::group(['middleware'=>['role:user'],'as' => 'user.','prefix'=>'user'], function () {
        Route::view('dashboard', 'user.index')->name('dashboard');
        Route::view('kyc', 'user.kyc.index')->name('kyc');
        Route::view('myteam', 'user.myteam.index')->name('myteam');
        Route::view('leaderboard', 'user.leaderboard.index')->name('leaderboard');
        Route::view('my-courses', 'user.my-courses.index')->name('my-courses');
        Route::view('webinar', 'user.webinar.index')->name('webinar');
        Route::view('invoice', 'user.invoice.index')->name('invoice');
        Route::view('referral-link', 'user.referral-link')->name('referral-link');
        Route::view('customer-support', 'user.customer-support')->name('customer-support');
        Route::get('{slug}', [PageController::class,'userPage'])->name('page');
    });

});