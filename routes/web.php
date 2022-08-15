<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Student\TramiteController;
use App\Http\Controllers\Admin\AccessUserController;

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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function() {

    //only verified account can access with this group
    Route::group(['middleware' => ['verified']], function() {

        Route::get('/', [HomeController::class, 'index'])->name('home');


            Route::group([ 'prefix' => 'administrativo' , 'middleware' => ['is_admin'] ], function(){
                //Rutas para administrativos
                Route::resource('userAccess', AccessUserController::class );

            });

            Route::group([ 'prefix' => 'estudiante' ,'middleware' => ['is_student'] ], function(){
                //Rutas para estudiantes

                Route::resource('tramites', TramiteController::class );

            });

    });
});

// Auth::routes();

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
// });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
