@extends('layout.template')

@section('content')
    <h1>Data User</h1>
    <h5><a href="{{route('user.tu.dashboard.page')}}" class="text-primary-emphasis">Dashboard</a> / <a href="text-primary">Data Staff</a></h5>
    @if (Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-success">{{ Session::get('deleted') }}</div>
    @endif
    <div class="d-flex justify-content-start"><a href="{{ route('user.tu.create') }}" class="btn btn-primary me-3 " aria-current="page">Buat Data</a>
    </div>
    <div class="d-flex justify-content-end">
        <form action="{{ route('user.tu.index') }}" method="GET">
            <input type="text" name="nama" id="nama" class="ps-3" placeholder="Cari nama ?">
            <input type="submit" class="btn btn-secondary me-3">
        </form>
        <a href="{{ route('user.tu.index') }}"><button class="btn btn-secondary">Refresh</button></a>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">nama</th>
              <th scope="col">email</th>
              <th scope="col">Role</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            {{-- @if(Auth::user()->role == 'staff') --}}
            @php $no = ($users->currentPage() - 1) * $users->perPage() + 1; @endphp

            @foreach ($users as $item)
            @if($item['role'] == 'staff')
            <tr>
                <td>{{ $no++ }} </td>
                <td>{{$item['name']}} </td>
                <td>{{$item['email']}} </td>
                <td>{{$item['role']}} </td>
                <td>
                    <div class="d-flex justify-content-start">
                        <form action="{{ route('user.tu.delete', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger me-3" type="submit">Hapus</button>
                        </form>
                    <a href="{{ route('user.tu.edit', $item['id']) }}" class="btn btn-primary me-3 " aria-current="page">edit Data</a>
                    </div>
                </td>
              </tr>
              @else

            @endif


            @endforeach
            {{-- @endif --}}

      </table>
@endsection
