@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/registration/register.js')}}"></script>
@endsection


@section('content')

<style>

.my_element {padding: 10px; margin: 0 0 20px 0;}

@keyframes show-animate {
    from { transform: scale(0); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

@keyframes hide-animate {
    from { transform: scale(1); opacity: 1; }
    to { transform: scale(0); opacity: 0; }
}


/* animate new box */
.show-element { animation: show-animate .3s linear; }
.hide-element { animation: hide-animate .3s linear; }


    .my-required-asterisk:after {
        content: '*';
        color: red;
        padding-left: 2px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombres') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="apellidos" class="col-md-4 col-form-label text-md-end">{{ __('Apellidos') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus>

                                @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="codigo" class="col-md-4 col-form-label text-md-end">{{ __('Código') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">
                                <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus onchange="detectingCode(this.value)">

                                @error('codigo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telefono" class="col-md-4 col-form-label text-md-end">{{ __('Teléfono') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" id="container_clave_carr">
                            <label for="carrera" class="col-md-4 col-form-label text-md-end">{{ __('Clave de la carrera') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">

                                <input name="carrera" class="form-control" list="carrera_list_options" id="carrera" placeholder="Ingrese el nombre de la carrera..." value="{{ old('carrera') }}">
                                    <datalist id="carrera_list_options">
                                    @foreach($carreras as $car)
                                        <option value="{{$car->clave}}"> {{$car->nombre}} </option>
                                    @endforeach
                                    </datalist>

                                @error('carrera')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div id="cicloHelp" class="form-text">
                                    En caso de no saber su clave de carrera puede verificarlo directamente desde Siiau.
                                    <span class="d-block my-2">
                                        <span class="fw-bold">Atención:</span> Asegurarse de colocar la misma clave que aparace en Siiau.
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-4" id="container_ciclo">
                            <label for="ciclo_admision" class="col-md-4 col-form-label text-md-end">{{ __('Ciclo de admisión') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">

                               <input name="ciclo_admision" class="form-control" list="ciclos_list_options" id="ciclo_admision" placeholder="Ingrese el ciclo de admisión..." value="{{ old('ciclo_admision') }}">
                               <datalist id="ciclos_list_options">
                               @foreach($ciclos as $ci)
                                   <option value="{{$ci->semestre}}">
                               @endforeach
                               </datalist>

                                @error('ciclo_admision')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div id="cicloHelp" class="form-text">
                                    En caso de no saber su ciclo de admisión puede verificarlo directamente desde Siiau.
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo electrónico') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div id="correoHelp" class="form-text">
                                    De preferencia usar <span class="fw-bold">correo institucional</span>.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email-confirm" type="email" class="form-control" name="email_confirmation" required autocomplete="new-email">
                                <span class="fw-bold"> Confirmar </span>correo electrónico
                            </div>
                            <small class="dismatch_confirm-email text-danger fw-bold d-none">Confirmación de correo no coincide</small>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }} <span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <input type="hidden" name="identity_career" id="identity_career">

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{-- <button type="submit" id="btn-submitRegister" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button> --}}
                                <a id="btn-submitRegister" class="btn btn-primary">
                                    Registrarse
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
