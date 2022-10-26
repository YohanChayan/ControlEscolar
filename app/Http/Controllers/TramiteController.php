<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tramite;
use App\Models\TramiteSolicitado;
use App\Models\Ciclo;
use App\Models\Log;
use PDF;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use Carbon\Carbon;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Notifications\TramiteProcesado;


class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // SEND EMAILS //
         public function sendEmail_newEstatus()
         {

         }

         public function sendEmail_registerErrors()
         {

         }
     // END SEND EMAILS //


     public function upload_documents(Request $request)
     {
        // $this->authorize('student');
        $validatedData = $request->validate([
         'folioUnico' => 'required',
         'documents' => 'required',
         'documents.*' => 'mimes:pdf',
        ]);
        $id = $request->input('folioUnico');
        $tramite = TramiteSolicitado::find($id);

        $pathKeyFolder = auth()->user()->codigo;
        $filesNames = '';

        if($request->hasfile('documents'))
         {
            foreach($request->file('documents') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move( public_path() . '/files/tramites/' . $pathKeyFolder . '/' , $name);
                $filesNames .= $name . '|';
            }
            $filesNames = mb_substr($filesNames, 0, -1);
            $tramite->files = $filesNames;
            $tramite->save();

            $log = new Log();
            $log->user_id = auth()->user()->id;
            $log->action = 'Subió archivos al tramite folio: ';
            $log->type = 'student';
            $log->target = $tramite->id;
            $log->save();

         }

        return response()->json([
           'say' => 'yes',
           'message' => 'Documentos subidos correctamente!',
        ]);
     }

     // POST
    public function formato(Request $request)
    {
        $request->validate([
           'tr_id' => 'required',
        ]);

        $id = $request->input('tr_id');

        $tramite = TramiteSolicitado::with('tramite')->find($id);

        // dd($tramite);
        if(!isset($tramite)){
            alert::warning('Algo no salió bien, folio no encontrado');
            return redirect()->back();
        }

        $user = $tramite->student;


        $data = [
            'tr_nombre_tramite' => $tramite->tramite->nombre_tramite,
            'tr_monto' => $tramite->tramite->monto,

            // No adeudo
            'tr_total_a_pagar' => $tramite->total_a_pagar,
            'tr_matriculas_pendientes' => $tramite->matriculas_pendientes,
            'tr_ultima_matricula_pagada' => $tramite->ultima_matricula_pagada,
            'ci_currentCiclo' => Ciclo::where('selected' , true)->first()['semestre'],
            //

            'tr_referencia' => $tramite->tramite->referencia,
            'tr_requerimientos' => explode('|', $tramite->tramite->requerimientos),
            'tr_folio' => $tramite->id,
            'usr_nombres' => $user->name,
            'usr_apellidos' => $user->apellidos,
            'usr_email' => $user->email,
            'usr_codigo' => $user->codigo,
            'usr_clave_carrera' => $user->clave_carrera,
            'usr_ciclo_admision' => $user->ciclo_admision,
            'usr_telefono' => $user->telefono,
            'usr_created_at' => $user->created_at->format('d / m / Y'),
        ];

        $viewFormato = 'formatos.' . $tramite->tramite->formato;

        return view($viewFormato)->with('data' ,$data);
    }

     // CRUD tramites (admin)
    public function index()
    {
        $data = $this->refreshTable();
        $html_table = view('admin.tramites.ajax.index_tramiteTable')->with('tramites', $data);
        return view('admin.tramites.index')->with('data', $html_table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     // CRUD tramites (admin) ?? ''
    public function create()
    {
        dd('nothing here, go to index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     // CRUD tramites (admin)
    public function store(Request $request)
    {
        // $this->authorize('admin');
        $validated = $request->validate([
            'nombre_tramite' => 'required',
            'monto' => 'required',
            // 'requerimientos' => 'required',
        ]);

        $tramite = new Tramite();
        $tramite->nombre_tramite = $request->input('nombre_tramite');
        $tramite->monto = $request->input('monto');
        $reqs = $request->input('requerimientos');
        $tramite->requerimientos = mb_substr($reqs,0,-1); //delete last |

        $modalidad = Tramite::getModality($tramite->requerimientos);
        $tramite->modalidad = $modalidad;
        $tramite->aviso = $request->input('aviso');
        $tramite->disponible = ($request->input('disponible') == 'true') ? true : false;
        $tramite->save();

        $data = $this->refreshTable();
        $html_table = view('admin.tramites.ajax.index_tramiteTable')->with('tramites', $data)->render();

        return [
            'data' => $html_table,
            // 'record' => $tramite,
            'message' => 'Trámite agredado exitosamente!',
            'type' => 'store',
            'say' => 'yes'
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function show(Tramite $tramite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function edit(Tramite $tramite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $this->authorize('admin');
        $id = $request->input('id');
        $tramite = Tramite::find($id);

        if(!$tramite)
            response()->json( ['say'=> 'No'] );

        $tramite->nombre_tramite = $request->input('nombre_tramite');
        $tramite->monto = $request->input('monto');
        $reqs = $request->input('requerimientos');
        $tramite->requerimientos = mb_substr($reqs,0,-1); //delete last |
        $tramite->aviso = $request->input('aviso');
        $tramite->disponible = ($request->input('disponible') == 'true' ? true : false);


        $modalidad = Tramite::getModality($tramite->requerimientos);
        $tramite->modalidad = $modalidad;

        $tramite->update();
        $data = $this->refreshTable();
        $html_table = view('admin.tramites.ajax.index_tramiteTable')->with('tramites', $data)->render();

        return [
            'data' => $html_table,
            'record' => $tramite,
            'message' => 'Trámite actualizado exitosamente!',
            'type' => 'update',
            'say' => 'yes'
        ];

    }

    public function refreshTable()
    {
        $data = Tramite::get();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $tramite = Tramite::find($id);
        if($tramite){
            $tramite->delete();
            return 1;
        }
        return 0;
    }

    // view solicitar tramite (student)
    public function solicitar_tramite()
    {
        // $this->authorize('student');

        $tramites_infoReqs = Tramite::get();
        $disponibles = Tramite::where('disponible', true)->get();
        $noDisponibles = Tramite::where('disponible', false)->get();

        alert::warning('Nota', 'Asegúrese de que la informacion a continuación es correcta antes de solicitar un tramite!');

        return view('student.tramites.create')
            ->with('tramites_infoReqs', $tramites_infoReqs)
            ->with('noDisponibles', $noDisponibles)
            ->with('disponibles', $disponibles)
        ;
    }


    // generar tramite (student)
    public function generar_tramite(Request $request)
    {
        // $this->authorize('student');
        $validated = $request->validate([
            'email' => 'required',
            'codigo' => 'required',
            'name' => 'required',
            'apellidos' => 'required',
            // 'nombre_tramite' => 'required|min:3',
            'tramite' => 'required|not_regex:(-)',
        ]);

        $nombre_tramite = $request->input('tramite');

        // Nota: solo se puede solicitar una constancia de no aduedo a la vez.

        if($nombre_tramite === 'Constancia de no adeudo'){
            $alreadyHas = TramiteSolicitado::with('tramite')->
                    whereHas('tramite' , function($query) use ($nombre_tramite){
                        $query->where('nombre_tramite', $nombre_tramite);
                    })
                    ->where('student_id', auth()->user()->id )
                    ->where('categoria', 'solicitado')
                    ->get();

            if(count($alreadyHas) > 0 ){
                alert::error('Usted ya posee un trámite solicitado');
                return redirect('/');
            }
        }

        // Para los demas tramites se tiene un limite de 2 despues de eso, se le envia una aleta al estudiante solamente.

        $new_procedure = new TramiteSolicitado();

        $new_procedure->student_id = auth()->user()->id;
        $tramite_type = Tramite::where('nombre_tramite', $request->input('tramite'))->first();
        $new_procedure->tramite_id = $tramite_type->toArray()['id'];

        $lastFolio = TramiteSolicitado::select('folio')->where('tramite_id', $new_procedure->tramite_id )->orderBy('folio', 'desc')->first();

        if( is_null($lastFolio) || is_null($lastFolio->folio) ){
            $lastFolio = 1;
        }else
            $lastFolio = $lastFolio->folio + 1;
        $new_procedure->folio = $lastFolio;

        $new_procedure->estatus = 'Iniciado';
        $new_procedure->save();


        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha solicitado un trámite con folio: ';
        $log->type = 'student';
        $log->target = $new_procedure->id;
        $log->save();

        // $request->user()->notify(new TramiteProcesado($new_procedure));

        $message = '';
        // dd($tramite_type);
        if($tramite_type->aviso != 'Sin aviso')
            $message = $tramite_type->aviso;

        Alert::success('Trámite ha sido iniciado!', $message);
        return redirect()->route('home');
        // ->with('estatus', 'El trámite ha sido iniciado!');
    }

    public function found_tramite(Request $request)
    {
        $id = $request->input('tramite_id');
        $tramite = TramiteSolicitado::with(['tramite','student'])->where('id', $id)->first();

        if(is_null($tramite)){
            Alert::warning('El trámite no ha sido encontrado!', '');
            return redirect()->route('home');
        }

        $arrFiles = explode('|', $tramite->files);
        $assets = null;

        // assets for documents
        if(isset($tramite->files)){
            $assets = array();
            foreach($arrFiles as $file){
                $path = 'files/tramites/' . $tramite->student->codigo .'/'. $file;
                array_push($assets, asset($path));
            }
        }

        $ciclos = null;

        if($tramite->tramite->formato == 'formato_constanciaNoAdeudo')
            $ciclos = Ciclo::get();

        $messageEstatus = 'A este trámite no se le ha dado seguimiento!';
        $iconEstatus = 'warning';
        if($tramite->created_at < $tramite->updated_at){
            $messageEstatus = 'Ultimo estatus dado: ' . $tramite->updated_at->diffForHumans();
            $iconEstatus = 'info';
        }
        $reqsLists = explode('|',$tramite->tramite->requerimientos); //lista de requerimientos
        Alert::toast($messageEstatus, $iconEstatus);

        return view('admin.busqueda.seguimiento_tramite')
            ->with('tramite', $tramite)
            ->with('reqsList', $reqsLists)
            ->with('assetsDocuments', $assets)
            ->with('ciclos', $ciclos);
        ;
    }

    // Seguimiento POST
    public function seguimiento_tramite(Request $request)
    {
        $id = $request->input('folioUnico');
        $tramite = TramiteSolicitado::find($id); //filtrar no archivados, try not null
        $newEstatus = $request->input('estatus_tramite');
        $tramite->estatus = $newEstatus;
        $tramite->motivo = $request->input('motivo');

        $tramite->requerimientos_asignados = $request->input('selected_reqs');

        // dd($request);

        if($newEstatus == 'Recibido')
            $tramite->categoria = 'finalizado';
        else if($newEstatus == 'Recepción de trámite rechazado en CE')
            $tramite->categoria = 'rechazado';
        else
            $tramite->categoria = 'solicitado';


        if($tramite->tramite->formato == 'formato_constanciaNoAdeudo' && !is_null($request->input('total_a_pagar')) ){
            $tramite->total_a_pagar = $request->input('total_a_pagar');
            $tramite->matriculas_pendientes = $request->input('matriculas_pendientes');
            $tramite->ultima_matricula_pagada = $request->input('ultimo_pago');
        }
        $tramite->update();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha dado seguimiento al trámite con folio: ';
        $log->type = 'admin';
        $log->target = $tramite->id;
        $log->save();

        Alert::success('El trámite ha sido actualizado!', '');
        return redirect()->route('home');
    }

    public function tramites_pendientes()
    {
        $pendientes = TramiteSolicitado::with([
            'tramite',
            'student'
        ])
        ->where('estatus', '!=', 'Recibido')
        ->where('categoria', 'solicitado')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        // ->get();

        $html_table = view('admin.tramites.ajax.index_pendientesTable')->with('pendientes', $pendientes);

        return view('admin.tramites.pendientes')->with('data', $html_table);
    }

    public function archivar_tramite($id)
    {
        // $id = $request->input('archivar_tramite_id');
        $solicitado = TramiteSolicitado::find($id);

            if( !isset($solicitado) ){
                alert::warning('Tramite no encontrado');
                return redirect()->back();
            }

        $solicitado->categoria = 'archivado';
        $solicitado->save();

        $pendientes = TramiteSolicitado::with([
            'tramite',
            'student'
        ])
        ->where('estatus', '!=', 'Recibido')
        ->where('categoria', 'solicitado')
        ->orderBy('created_at', 'desc')
        ->get();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha archivado el trámite con folio: ';
        $log->type = 'admin';
        $log->target = $solicitado->id;
        $log->save();

        Alert::success('Trámite archivado exitosamente!');
        return redirect()->back();

    }

    public function dearchivar_tramite(Request $request)
    {
        $id = $request->input('desarchivar_tramite_id');

        $solicitado = TramiteSolicitado::find($id);
        if( !isset($solicitado) ){
            alert::warning('Tramite archivado no encontrado!');
            return response()->json([ 'say' => 'no']);
        }

        $solicitado->categoria = 'solicitado'; // si esta finalizado no!
        $solicitado->save();

        $archivados = TramiteSolicitado::with([
            'tramite',
            'student'
        ])
        ->where('categoria', 'archivado')
        ->orderBy('created_at', 'desc')
        ->get();

        $log = new Log();
        $log->user_id = auth()->user()->id;
        $log->action = 'Ha dearchivado el trámite con folio: ';
        $log->type = 'admin';
        $log->target = $solicitado->id;
        $log->save();

        $html_table = view('admin.tramites.ajax.index_archivadosTable')->with('archivados', $archivados)->render();

        return response()->json([
            'say' => 'yes',
            'data' => $html_table
        ]);
    }

    public function tramites_finalizados()
    {
        return view('admin.tramites.finalizados');
    }

    // POST
    public function filter_finalizados(Request $request)
    {

        $initialDate = date($request->input('fecha_inicial'));
        $finalDate = date($request->input('fecha_final'));

        if(!isset($initialDate) || !isset($finalDate)){
            return response()->json([ 'say' => 'No' ]);
        }

        $finalizados = TramiteSolicitado::with([ 'tramite', 'student'])
        ->where('categoria', 'finalizado')
        ->whereBetween('updated_at', [$initialDate, $finalDate] )
        ->get();

        $html_table = view('admin.tramites.ajax.index_finalizadosTable')->with('finalizados', $finalizados)->render();

        return response()->json([
            'data' => $html_table,
            'say' => 'yes'
        ]);
    }

    public function archivados()
    {
        $archivados = TramiteSolicitado::with([
            'tramite',
            'student'
        ])
        ->where('categoria', 'archivado')
        ->orderBy('created_at', 'desc')
        ->get();

        $html_table = view('admin.tramites.ajax.index_archivadosTable')->with('archivados', $archivados);
        return view('admin.tramites.archivados')->with('data', $html_table);
    }

    public function rechazados()
    {
        return view('admin.tramites.rechazados');
    }

    public function filter_rechazados(Request $request)
    {
        $initialDate = date($request->input('fecha_inicial'));
        $finalDate = date($request->input('fecha_final'));

        if(!isset($initialDate) || !isset($finalDate)){
            return response()->json([ 'say' => 'No' ]);
        }

        $rechazados = TramiteSolicitado::with([ 'tramite', 'student'])
        ->where('categoria', 'rechazado')
        ->whereBetween('updated_at', [$initialDate, $finalDate] )
        ->get();

        $html_table = view('admin.tramites.ajax.index_rechazadosTable')->with('rechazados', $rechazados)->render();

        return response()->json([
            'data' => $html_table,
            'say' => 'yes'
        ]);
    }


    function calcular_matriculas(Request $request)
    {
        $semester_initial = $request->input('semester_initial');
        $monto_tramite = $request->input('monto'); //arancel
        $ciclos = Ciclo::get();
        $current_ciclo = Ciclo::where('selected', true)->first()->semestre;

        $total = 0;
        $count = 0;

        $array_matriculas = [];

        $startCounting = false;
        foreach($ciclos as $c){
            if($c->semestre > $semester_initial)
                $startCounting = true;

            if($startCounting){
                $total += $c->matricula;
                $count++;
                array_push($array_matriculas, [ $c->semestre, $c->matricula]);
            }

            if($c->semestre == $current_ciclo)
                break;
        }

        $total += $monto_tramite;

        return [
            'say' => 'Yes',
            'total' => $total,
            'count' => $count,
            'matriculas' => $array_matriculas
        ];
    }


    public function Doc_NoAdeudo(Request $request)
    {
        $request->validate([
           'docNoAdeudo_id' => 'required',
        ]);
        $id = $request->input('docNoAdeudo_id');

        $tr = TramiteSolicitado::with('tramite', 'student')->where('id', $id)->first();

        $meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

        $currentDate = $tr->updated_at;

        $data = [
          'id' => $tr->id, // ?
          'usr_apellidos_nombres' => $tr->student->apellidos .' ' . $tr->student->name,
          'usr_codigo' => $tr->student->codigo,
          'usr_carrera' => $tr->student->nombre_carrera,
          'tr_year' => $tr->created_at->format('Y'),
          'currentDay' => $currentDate->format('d'),
          'currentMonth' => $meses[$currentDate->format('m') - 1],
          'currentYear' => $currentDate->format('Y'),
        ];
        $pdf = PDF::loadView('formatos.doc_noAdeudo', $data);

        return $pdf->download('ConstanciaNoAdeudo_' . $tr->student->codigo . '.pdf');
    }

    public function check_tramites_numbers(Request $request)
    {
        $validated = $request->validate([
            'tr_name' => 'required|not_regex:(-)',
        ]);

        $tramite_name = $request->input('tr_name');

        $id = Tramite::where('nombre_tramite', $tramite_name)->first()['id'];

        if(!isset($id))
            return 0;

        $cantidad = TramiteSolicitado::where('tramite_id', $id)->where('student_id', auth()->user()->id)->count();
        return $cantidad;

    }

}
