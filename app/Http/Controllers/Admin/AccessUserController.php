<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->refreshTable();
        $html_table = view('admin.accesos.ajax.index_accesosTable')->with('users', $data);
        return view('admin.accesos.index')->with('data', $html_table);
    }

    public function refreshTable()
    {
        $users = User::select('id','name', 'email', 'apellidos','codigo','estatus', 'created_at')
        ->whereRaw('LENGTH(codigo) = 7')
        ->orderBy('created_at', 'desc')
        ->get();
        return $users;
    }

    public function grantUser($id)
    {

    }

    public function revokeUser($id)
    {

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

     // store --for-- GRANT USER
    public function store(Request $request)
    {
        $this->authorize('admin');
        $validated = $request->validate([
            'user_id' => 'required',
        ]);
        $user = User::find($request->input('user_id'));
        $user->estatus = 'Activo';
        $user->update();

        $data = $this->refreshTable();
        return view('admin.accesos.ajax.index_accesosTable')->with('users', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

     // Soft deleted method
    public function destroy($id)
    {
        $user = User::find($id);
        $user->estatus = 'Inactivo';
        $user->save();
        $data = $this->refreshTable();
        return view('admin.accesos.ajax.index_accesosTable')->with('users', $data);
    }
}
