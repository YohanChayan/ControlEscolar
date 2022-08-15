<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Crypt;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        // dd($input,"- CreateNewUser");
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'regex:/(.*)@(alumnos|academicos)\.udg.mx/i' , 'max:255', 'unique:users'],
            'apellidos' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'min:7' , 'max:9', 'unique:users'],
            'telefono' => ['required', 'string', 'min:10' , 'max:15'],
            'clave_carrera' => ['required', 'string', 'max:255'],
            'ciclo_admision' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'apellidos' => $input['apellidos'],
            'codigo' => $input['codigo'],
            // 'codigo' =>  Crypt::encryptString($input['codigo']),
            'clave_carrera' => $input['clave_carrera'],
            'ciclo_admision' => $input['ciclo_admision'],
            'telefono' => $input['telefono'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
