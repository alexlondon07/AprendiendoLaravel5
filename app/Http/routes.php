<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');
Route::get('/', 'HomeController@index');
Route::get('home', 'WelcomeController@index');
Route::get('login', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*
 * Rutas para las vistas de administracion de nuestra aplicacion
 */
 Route::group(array('prefix' => 'admin', 'middleware' => 'auth'), function() {
        Route::resource('user', 'UserController');
        Route::get('users/search', 'UserController@search');
        Route::resource('main', 'HomeController@main');
 });


Route::get('attachment/get/{action}/{id}/{key}', [
    'uses' => 'AttachmentController@getAttachment'
]);
//Route::get('attachment/get/{action}/{id}/{key}', array('uses' => 'AttachmentController@getAttachment'));



/*
 * Ruta para identificar el host donde se esta ejecutando al aplicacion
 */
Route::get('host', function() {
    echo gethostname();
    $app = new Illuminate\Foundation\Application;
    $env = $app->detectEnvironment(array(
        'local' => array('localhost', 'MacBook-Pro-de-Alexander.local', 'localhost', 'ALEX-PC'),
        'production' => array('pendiente'),
        ));
    echo " ___ " . $env;
});

Route::resource('news', 'NewsController');

Route::get('news/{id}/delete', [
    'as' => 'news.delete',
    'uses' => 'NewsController@destroy',
]);
