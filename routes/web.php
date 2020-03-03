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
//顯示所有未被託管的寵物
Route::get('/', 'IndexController@create');
//當他的保母
Route::post('/', 'IndexController@createFoster');

//搜尋
Route::any('/search', 'IndexController@searchPet');
//搜尋
//Route::get('/search', 'IndexController@createSearch');

//顯示寄養寵物表單
Route::get('/apply', 'CareController@showForm');
//新增寄養寵物
Route::post('/apply', 'CareController@createCareForm');
//顯示寄養紀錄
Route::get('/care', 'CareController@userPetList');

//顯示託管紀錄
Route::get('/foster', 'CareController@showFoster');
//取消託管
Route::delete('/foster', 'CareController@deleteFoster');

//查看申請者
Route::get('/applicant/{pet}', 'CareController@applicantList');
//委託申請者
Route::patch('/applicant/{pet}', 'CareController@updateFoster')->name('applicant');



Auth::routes();
//使用者登入
Route::post('/auth/login','Auth\LoginController@login');
//使用者註冊
Route::post('/auth/register','Auth\RegisterController@register');
//使用者註冊頁面
Route::get('/auth/register','MyLoginController@register');
//使用者登入頁面
Route::get('/auth/login','MyLoginController@login');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
