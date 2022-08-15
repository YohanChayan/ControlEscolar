<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Tramite;
use App\Models\User;
use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;


class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('nothing here!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('student');

        return view('student.tramites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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


        $new_procedure = new Tramite();

        $new_procedure->user_id = auth()->user()->id;
        $new_procedure->nombre_tramite = $request->input('tramite');
        $new_procedure->monto = Tramite::GetMontoByTramite($request->input('tramite'));
        $new_procedure->estatus = 'Recepción de tramite recibido en CE';
        $new_procedure->save();

        return redirect()->route('home')->with('estatus', 'El trámite ha sido iniciado!');

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
    public function update(Request $request, Tramite $tramite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tramite $tramite)
    {
        //
    }
}
