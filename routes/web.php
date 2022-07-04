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

// Route::get('/','Modules\Page\PageController@index')->name('index');

// Auth::routes();
// Route::get('logout', 'Auth\LoginController@logout')->name('logout');
// Route::get('/home', 'HomeController@index')->name('home');
// Route::post('contact-us/form-submit','Modules\Contact\ContactController@submit')->name('contact.us.submit');
// Route::get('/patient','Modules\Page\PageController@patient')->name('patient.page');
// Route::get('/doctor','Modules\Page\PageController@doctor')->name('doctor.page');
// Route::get('/contact','Modules\Page\PageController@contact')->name('contact.page');
// Route::post('/send-suggestions','Modules\Page\PageController@suggestions')->name('send.suggestions');
// Route::post('/send-prescription','Modules\Page\PageController@prescription')->name('send.prescription');

// register 
// Route::post('custome-register','Auth\RegisterController@registerCustom')->name('custom.register');
// Route::post('custome-register/check-mail','Auth\RegisterController@checkMail')->name('custom.register.check.mail');
// Route::post('custome-login','Auth\LoginController@loginCustom')->name('custom.login');

Route::get('/', function () {
    return redirect()->route('admin.login');
});
