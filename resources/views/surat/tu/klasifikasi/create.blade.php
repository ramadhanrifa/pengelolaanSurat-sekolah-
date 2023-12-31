@extends('layout.template')

@section('content')

    <h1>Tambah Data klasifikasi Surat</h1>
    <h5><a href="{{route('user.tu.dashboard.page')}}" class="text-primary-emphasis">Dashboard</a> / <a href="{{ route('surat.tu.klasifikasi.index')}}" class="text-primary-emphasis">Data Klasifikasi Surat</a> / <a href="#" class="text-primary">Tambah Klasifikasi Surat</a></h5>

    <div class="d-flex justify-content-end"><a href="{{ route('surat.tu.klasifikasi.index') }}" class="btn btn-primary me-3 " aria-current="page">Kembali</a>
    </div>
    <br>
    <form action="{{ route('surat.tu.klasifikasi.store') }}" method="POST"  class="card ps-5">
        @csrf

        @if(Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <div class="mb-3">
          <label for="exampleInputrombel1" class="form-label">Kode Surat</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="kode_surat" name="kode_surat" value="{{ old('kode_surat') }}">
        </div>
        <div class="mb-3">
          <label for="exampleInputrombel1" class="form-label">Klasifikasi Surat</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="klasifikasi" name="klasifikasi" value="{{ old('klasifikasi') }}">
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>

@endsection
