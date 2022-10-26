<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private function refreshTable()
     {
         // select id,nombre,group_concat(clave SEPARATOR ',') as claves from carreras group by nombre order by id

        $careers = Carrera::select('id','nombre','wrapperID', DB::raw("group_concat(clave SEPARATOR ',') as claves"))->groupBy('wrapperID')->get();
        return $careers;

     }


    public function index()
    {
        $careers = $this->refreshTable();
        $html_table = view('admin.carreras.ajax.index_carreraTable')->with('carreras', $careers)->render();
        return view('admin.carreras.index')->with('data', $html_table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('admin');

        $request->validate([
            'nombre_carrera' => 'required',
            'claves' => 'required',
        ]);
        $claves = $request->input('claves');
        $claves = strtoupper($claves);
        $claves = explode(',', $claves);
        array_pop($claves); // remove last ','

        $nombre_tramite = $request->input('nombre_carrera');

        $lastID_wrapper = Carrera::select('wrapperID')->orderBy('wrapperID', 'desc')->first();

        $carreras = [];

        foreach($claves as $cl){
            $carrera = new Carrera();
            $carrera->nombre = $nombre_tramite;
            $carrera->clave = $cl;
            $carrera->wrapperID = $lastID_wrapper->wrapperID + 1;
            $carrera->save();
            array_push($carreras, $carrera);
        }

        $careers = $this->refreshTable();
        $html_table = view('admin.carreras.ajax.index_carreraTable')->with('carreras', $careers)->render();

        return response()->json([
            'say' => 'yes',
            'message' => 'Carrera creada correctamente!',
            'data' => $html_table
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrera $carrera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $this->authorize('admin');

        $request->validate([
            'nombre_carrera' => 'required',
            'claves' => 'required',
        ]);

        $wrapperID = $request->input('id');
        Carrera::where('wrapperID', $wrapperID)->delete(); //delete all keys and replace

        $nombre_tramite = $request->input('nombre_carrera');

        $newClaves = explode(',', $request->input('claves'));
        array_pop($newClaves); // remove last ','

        foreach($newClaves as $cl){
            $newCareer = new Carrera();
            $newCareer->nombre = $nombre_tramite;
            $newCareer->wrapperID = $wrapperID;
            $newCareer->clave = $cl;
            $newCareer->save();

        }

        $careers = $this->refreshTable();
        $html_table = view('admin.carreras.ajax.index_carreraTable')->with('carreras', $careers)->render();

        return response()->json([
            'say' => 'yes',
            'message' => 'Carrera actualizada correctamente!',
            'data' => $html_table
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $careers = Carrera::where('wrapperID', $id)->get();

        if( count($careers) == 0 ){
            Alert::warning('Error', 'Carrera no encontrada');
            return redirect()->back();
        }

        foreach($careers as $c){
            $c->delete();
        }

        Alert::success('Éxito', 'Carrera eliminada correctamente!');
        return redirect()->back();
    }
}
