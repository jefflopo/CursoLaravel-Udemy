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
    return view('welcome');
});

Route::get('/contato', 'ContatoController@index');
Route::post('/contato/enviar', 'ContatoController@enviar');

Route::resource('/alunos', 'AlunosController');
Route::post('/alunos/busca', 'AlunosController@busca');
Route::post('/alunos/ordem', 'AlunosController@ordem');

Route::resource('/professores', 'ProfessoresController');
Route::post('/professores/busca', 'ProfessoresController@busca');
Route::post('/professores/ordem', 'ProfessoresController@ordem');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
