<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Pengelolaan Surat</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link href="{{ asset('styles.css') }}" rel="stylesheet" type="text/css" />
        <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{  asset('scripts.js') }}"></script>
        <style>
            a {
                text-decoration: none;
            }
        </style>
    </head>
    <body>
    @if(Auth::check())
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">Pengelolaan Surat</div>
                <div class="list-group list-group-flush">
                    {{-- @if(Auth::check())
                        @if(Auth::user()->role == 'ps') --}}

                        {{-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('tu.dashboard.page') }}">Dashboard</a>
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Data keterlambatan</a> --}}
                        {{-- @else --}}


                                @if (Auth::user()->role == 'staff')
                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('user.tu.dashboard.page') }}">Dashboard</a>
                                <a class="list-group-item list-group-item-action list-group-item-light p-3 dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data User</a>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('user.tu.index') }}">Data Staff Tata Usaha</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.guru.index') }} ">Data Guru</a></li>
                                  </ul>
                                    <a class="list-group-item list-group-item-action list-group-item-light p-3 dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data Surat</a>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="{{ route('surat.tu.klasifikasi.index') }}">Data klasifikasi Surat</a></li>
                                      <li><a class="dropdown-item" href="{{ route('surat.tu.data.index') }}">Data Surat</a></li>
                                    </ul>

                                @else
                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('guru.dashboard.page') }}">Dashboard</a>
                                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('guru.index') }}">Data Surat Masuk</a>

                                @endif
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">

                        <button class="navbar-toggler-icon" id="sidebarToggle"></button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item"><p class="nav-link" href="#!">{{Auth::user()->name}}</p></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('user.png') }}" alt="user" style="width: 30px; "></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if(Auth::check())
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('logout')}}">logout</a>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                @endif
                <!-- Page content-->
                <div class="container-mt-5">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>


        {{-- script to ckeditor --}}
        @stack('script')
    </body>
</html>


