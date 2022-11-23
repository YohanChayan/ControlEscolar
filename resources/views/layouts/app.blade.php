<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Control Escolar</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('custom/dashboard/img/favicon.png') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('custom/dashboard/img/favicon.png') }}"

    {{-- dashboard --}}
    @include('layouts.custom_links')
</head>
<body>

    <div id="app">
        @if(Auth::Check() && !is_null( Auth()->user()->email_verified_at ) )
            {{-- Template --}}
            @include('layouts.main')
        @else
            {{-- Bootstrap default Login --}}
            @include('layouts.navbar')
            <main class="py-5">
                @yield('content')
            </main>
        @endif

        @include('sweetalert::alert')
        @yield('my_scripts')
    </div>

</body>
</html>
