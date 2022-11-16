<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Ciclo;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        //explicit return to view users register

        $ciclos = Ciclo::select('semestre')->orderBy('semestre', 'desc')->get();
        $careers = Carrera::select('id', DB::raw("CONCAT(clave, ' - ', nombre) AS nombre") )->get();

        return view('auth.register')
            ->with('carreras', $careers)
            ->with('ciclos', $ciclos)
        ;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(strlen($data['codigo']) == 9){

            $validated =  Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'confirmed' ,'unique:users'],
                'apellidos' => ['required', 'string', 'max:255'],
                'codigo' => ['required', 'string', 'min:9' , 'max:9','unique:users'],
                'telefono' => ['required', 'string', 'min:10' , 'max:15'],
                'carrera' => ['required', 'string'],
                'ciclo_admision' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            return $validated;
        }

        $validated =  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255' , 'unique:users'],
            'apellidos' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'min:7' , 'max:7' ,'unique:users'],
            'telefono' => ['required', 'string', 'min:10' , 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

            // 'regex:/(.*)@(academicos|administrativos)\.udg.mx/i',

        return $validated;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $career = explode(' - ', $data['carrera'] );
        if(strlen($data['codigo']) == 7){
            $career[0] = null;
            $career[1] = null;
        }

        return User::create([
            'role' => 'noVerified',
            'name' => $data['name'],
            'email' => $data['email'],
            'apellidos' => $data['apellidos'],
            'codigo' =>  $data['codigo'],
            'telefono' =>  $data['telefono'],
            'clave_carrera' => $career[0],
            'nombre_carrera' => $career[1],
            'ciclo_admision' => $data['ciclo_admision'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
