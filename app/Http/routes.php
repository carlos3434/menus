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

Route::resource('/usuarios', 'UserController');
Route::resource('/preparacion', 'PreparacionController');
Route::resource('/pedidos', 'PedidoController');
Route::resource('/api/users', 'ApiUserController');


/*
 Route::group(['prefix' => '/api/users'], function () {

    Route::match(['GET', 'POST'], '/', function () {

        if (Request::isMethod('GET')) {
            return User::all();
        } else {
            return User::create(Request::all());
        }

    });

    Route::match(['GET', 'PATCH', 'DELETE'], '/{id}', function ($id) {

        if (Request::isMethod('GET')) { 
            return User::findOrFail($id);
        } elseif (Request::isMethod('PATCH')) {
            User::findOrFail($id)->update(Request::all());
            return Response::json(Request::all()); //response()->json()
        } else {
            return App\User::destroy($id);
        }

    });

 });
*/


Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/admin', 'HomeController@index');

});