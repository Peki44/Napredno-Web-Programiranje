<?php

use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/projects','App\Http\Controllers\ProjectController@index');
Route::post('/project','App\Http\Controllers\ProjectController@store');
Route::delete('/project/{project}','App\Http\Controllers\ProjectController@destroy');

Route::get('/project/edit/{project}', 'App\Http\Controllers\ProjectController@edit');
Route::get('/project/editMember/{project}', 'App\Http\Controllers\ProjectController@editMember');
Route::patch('/project/{project}', 'App\Http\Controllers\ProjectController@update');


Route::auth();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
