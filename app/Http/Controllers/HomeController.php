<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tramite;
use App\Models\Carrera;
use App\Models\User;
use App\Models\Ciclo;
use App\Models\Log;
use App\Models\TramiteSolicitado;
use App\Models\SolicitudCambioCarrera;

use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->role == 'student'){

            $myTramites = TramiteSolicitado::with(['tramite', 'student'])
            ->where('student_id', auth()->user()->id )
            ->where('estatus', '!=', 'Archivado' )
            ->get();
            return view('dashboard')
                ->with('tramitesSolicitados', $myTramites);

        }else if(auth()->user()->role == 'admin' || auth()->user()->role == 'coordinador'){

            $active_students = User::where('estatus','Activo')->where('role', 'student')->count();
            $pending_students = User::where('estatus','Pendiente')->whereRaw('LENGTH(codigo) = 9')->count();
            $changeCareers_requests = SolicitudCambioCarrera::where('estatus','pendiente')->count();

            $pending_tramites = TramiteSolicitado::where('categoria', 'solicitado')->count();
            $finished_tramites = TramiteSolicitado::where('categoria', 'finalizado')->count();
            $tramites_today = TramiteSolicitado::whereDate('created_at', Carbon::today() )->count();

            $records_admins = Log::with('user')->where('type', 'admin')->latest()->get()->take(4);
            $records_students = Log::with('user')->where('type', 'student')->latest()->get()->take(4);
            // dd($records);

            $isThere_notAvailable_tramites = Tramite::select('nombre_tramite')->where('disponible', 0)->get();

            if(count($isThere_notAvailable_tramites)){
                $list_notAvailable = '<ul>';
                foreach($isThere_notAvailable_tramites as $item )
                    $list_notAvailable .= '<li> '. $item->nombre_tramite .'  <small class="text-danger fw-bold">(No disponible)</small> </li>';
                $list_notAvailable .= '</ul>';
                toast()->html('<strong>Los siguientes trámites estan desactivados para los estudiantes: </strong>',$list_notAvailable,'warning');
            }


            return view('dashboard')
                ->with('students_count', $active_students)
                ->with('Tpendientes', $pending_tramites)
                ->with('tramites_today', $tramites_today)
                ->with('finished_tramites', $finished_tramites)
                ->with('pending_students', $pending_students)
                ->with('changeCareers_count', $changeCareers_requests)
                ->with('logs_admins', $records_admins)
                ->with('logs_students', $records_students)
                ;
        }else if(auth()->user()->role == 'none'){
            // $ciclos = Ciclo::get();
            // $careers = Carrera::get();
            return view('dashboard')
            // ->with('carreras', $careers)
            // ->with('ciclos', $ciclos)
            ;
        }

        return view('dashboard');
    }
}
