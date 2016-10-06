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

use Restaurant\Role;
use Restaurant\Permission;
use Restaurant\User;
Route::get('roles', function () {
    return User::all();
});

Route::get('/api/users2', function() { //dd("22");
    return User::paginate(10);
    $request = request();

    // handle sort option
    if (request()->has('sort')) {
        list($sortCol, $sortDir) = explode('|', request()->sort);
        $query = User::orderBy($sortCol, $sortDir);
    } else {
        $query = User::orderBy('id', 'asc');
    }

    if ($request->exists('filter')) {
        $query->where(function($q) use($request) {
            $value = "%{$request->filter}%";
            $q->where('name', 'like', $value)
                ->orWhere('nickname', 'like', $value)
                ->orWhere('email', 'like', $value);
        });
    }

    $perPage = request()->has('per_page') ? (int) request()->per_page : null;

    // The headers 'Access-Control-Allow-Origin' and 'Access-Control-Allow-Methods'
    // are to allow you to call this from any domain (see CORS for more info).
    // This is for local testing only. You should not do this in production server,
    // unless you know what it means.
    return response()->json(
        $query->paginate($perPage)
    )
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Methods', 'GET');
});

Route::group(array('domain' => 'menus'), function() {
    Route::get('mi/ruta', function() {
        return 'Hola desde myapp.dev!';
    });
});

Route::group(array('domain' => 'otra.menus'), function(){
    Route::get('mi/ruta', function() {
        return 'Hola desde otra.menus!';
    });
});

Route::group(array('domain' => 'tercera.menus'), function(){
    Route::get('mi/ruta', function() {
        return 'Hola desde tercera.menus!';
    });
});


Route::resource('/usuarios', 'UserController');
Route::resource('/preparacion', 'PreparacionController');
Route::resource('/pedidos', 'PedidoController');
Route::resource('/api/users', 'ApiUserController');



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



Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/admin', 'HomeController@index');

});