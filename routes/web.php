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
    return redirect('admin/');
    //return view("welcome");
});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Auth::routes();

Route::get('/logout', 'HomeController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/subscribe', 'HomeController@subscribe');
Route::get('/confirm-subscribe-submit', 'HomeController@confirmsubscribesubmit');
Route::get('/contact', 'HomeController@contact');
Route::post('/contactpost', 'HomeController@contactpost');

Route::post('/UploadFile', 'Controller@UploadFile');

Route::group(['prefix' => 'worker', 'middleware' => ['worker']], function () {
  Route::get('/', function () {
      return redirect("home");
  });
  Route::get('/home', 'Company\HomeController@home');
  Route::get('/ViewProfile', 'Company\HomeController@ViewProfile');
  Route::get('/EditProfileView', 'Company\HomeController@EditProfileView');
  Route::post('/EditProfilePost', 'Company\HomeController@EditProfilePost');
});