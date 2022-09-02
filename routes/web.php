<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TramiteController;
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
                Route::resource('userAccess', AccessUserController::class )->only('index', 'store', 'show', 'destroy');
                Route::get('/grantUser/{id}', [AccessUserController::class, 'grantUser'])->name('userAccess.grantUser');
                // Route::get('/revokeUser/{id}', [AccessUserController::class, 'revokeUser'])->name('userAccess.revokeUser');

                Route::resource('tramites', TramiteController::class )->only('index','store', 'update', 'destroy');

                Route::get('/graficas', [TramiteController::class, 'charts_index'])->name('tramites.charts');
                Route::post('/listados', [TramiteController::class, 'search_tramite'])->name('tramites.listados');
            });

            Route::group([ 'prefix' => 'estudiante' ,'middleware' => ['is_student'] ], function(){
                //Rutas para estudiantes
                // Route::resource('tramites', TramiteController::class );
                    Route::get('tramites/solicitar', [TramiteController::class, 'solicitar_tramite'])->name('tramites.solicitar');
                    Route::post('tramites/generar', [TramiteController::class, 'generar_tramite'])->name('tramites.generar');
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
