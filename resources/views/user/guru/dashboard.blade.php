@extends('layout.template')

@section('content')
    <div class="flex-inline-block" style="display:inline-block;">

    <h1>Dashboard Guru</h1>
    <h5><a href=""class="text-primary">Dashboard</a></h5>
    <br>
    <div class="d-flex justify-content-center">
            <div class="card" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title">Surat Keluar</h5>
                    <div class="d-flex">
                        <img src="{{ asset('user1.png') }}" style="width: 15px; height:15px; " alt="" class="logo">
                    {{-- @for($no = 1; $no) --}}
                        <p class="card-text ms-2">{{$surat}}</p>

                    </div>
                </div>
            </div>
    </div>
@endsection
