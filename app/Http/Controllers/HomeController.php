<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tramite;
use App\Models\TramiteSolicitado;

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
        $myTramites = '';
        $myTramites = TramiteSolicitado::with('tramite')->where('user_id', auth()->user()->id )->paginate(5);
        // dd($mytramites);
        return view('dashboard')
            ->with('tramites', $myTramites)
        ;
    }
}
