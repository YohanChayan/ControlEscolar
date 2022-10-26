<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ciclo;
use App\Models\Carrera;
use App\Models\Log;
use App\Models\SolicitudCambioCarrera;

use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function users_find()
    {
        return view('admin.users.find');
    }


    // AJAX
    public function users_found(Request $request)
    {
        $value = $request->input('user_value');

        $usersFound = user::having('role', '!=', 'coordinador')
            ->where('codigo', 'LIKE', '%'. $value .'%')
            ->orWhere('name' , 'LIKE', '%' . $value . '%' )
            ->orWhere('email' , 'LIKE', '%' . $value . '%' )
            ->get();

        $html_table = view('admin.users.ajax.index_usersFound')->with('users', $usersFound)->render();
        return ['data' => $html_table];
    }

    // AJAX --student fix errors : provide carreras with ajax
    public function filter_careers(Request $request)
    {
        $request->validate([
           'carreraValue' => 'required',
        ]);

        $value = $request->input('carreraValue');

        $result = Carrera::select('id', DB::raw("CONCAT(clave, ' - ', nombre) AS nombre") )
                ->where('nombre', 'lIKE', '%' . $value . '%')
                ->orWhere('clave', 'lIKE', '%' . $value . '%')
                ->get();


        $htmlList = '';
        foreach($result as $item){
            $htmlList .= '<option value="' . $item->nombre . '" >';
        }

        return $htmlList;
    }

    // AJAX --student fix errors : provide ciclos with ajax
    public function filter_ciclos(Request $request)
    {
        $request->validate([
           'cicloValue' => 'required',
        ]);

        $value = $request->input('cicloValue');
        $result = Ciclo::select('semestre')
            ->where('semestre', 'lIKE', '%' . $value . '%')->get();

        $htmlList = '';
        foreach($result as $item){
            $htmlList .= '<option value="' . $item->semestre . '" >';
        }
        return $htmlList;
    }

    // student
    public function fix_data_errors(Request $request)
    {
        $arr_toFix = explode('|', auth()->user()->hasToFix);
        array_pop($arr_toFix);

        $array_validate = [];
        foreach($arr_toFix as $errorField){
            $array_validate[$errorField] = 'required';
        }
        $request->validate( $array_validate );

        $user = User::find( auth()->user()->id );

        foreach($arr_toFix as $errorField){
            $valueToFix = $request->input($errorField);

            if($errorField === 'email')
                $user->email = $valueToFix;
            elseif($errorField === 'name')
                $user->name = $valueToFix;
            elseif($errorField === 'apellidos')
                $user->apellidos = $valueToFix;
            elseif($errorField === 'codigo')
                $user->codigo = $valueToFix;
            elseif($errorField === 'ciclo_admision')
                $user->ciclo_admision = $valueToFix;
            elseif($errorField === 'nombre_carrera'){
                $career = explode(' - ', $valueToFix); // ANT - Licenciatura en Antropología
                $user->clave_carrera = $career[0];
                $user->nombre_carrera = $career[1];
            }
        }
        $user->hasToFix = '';
        $user->answer_dataIsWrong = -1; //student answer
        $user->save();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha corregido errores de registro';
        $log->type = 'student';
        $log->target = '';
        $log->save();

        return redirect()->back();
    }

    // -student
    public function solicitud_cambio_carrera()
    {
        $careers = Carrera::select('id', DB::raw("CONCAT(clave, ' - ', nombre) AS nombre") )->get();
        $currentCareer = auth()->user()->clave_carrera . ' - ' . auth()->user()->nombre_carrera;

        $currentSolicitud = SolicitudCambioCarrera::where('answer' ,'!=' ,  3)
        ->where('student_id', auth()->user()->id)->first();

        if(isset($currentSolicitud)){
            if($currentSolicitud->answer == 2){
                // student seen the estatus
                $currentSolicitud->answer = 3;
                $currentSolicitud->save();
            }
        }

        return view('student.cambio_carrera.solicitud')
            ->with('currentCareer', $currentCareer)
            ->with('carreras', $careers)
            ->with('currentSolicitud', $currentSolicitud)
        ;
    }

    // POST -student
    public function cambio_carrera(Request $request)
    {
        $request->validate([
           'new_career' => 'required',
        ]);

        $alreadyExistSolicitud = SolicitudCambioCarrera::
            where('estatus', 'pendiente')
            ->where('student_id', auth()->user()->id)->get();

        // dd();
        if(count($alreadyExistSolicitud) > 0){
            alert::warning('Usted ya ha tramitado una solicitud y esta en proceso!');
            return redirect('/');
        }

        $new_career = $request->input('new_career');
        $clave_career = explode(' - ', $new_career)[0];
        $nombre_career = explode(' - ', $new_career)[1];

        $solicitud = new SolicitudCambioCarrera();
        $solicitud->student_id = auth()->user()->id;
        $solicitud->new_clave_carrera = $clave_career;
        $solicitud->new_nombre_carrera = $nombre_career;
        $solicitud->answer = 1;
        $solicitud->save();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha solicitado cambio de carrera';
        $log->type = 'student';
        $log->target = '';
        $log->save();

        Alert::success('Su solicitud ha sido enviada!');

        return redirect('/');
    }

    // Index solicitudes
    public function index_cambioCarreras()
    {
        $solicitudes = SolicitudCambioCarrera::with('student')->where('estatus', 'pendiente')->get();
        $html_table = view('admin.carreras.solicitudes_cambioCarrera.ajax.index_cambioCarrerasTable')->with('solicitudes', $solicitudes);

        return view('admin.carreras.solicitudes_cambioCarrera.index')
            ->with('data' , $html_table)
        ;
    }


    public function permitir_cambioCarrera(Request $request)
    {
        $request->validate([
            'solicitudCambio_id' => 'required',
        ]);

        $id = $request->input('solicitudCambio_id');

        $solicitud = SolicitudCambioCarrera::with('student')->where('estatus', 'pendiente')->where('id', $id)->first();

        if(!isset($solicitud) ){
            Alert::warning('Tramite no encontrado!');
            redirect()->back();
        }
        $targetUser = User::find( $solicitud->student->id );

        if( !isset($targetUser) ){
            Alert::warning('Estudiante no encontrado!');
            redirect()->back();
        }

        $targetUser->clave_carrera = $solicitud->new_clave_carrera;
        $targetUser->nombre_carrera = $solicitud->new_nombre_carrera;
        $targetUser->save();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha autorizado cambio de carrera al estudiante con codigo: ';
        $log->type = 'admin';
        $log->target = $targetUser->codigo;
        $log->save();

        $solicitud->estatus = 'aprobado';
        $solicitud->answer = 2;
        $solicitud->save();

        Alert::success('Éxito','La carrera del estudiante con codigo: ' . $targetUser->codigo . ' ha sido cambiada correctamente!');

        return redirect()->back();
    }

    public function rechazar_cambioCarrera(Request $request)
    {
        $request->validate([
            'solicitudCambio_id' => 'required',
        ]);

        $id = $request->input('solicitudCambio_id');

        $solicitud = SolicitudCambioCarrera::with('student')->where('estatus', 'pendiente')->where('id', $id)->first();

        if(!isset($solicitud) ){
            Alert::warning('Tramite no encontrado!');
            redirect()->back();
        }
        $targetUser = User::find( $solicitud->student->id );

        if( !isset($targetUser) ){
            Alert::warning('Estudiante no encontrado!');
            redirect()->back();
        }

        $solicitud->estatus = 'rechazado';
        $solicitud->answer = 2;
        $solicitud->save();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha rechazado cambio de carrera al estudiante con codigo: ';
        $log->type = 'admin';
        $log->target = $targetUser->codigo;
        $log->save();

        Alert::success('Éxito','La solicitud de cambio de carrera ha sido rechada y notificada al estudiante!');

        return redirect()->back();

    }

}
