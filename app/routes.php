<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
require_once 'helpers/validation.php';
require_once 'helpers/general.php';
//Route::get('/', function()
//{
//	return View::make('hello');
//});

Route::get("/","EntradasController@getIndex");
Route::get("/registro","UsuariosController@index");
Route::post("/registrarse","UsuariosController@registro");
Route::controller("/entrada","EntradasController");
Route::controller("/categoria","CategoriasController");


Route::post('login', function(){
        $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );
 
        if(Auth::attempt($userdata)){
            return Redirect::to('/');
        }else{
            return Redirect::to('/');
        }
});

Route::get('logout', function(){
    Auth::logout();
    return Redirect::to('/');
});
