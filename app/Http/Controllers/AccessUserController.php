<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AccessUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // Index Admins
    public function index()
    {
        // $this->authorize('admin');
        $data = $this->refresh_adminTable();

        // Carga de datos DT en mini-vista
        $html_table = view('admin.accesos.ajax.index_accesosAdminTable')->with('admins', $data)->render();

        // retorna vista con datos ya procesados
        return view('admin.accesos.indexAdmins')->with('data', $html_table);
    }

    public function index_students()
    {
        // $this->authorize('admin');

        $data = User::whereRaw('LENGTH(codigo) = 9')
        ->whereNotNull('email_verified_at')
        ->where('estatus','Pendiente')
        ->where('answer_dataIsWrong', '<' , '1')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        // Paginador: Evitar la carga masiva en tabla --solo carga 10 a la vez

        $html_table = view('admin.accesos.ajax.index_accesosStudentTable')->with('students', $data);

        // Retorna vista con datos ya procesados
        return view('admin.accesos.indexStudents')->with('data', $html_table);
    }


    // refresh admins table
    public function refresh_adminTable()
    {
        $users = User::whereRaw('LENGTH(codigo) = 7')
        ->where('id', '!=', auth()->user()->id)
        ->whereNotNull('email_verified_at')
        ->where('estatus','Pendiente')
        ->orderBy('created_at', 'desc')
        ->get();
        return $users;
    }

    // refresh students table
    public function refresh_studentTable()
    {
        $users = User::whereRaw('LENGTH(codigo) = 9')
        ->whereNotNull('email_verified_at')
        ->where('estatus','Pendiente')
        ->orderBy('created_at', 'desc')
        ->get();
        return $users;
    }

    public function grantAdmin(Request $request)
    {
        // $this->authorize('admin');
        $validated = $request->validate([
            'user_id' => 'required',
        ]);
        $user = User::find($request->input('user_id'));

        if($user){
            $user->estatus = 'Activo';
            $user->role = 'admin';
            $user->update();

            $log = new Log();
            $log->user_id = auth()->user()->id;
            $log->action = 'Ha dado acceso a nuevo administrativo con código: ';
            $log->type = 'admin';
            $log->target = $user->codigo;
            $log->save();

            $data = $this->refresh_adminTable();
            $html_table = view('admin.accesos.ajax.index_accesosAdminTable')->with('admins', $data)->render();

            return [
                'say' => 'yes',
                'data' => $html_table
            ];
        }else
            return ['say' => 'No'];

    }

    public function grantStudent(Request $request)
    {
        // $this->authorize('admin');
        $validated = $request->validate([
            'user_id' => 'required',
        ]);
        $user = User::find($request->input('user_id'));
        if(!isset($user)){
            Alert::warning('Usuario no encontrado!');
            return redirect()->back();
        }
        $user->estatus = 'Activo';
        $user->role = 'student';
        $user->answer_dataIsWrong = 0;
        $user->hasToFix = '';
        $user->update();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha dado acceso a nuevo estudiante con código: ';
        $log->type = 'admin';
        $log->target = $user->codigo;
        $log->save();

        Alert::success('Permiso otorgado correctamente!');
        return redirect()->back();
    }

    public function revokeAdmin(Request $request)
    {
        $id = $request->input('user_id');
        $user = User::where('role', 'admin')->where('id', $id)->first();
        if(!isset($user))
            return response()->json(['say' => 'No']);

        $user->estatus = 'Inactivo';
        $user->role = 'none';
        $user->save();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha revocado el acceso a administrativo con código: ';
        $log->type = 'admin';
        $log->target = $user->codigo;
        $log->save();

        return response()->json([ 'say' => 'Yes']);
    }

    // No usado.
    public function revokeStudent(Request $request)
    {
//         $user = User::find($request->input('user_id'));
//         $user->estatus = 'Inactivo';
//         $user->role = 'none';
//         $user->save();
//         $data = $this->refresh_studentTable();
//         $html_table = view('admin.accesos.ajax.index_accesosStudentTable')->with('students', $data)->render();
//
//         return response()->json([
//            'data' => $html_table,
//            'say' => 'yes'
//         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function destroy($id)
    {
        $user = User::find($id);

        if($user){
            if(strlen( $user->codigo ) <= 7){ //can remove admin

                $log = new Log();
                $log->user_id = auth()->user()->id;
                $log->action = 'Ha eliminado la solicitud de acceso a administrativo con codigo: ';
                $log->type = 'admin';
                $log->target = $user->codigo;
                $log->save();

                $user->delete();

                $data = $this->refresh_adminTable();
                $html_table = view('admin.accesos.ajax.index_accesosAdminTable')->with('admins', $data)->render();

                return [
                    'say' => 'yes',
                    'data' => $html_table
                ];
            }else
                return [ 'say' => 'No'];
        }
        else
            return [ 'say' => 'No'];

    }

    public function notify_Student(Request $request)
    {
        $request->validate([
           'st_identifier' => 'required',
        ]);


        $st_id = $request->input('st_identifier');

        $student = User::find($st_id);
        if(!isset($student)){
            Alert::warning('Estudiante no encontrado!');
            return redirect()->back();
        }

        $array_dataWrong = array();

        array_push($array_dataWrong, $request->input('student_name_isWrong') );
        array_push($array_dataWrong, $request->input('student_apellidos_isWrong') );
        array_push($array_dataWrong, $request->input('student_email_isWrong') );
        array_push($array_dataWrong, $request->input('student_cicloAdmision_isWrong') );
        array_push($array_dataWrong, $request->input('student_codigo_isWrong') );
        array_push($array_dataWrong, $request->input('student_claveCarrera_isWrong') );
        array_push($array_dataWrong, $request->input('student_carrera_isWrong') );

        $student->hasToFix = '';
        foreach($array_dataWrong as $item){
            if(!is_null($item))
                $student->hasToFix .= $item . '|';
        }

        $student->answer_dataIsWrong = 1; //admin respond
        $student->save();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha notificado errores de registro al estudiante con codigo: ';
        $log->type = 'admin';
        $log->target = $student->codigo;
        $log->save();

        Alert::success('Usuario notificado Exitosamente!');
        return redirect()->back();
    }
}
