<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
//auth
Route::view('/signup','auth.signup')->name('signup.view');
Route::view('/login','auth.login')->name('login.view');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::post('/signup',[AuthController::class,'signup'])->name('signup');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::view('/forget-password','auth.forget-password');
Route::post('/forget-password',[ForgetPasswordController::class,'forgetPassword'])->middleware('guest')->name('forget.password');
Route::get('/reset-password/{token}',[ResetPasswordController::class,'resetPasswordView'])->name('reset.password');
Route::controller(GoogleController::class)->group(function (){
    Route::get('auth/google','redirectToGoogle')->name('auth.google');
    Route::get('/callback','handleCallback');
});
Route::post('/reset-password',[ResetPasswordController::class,'resetPassword'])->name('reset.password.post');



//Route::get('/email/verify', function () {
//    return view('auth.verify-email');
//})->middleware('auth')->name('verification.notice');
//
//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill();
//    return redirect('/login'); //صفحه ای که قراره بعد از تایید ایمیل بهش ریدایرکت بشه
//})->middleware(['auth', 'signed'])->name('verification.verify');
//
//Route::post('/email/verification-notification', function (Request $request) {
//    $request->user()->sendEmailVerificationNotification();
//    return back()->with('message', 'لینک تایید مجددا ارسال شد');
//})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//auth

//dashboard
Route::group(['prefix'=>'admin/','middleware'=>['isAdmin']],function (){
    Route::get('panel',function (){
       return view('panel');
    })->name('dashboard');
});

//dashboard


//Tips:
//Route::redirect('/here','/signup'); for change route
//Route::any(url,controller); for same routes
//Route::match(['get','post'],'/',function(){
//    return view('auth.login');
//}); for same routes
//Route::view('/','auth.login',['name'=>'reza']); in blade {{ $name }} output reza
//php artisan r:l this don't display routes middleware for display routes middleware type php artisan r:l -v
//url:'/users/{id}' id is parameter and in cotroller function($id)
//Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {

//});  for name parameter must alphabetic characters and can be _

//Route::get('/user/{name?}', function ($name = null) {
//    return $name;
//});
//
//Route::get('/user/{name?}', function ($name = 'John') {
//    return $name;
//}); {name?} this is a parameter that may not always be present in the URI Make sure to give the route's corresponding variable a default value:
//where in route
//Route::get('/user/{name}', function ($name) {
//    //
//})->where('name', '[A-Za-z]+');
//
//Route::get('/user/{id}', function ($id) {
//    //
//})->where('id', '[0-9]+');
//
//Route::get('/user/{id}/{name}', function ($id, $name) {
//    //
//})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
//Route::get('/user/{id}/{name}', function ($id, $name) {
//    //
//})->whereNumber('id')->whereAlpha('name');
//
//Route::get('/user/{name}', function ($name) {
//    //
//})->whereAlphaNumeric('name');
//
//Route::get('/user/{id}', function ($id) {
//    //
//})->whereUuid('id');
//
//Route::get('/category/{category}', function ($category) {
//    //
//})->whereIn('category', ['movie', 'song', 'painting']);
//Route::get('/user/profile', function () {
//    //
//})->name('profile'); (!) Route names should always be unique.

//Route::get('/user/{id}/profile', function ($id) {
//    //
//})->name('profile');
//
//$url = route('profile', ['id' => 1]);
//If you pass additional parameters in the array, those key / value pairs will automatically be added to the generated URL's query string:
//Route::get('/user/{id}/profile', function ($id) {

//})->name('profile');

//$url = route('profile', ['id' => 1, 'photos' => 'yes']);

// /user/1/profile?photos=yes |  ?photos=yes this is query string
// for use from name route in middleware
//if ($request->route()->named('profile')) {

//}

//Route::controller(OrderController::class)->group(function () {
//    Route::get('/orders/{id}', 'show');
//    Route::post('/orders', 'store');
//});
//Route::middleware(['auth','admin'])->group(function(){
//  routes
//});
//for prefix route group
//Route::name('admin.')->group(function () {
//    Route::get('/users', function () {
//        // Route assigned name "admin.users"...
//    })->name('users');
//});

//از آنجایی که متغیر $user به‌عنوان مدل App\Models\User Eloquent نشان داده می‌شود و نام متغیر با بخش URI {user} مطابقت دارد، لاراول به‌طور خودکار نمونه مدلی را که دارای شناسه مطابق با مقدار مربوطه از URI درخواست است، تزریق می‌کند. اگر یک نمونه مدل منطبق در پایگاه داده یافت نشد، یک پاسخ HTTP 404 به طور خودکار ایجاد می شود.
//Route::get('/users/{user}', function (User $user) {
//    return $user->email;
//});
//گاهی اوقات ممکن است بخواهید مدل های Eloquent را با استفاده از ستونی غیر از id حل کنید. برای انجام این کار، می توانید ستون را در تعریف پارامتر مسیر مشخص کنید:
//Route::get('/posts/{post:slug}', function (Post $post) {
//    return $post;
//});
//Route::get('/users/{user}/posts/{post:slug}', function (User $user, Post $post) {
//    return $post;
//});
