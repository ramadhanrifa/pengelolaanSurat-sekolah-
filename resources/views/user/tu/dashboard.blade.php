@extends('layout.template')

@section('content')
    <h1>Dashboard</h1>
        <h3><a href=""class="text-primary">Dashboard</a></h3>
        <br>
    <div class="d-flex justify-content-center">


            <div class="flex-inline-block" style="display:inline-block;">
                <div class="card" style="width: 40rem;">
                    <div class="card-body">
                        <h5 class="card-title">Surat Keluar</h5>
                        <div class="d-flex">
                            <img src="{{ asset('user1.png') }}" style="width: 15px; height:15px; " alt=""
                                class="logo">
                            <p class="card-text ms-2">{{$surat}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Klasifikasi Surat</h5>
                            <div class="d-flex">
                                <img src="{{ asset('google-docs.png') }}" style="width: 15px; height:15px; " alt=""
                                    class="logo">
                                <p class="card-text ms-2">{{ $klasifikasi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Staff Tata Usaha</h5>
                            <div class="d-flex">
                                <img src="{{ asset('google-docs.png') }}" style="width: 15px; height:15px; " alt=""
                                    class="logo">
                                <p class="card-text ms-2"> {{ $tu }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex">

                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Guru</h5>
                            <div class="d-flex">
                                <img src="{{ asset('user1.png') }}" style="width: 15px; height:15px; " alt=""
                                    class="logo">
                                <p class="card-text ms-2"> {{ $guru }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
