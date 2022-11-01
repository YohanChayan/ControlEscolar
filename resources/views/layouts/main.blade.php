<!-- Spinner Start -->
<div class="container-fluid-xxl pepe">

<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Cargando...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Sidebar Start -->
    @include('layouts.sidebar')
<!-- Sidebar End -->


<!-- Content Start -->
<div class="content">

    @include('layouts.navbar2')

    <div class="container-fluid">
        @yield('content')
        {{-- container fluid in content --}}
    </div>

</div>
<!-- Content End -->


<!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
{{-- </div> --}}



<!-- Footer -->
{{-- <div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                <a href="#">Control Escolar</a>
            </div>
            <div class="col-12 col-sm-6 text-center text-sm-end">
                Designed By <a href="https://htmlcodex.com">HTML Codex</a>
            </div>
        </div>
    </div>
</div> --}}


{{-- <footer class="footer mt-auto py-3 bg-light">
    <div class="container-fluid">
      <span class="text-light">Place sticky footer content here.</span>
    </div>
</footer> --}}

</div>
@include('layouts.scripts')

{{-- @yield('my_scripts') --}}




