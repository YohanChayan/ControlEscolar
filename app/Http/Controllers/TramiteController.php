<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tramite;
use App\Models\TramiteSolicitado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use App\Notifications\TramiteProcesado;


class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        $this->authorize('admin');
        $validated = $request->validate([
            'nombre_tramite' => 'required',
            'monto' => 'required',
            'requerimientos' => 'required',
        ]);

        $tramite = new Tramite();
        $tramite->nombre_tramite = $request->input('nombre_tramite');
        $tramite->monto = $request->input('monto');
        $tramite->requerimientos = $request->input('requerimientos');
        $tramite->save();

        $data = $this->refreshTable();
        return view('admin.tramites.ajax.index_tramiteTable')->with('tramites', $data);
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
        $this->authorize('admin');
        $id = $request->input('id');
        $tramite = Tramite::find($id);

        $tramite->nombre_tramite = $request->input('nombre_tramite');
        $tramite->monto = $request->input('monto');
        $tramite->requerimientos = $request->input('requerimientos');
        $tramite->update();

        $data = $this->refreshTable();
        return view('admin.tramites.ajax.index_tramiteTable')->with('tramites', $data);
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
        $tramite->delete();

        $data = $this->refreshTable();
        return view('admin.tramites.ajax.index_tramiteTable')->with('tramites', $data);


        return 1;
        // return $restOfTramites;
    }

    public function charts_index()
    {
        $this->authorize('admin');

        // Working
        $tramites_mes = TramiteSolicitado::with('tramite')
        ->select( DB::raw('EXTRACT(MONTH FROM created_at) as Mes, COUNT(*) as CantidadMes'), 'tramite_id'  )
        ->where('estadistico', '1')
        ->groupBy('Mes', 'tramite_id')
        ->get();
        $arr_tramites_mes = [];

        for($i = 0; $i < 12; $i++){
            $arr_tramites_mes[$i] = array(
                'Total' => 0,
                'Certificado parcial de estudio' => 0,
                'Certificado total de estudio' => 0,
                'Certificado de graduado' => 0,
                'Acta de titulacion' => 0
            );
        }
        foreach($tramites_mes as $tm){

            $key = intval($tm->Mes-1);
            $arr_tramites_mes[$key][$tm->tramite->nombre_tramite] = $tm->CantidadMes;
            $arr_tramites_mes[$key]['Total'] =
                $arr_tramites_mes[$key]['Certificado parcial de estudio'] +
                $arr_tramites_mes[$key]['Certificado total de estudio'] +
                $arr_tramites_mes[$key]['Certificado de graduado'] +
                $arr_tramites_mes[$key]['Acta de titulacion'];

        }

        $general_total_tramites = TramiteSolicitado::with('tramite')->select(DB::raw('COUNT(*) AS Total'), 'tramite_id')->groupBy('tramite_id')->orderBy('Total', 'desc')->get();

        return view('admin.graficas.index')->with([
            'tramites_mes' => $arr_tramites_mes,
            'general_total_tramites' => $general_total_tramites
        ]);
    }

    // view solicitar tramite (student)
    public function solicitar_tramite()
    {
        $this->authorize('student');
        return view('student.tramites.create');
    }


    // generar tramite (student)
    public function generar_tramite(Request $request)
    {
        $this->authorize('student');
        $validated = $request->validate([
            'email' => 'required',
            'codigo' => 'required',
            'name' => 'required',
            'apellidos' => 'required',
            // 'nombre_tramite' => 'required|min:3',
            'tramite' => 'required|not_regex:(-)',
        ]);

        $new_procedure = new TramiteSolicitado();

        $new_procedure->user_id = auth()->user()->id;
        $new_procedure->tramite_id = Tramite::where('nombre_tramite', $request->input('tramite'))->first()->toArray()['id'];

        $lastFolio = TramiteSolicitado::select('folio')->where('tramite_id', $new_procedure->tramite_id )->orderBy('folio', 'desc')->first();

        // dd($lastFolio);

        if( is_null($lastFolio) || is_null($lastFolio->folio) ){
            $lastFolio = 1;
        }else
            $lastFolio = $lastFolio->folio + 1;
        $new_procedure->folio = $lastFolio;

        $new_procedure->save();


        $request->user()->notify(new TramiteProcesado($new_procedure));
        Alert::success('El trámite ha sido iniciado!');
        return redirect()->route('home');
        // ->with('estatus', 'El trámite ha sido iniciado!');
    }

    public function search_tramite(Request $request)
    {
        return view('admin.busqueda.search_tramites');
    }

}
