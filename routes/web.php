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

//  Route::get('roles', function () {
//  dd(App\Categoria::with('articulos')->get());
// dd(App\Mbrp_questionnaire::find(4)->mbrp_programme);
//dd(App\Mbrp_programme::find(1));
//        DB::listen(function($query){
//        echo "<pre>{$query->sql} </pre>";
//        }); 
        //dd(App\Mbrp_programme::with('mbrp_questionaries:name')->get());
//        dd(App\Mbrp_questionnaire::with('Mbrp_programme')->get());
 //dd(App\Mbrp_programme::find(2)->mbrp_questionnaires);
//}); 

//  DB::listen(function($query){
// echo "<pre>{$query->sql} </pre>";
// }); 

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['ClientRole']], function () {
  
    });

    Route::group(['middleware' => ['Worker']], function () {
        Route::get('/client', 'ClientController@index');
        Route::post('/client/register', 'ClientController@store');
        Route::put('/client/update', 'ClientController@update');
        Route::get('/client/selectClient', 'ClientController@selectClient');
        
        Route::get('/hwbTracker', 'HwbTrackerController@index');
        Route::post('/hwbTracker/register', 'HwbTrackerController@store');
        Route::put('/hwbTracker/update', 'HwbTrackerController@update');
        Route::delete('/hwbTracker/{id}', 'HwbTrackerController@destroy');
        // Route::put('/mbrp_questionnaire/delete', 'HwbTrackerController@delete');
        Route::get('/mbrp_parameter/selectParameter', 'Mbrp_parameterController@selectParameter');

        Route::get('/mbrp_programme/selectProgrammes', 'Mbrp_programmeController@selectProgrammes');
   
        Route::get('/mbrp_questionnaire', 'Mbrp_questionnaireController@index');
        Route::post('/mbrp_questionnaire/register', 'Mbrp_questionnaireController@store');
        Route::put('/mbrp_questionnaire/update', 'Mbrp_questionnaireController@update');
        Route::put('/mbrp_questionnaire/registerbrs', 'Mbrp_questionnaireController@registerBrs');
        Route::put('/mbrp_questionnaire/updatebrs', 'Mbrp_questionnaireController@updateBrs');
        Route::put('/mbrp_questionnaire/updateurica', 'Mbrp_questionnaireController@updateUrica');
        Route::delete('/mbrp_questionnaire/{id}', 'Mbrp_questionnaireController@destroy');
      
    });

    Route::group(['middleware' => ['Administrador']], function () {

        Route::get('/client', 'ClientController@index');
        Route::post('/client/register', 'ClientController@store');
        Route::put('/client/update', 'ClientController@update');
        Route::get('/client/selectClient', 'ClientController@selectClient');
        
        Route::get('/hwbTracker', 'HwbTrackerController@index');
        Route::post('/hwbTracker/register', 'HwbTrackerController@store');
        Route::put('/hwbTracker/update', 'HwbTrackerController@update');
        Route::delete('/hwbTracker/{id}', 'HwbTrackerController@destroy');
        // Route::put('/mbrp_questionnaire/delete', 'HwbTrackerController@delete');

        Route::get('/mbrp_parameter', 'Mbrp_parameterController@index');
        Route::post('/mbrp_parameter/register', 'Mbrp_parameterController@store');
        Route::put('/mbrp_parameter/update', 'Mbrp_parameterController@update');
        Route::put('/mbrp_parameter/desactivar', 'Mbrp_parameterController@desactivar');
        Route::put('/mbrp_parameter/activar', 'Mbrp_parameterController@activar');
        Route::get('/mbrp_parameter/selectParameter', 'Mbrp_parameterController@selectParameter');

        Route::get('/mbrp_programme/selectProgrammes', 'Mbrp_programmeController@selectProgrammes');
   
        Route::get('/mbrp_questionnaire', 'Mbrp_questionnaireController@index');
        Route::post('/mbrp_questionnaire/register', 'Mbrp_questionnaireController@store');
        Route::put('/mbrp_questionnaire/update', 'Mbrp_questionnaireController@update');
        Route::put('/mbrp_questionnaire/registerbrs', 'Mbrp_questionnaireController@registerBrs');
        Route::put('/mbrp_questionnaire/updatebrs', 'Mbrp_questionnaireController@updateBrs');
        Route::put('/mbrp_questionnaire/updateurica', 'Mbrp_questionnaireController@updateUrica');
        Route::delete('/mbrp_questionnaire/{id}', 'Mbrp_questionnaireController@destroy');
       
        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
    });

});

//Route::get('/home', 'HomeController@index')->name('home');
