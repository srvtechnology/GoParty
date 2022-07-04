<?php

Route::group(['namespace' => 'Admin'], function() {

    Route::get('/', 'HomeController@index')->name('admin.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');



     // forget-password
    Route::get('forget-password','Auth\ForgotPasswordController@index')->name('admin.forget.password');
    Route::post('forget-password/email','Auth\ForgotPasswordController@forgetpassword')->name('admin.forget.password.email');
    Route::get('reset-password/{id}/{vcode}','Auth\ForgotPasswordController@resetPassowrd')->name('admin.forget.password.email.verify');
    Route::post('reset-new-password','Auth\ForgotPasswordController@newPassword')->name('admin.reset.new.password');

    
    // contact 
    Route::get('manage-contact','Modules\Contact\ContactController@index')->name('admin.manage.contact');
    Route::get('manage-contact/details/{id}','Modules\Contact\ContactController@view')->name('admin.manage.contact.view');
    Route::get('manage-contact/delete/{id}','Modules\Contact\ContactController@delete')->name('admin.manage.contact.delete');
    // change-password
    Route::get('change-password','HomeController@changeView')->name('admin.change.password');
    Route::get('change-password/check-old-password','HomeController@checkOld')->name('admin.change.password.check');
    Route::post('change-password/confirm-password','HomeController@confrim')->name('admin.change.password.confirm');
    // admin-profile 
    Route::get('profile','HomeController@profile')->name('admin.profile');
    Route::get('profile/check-email','HomeController@checkemail')->name('admin.manage.profile.checkemail');
    Route::post('profile/update','HomeController@profileUpdate')->name('admin.manage.profile.update');


});