@extends('layouts.app')
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
                    <form method="POST" action="{{ route('register') }}">
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
                            <label for="user_type" class="col-md-4 col-form-label text-md-end">{{ __('Tipo de cuenta') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">

                                <select name="user_type" id="user_type" class="form-select mb-3" aria-label="Default select example" required >
                                    <option value="" >Seleccione el tipo de cuenta</option>
                                    <option value="student" >Estudiante</option>
                                    <option value="admin">Administrativo</option>
                                </select>

                                @error('user_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                                <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus>

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
                            <label for="clave_carrera" class="col-md-4 col-form-label text-md-end">{{ __('Clave de la carrera') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">

                                <input name="clave_carrera" class="form-control" list="carrera_list_options" id="clave_carrera" placeholder="Ingrese el nombre de la carrera..." value="{{ old('clave_carrera') }}">
                                    <datalist id="carrera_list_options">
                                    @foreach($carreras as $car)

                                        <option value="{{$car->nombre}}">

                                      {{-- <option value="San Francisco">
                                      <option value="New York">
                                      <option value="Seattle">
                                      <option value="Los Angeles">
                                      <option value="Chicago"> --}}

                                    @endforeach
                                    </datalist>

                                @error('clave_carrera')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" id="container_ciclo">
                            <label for="ciclo_admision" class="col-md-4 col-form-label text-md-end">{{ __('Ciclo de admisión') }}<span class="my-required-asterisk"></span> </label>

                            <div class="col-md-6">
                                <input id="ciclo_admision" type="text" class="form-control @error('ciclo_admision') is-invalid @enderror" name="ciclo_admision" value="{{ old('ciclo_admision') }}" autocomplete="ciclo_admision" autofocus>

                                @error('ciclo_admision')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                            </div>
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const user_type = document.getElementById('user_type');
    let showDataAnimation = false;

    user_type.addEventListener('change', function(){
        const currentValue = user_type.value;
        const container_ciclo = document.getElementById('container_ciclo');
        const container_clave_carr = document.getElementById('container_clave_carr');

        if(currentValue == 'student'){
            document.getElementById('ciclo_admision').required = true;
            document.getElementById('clave_carrera').required = true;
            container_ciclo.classList.remove("d-none");
            container_clave_carr.classList.remove("d-none");

            if(showDataAnimation){

                container_clave_carr.classList.remove('my_element', 'hide-element');
                container_clave_carr.classList.add('my-element', 'show-element')
                container_ciclo.classList.remove('my_element', 'hide-element');
                container_ciclo.classList.add('my-element', 'show-element')

                showDataAnimation = false;
            }

        }else if(currentValue == 'admin'){

            container_clave_carr.classList.remove('my_element', 'show-element');
            container_clave_carr.classList.add('my-element', 'hide-element')
            container_ciclo.classList.remove('my_element', 'show-element');
            container_ciclo.classList.add('my-element', 'hide-element')
            showDataAnimation = true;
        }
    });

    container_clave_carr.addEventListener('animationend', (event) => {
        if(!showDataAnimation){
            container_clave_carr.classList.remove('d-none');
        }else{
            container_clave_carr.classList.add('d-none');
        }
    });

    container_ciclo.addEventListener('animationend', (event) => {
        if(!showDataAnimation){
            container_ciclo.classList.remove('d-none');
        }else{
            container_ciclo.classList.add('d-none');
        }
    });
</script>

@endsection
