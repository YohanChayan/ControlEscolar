<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\AccessUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ChartController;

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

Route::group(['middleware' => ['auth']], function(){

    //only verified account can access with this group
    Route::group(['middleware' => ['verified']], function() {

        Route::get('/', [HomeController::class, 'index'])->name('home');


            Route::group([ 'prefix' => 'administrativo' , 'middleware' => ['is_admin'] ], function(){
                //Rutas para administrativos
                Route::resource('userAccess', AccessUserController::class )->only('index' , 'destroy');

                Route::post('/grantAdmin/', [AccessUserController::class, 'grantAdmin'])->name('userAccess.grantAdmin');

                Route::post('/grantStudent/', [AccessUserController::class, 'grantStudent'])->name('userAccess.grantStudent');

                Route::post('/revokeAdmin/', [AccessUserController::class, 'revokeAdmin'])->name('userAccess.revokeAdmin');

                // Route::post('/revokeStudent/', [AccessUserController::class, 'revokeStudent'])->name('userAccess.revokeStudent');

                Route::post('/notifyStudent/', [AccessUserController::class, 'notify_Student'])->name('userAccess.notifyStudent');

                Route::get('/indexStudents', [AccessUserController::class, 'index_students'])->name('userAccess.indexStudents');

                Route::resource('tramites', TramiteController::class )->only('index','store', 'update', 'destroy');

                Route::post('/filterFinalizados', [TramiteController::class, 'filter_finalizados'])->name('tramites.filter_finalizados');

                Route::post('/filterRechazados', [TramiteController::class, 'filter_rechazados'])->name('tramites.filter_rechazados');

                Route::get('/graficas', [ChartController::class, 'charts_index'])->name('graficas.index');
                Route::post('/seguimiento', [TramiteController::class, 'found_tramite'])->name('tramites.seguimiento');

                Route::get('/pendientes', [TramiteController::class, 'tramites_pendientes'])->name('tramites.pendientes');

                Route::get('/finalizados', [TramiteController::class, 'tramites_finalizados'])->name('tramites.finalizados');

                Route::post('/seguimientoEstatus', [TramiteController::class, 'seguimiento_tramite'])->name('tramites.seguimientoEstatus');

                Route::get('/archivarTramite/{id}', [TramiteController::class, 'archivar_tramite'])->name('tramites.archivar');

                Route::post('/dearchivarTramite', [TramiteController::class, 'dearchivar_tramite'])->name('tramites.desarchivar');

                Route::get('/archivados', [TramiteController::class, 'archivados'])->name('tramites.archivados');

                Route::get('/rechazados', [TramiteController::class, 'rechazados'])->name('tramites.rechazados');

                Route::post('/matriculasPendientes', [TramiteController::class, 'calcular_matriculas'])->name('tramites.matriculasPendientes');

                Route::post('tramites/NoAdeudo', [TramiteController::class, 'Doc_NoAdeudo'])->name('tramites.DocNoAdeudo');

                Route::resource('carreras', CarreraController::class );

                Route::resource('ciclos', CicloController::class )->only('index' , 'store', 'destroy', 'update');

                Route::get('/usersFind', [UserController::class, 'users_find'])->name('users.usersFind');

                Route::post('/usersFound', [UserController::class, 'users_found'])->name('users.usersFound');

                Route::get('/index_cambioCarreras', [UserController::class, 'index_cambioCarreras'])->name('users.index_cambioCarreras');

                Route::post('/permitir_cambioCarrera', [UserController::class, 'permitir_cambioCarrera'])->name('users.permitir_cambioCarrera');

                Route::post('/rechazar_cambioCarrera', [UserController::class, 'rechazar_cambioCarrera'])->name('users.rechazar_cambioCarrera');

                Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
                Route::get('/logs_Students', [LogController::class, 'indexStudents'])->name('logs.index_students');


                Route::post('/getChart', [ChartController::class, 'getChart'])->name('graficas.get');

            });

            Route::group([ 'prefix' => 'estudiante' ,'middleware' => ['is_student'] ], function(){
                //Rutas para estudiantes
                    Route::get('tramites/solicitar', [TramiteController::class, 'solicitar_tramite'])->name('tramites.solicitar');
                    Route::post('tramites/generar', [TramiteController::class, 'generar_tramite'])->name('tramites.generar');

                    Route::post('tramites/check_tramites_numbers', [TramiteController::class, 'check_tramites_numbers'])->name('tramites.checkTrNumbers');

                    Route::post('tramites/upload', [TramiteController::class, 'upload_documents'])->name('tramites.upload_documents');

                    Route::get('/solicitud_cambioCarrera', [UserController::class, 'solicitud_cambio_carrera'])->name('users.solicitud_cambioCarrera');

                    Route::post('/cambioCarrera', [UserController::class, 'cambio_carrera'])->name('users.cambioCarrera');

                    Route::post('tramites/formato', [TramiteController::class, 'formato'])->name('tramites.formato');
            });

                // Errores de registro
                Route::post('/filter_careers', [UserController::class, 'filter_careers'])->name('users.filter_careers');
                Route::post('/filter_ciclos', [UserController::class, 'filter_ciclos'])->name('users.filter_ciclos');
                Route::post('/fixStudentData', [UserController::class, 'fix_data_errors'])->name('users.fixStudentData');

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
