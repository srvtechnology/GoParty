<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});
 
// Route::group([
 
//    'middleware' => 'api',
 
// ], function ($router) {
 
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::post('me', 'AuthController@me');

// });

Route::post('users', 'UserController@index');
Route::group([
    'middleware' => ['api','jwt.verify'],
], function ($router) {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    

    // service-add 
    Route::get('service-add-view','Api\Service\ServiceController@addView');
    Route::post('service-add','Api\Service\ServiceController@add');
    Route::get('service-listing','Api\Service\ServiceController@listing');
    Route::get('service-delete/{id}','Api\Service\ServiceController@delete');
    Route::get('service-edit/{id}','Api\Service\ServiceController@edit');
    Route::post('service-update','Api\Service\ServiceController@update');
    Route::get('all-services','Api\Service\ServiceController@allService');
    // service-details-with-number
    Route::get('service-details/{id}','Api\Service\ServiceController@serviceDetails');
    // nearby-services
    Route::get('nearby-services','Api\Service\ServiceController@nearByService');
    Route::get('my-profile','AuthController@profile');
    Route::post('my-profile/update','AuthController@profileUpdate');
    Route::get('reviews','AuthController@reviews');
    // post/event 
    Route::post('add-post','Api\Post\PostController@add');
    Route::get('list-post','Api\Post\PostController@list');
    Route::get('post-delete/{id}','Api\Post\PostController@delete');
    Route::get('post-edit/{id}','Api\Post\PostController@edit');
    Route::post('update-post','Api\Post\PostController@update');
    Route::get('all-post','Api\Post\PostController@allPost');
    Route::get('all-event','Api\Post\PostController@allEvent');
    Route::get('sponsored-post','Api\Post\PostController@sponsoredPost');
    // notifications
    Route::get('notifications','AuthController@notification');
    // contact-us
    Route::post('contact-us','AuthController@contactUs');

});


Route::post('users', 'UserController@store');
Route::post('login', 'AuthController@login');
Route::post('send-otp','AuthController@sendOtp');
Route::post('verify-otp','AuthController@verifyOtp');
Route::post('new-password','AuthController@newPassword');

//review part
Route::post('review-send', 'ApiReviewRattingController@reviewSend');

// clubs
Route::get('club-list','Api\Club\ClubController@index');