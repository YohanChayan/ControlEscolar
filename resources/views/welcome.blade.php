<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Control escolar</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('custom/cover/cover.css')}}" rel="stylesheet">

</head>



<style>

body{
    background: gray;
}

/* p{
    color: rgba(255, 255, 255, .5);
} */

</style>

<body class="text-center">

    <div class=" d-flex h-100 p-3 mx-auto flex-column ">
      <header class="masthead mb-auto">
        <div class="inner">
          {{-- <h3 class="masthead-brand">Control escolar</h3> --}}
          <nav class="nav nav-masthead justify-content-center">
          @if(Auth::Check())
            <a class="nav-link" href="{{route('home')}}">Inicio</a>
          @else
            <a class="nav-link " href="{{route('login')}}">Iniciar sesión</a>
            <a class="nav-link px-3" href="{{route('register')}}">Registrarse</a>
          @endif

          </nav>
        </div>
      </header>

      <main role="main" class="inner cover mx-auto " style="width: 50%">

          <img class="img-fluid" src="{{asset('custom/cover/img/cucsh-logo-cover-transparent.png')}}">
        {{-- <h1 class="cover-heading">Contro escolar</h1> --}}
        <p class="lead d-block">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
        {{-- <p class="lead">
          <a href="#" class="btn btn-lg m-3 btn-secondary">Iniciar sesión</a>
          <a href="#" class="btn btn-lg m-3 btn-secondary">Registrarse</a>
        </p> --}}
      </main>

      <footer class="mastfoot mt-auto">
        {{-- <div class="inner">
          <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
        </div> --}}
      </footer>
    </div>
</body>


