@extends('layout.template')

@section('content')
    <h1>Tambah User</h1>
    <h3></h3>
    <div class="d-flex justify-content-end"><a href="{{ route('user.tu.index') }}" class="btn btn-primary me-3 " aria-current="page">Kembali</a>
    </div>
    <br>
    <form action="{{ route('user.tu.store') }}" method="POST"  class="card ps-5">
        @csrf

        @if(Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <div class="mb-3">
          <label for="exampleInputrombel1" class="form-label">nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
          <label for="exampleInputrombel1" class="form-label">email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
