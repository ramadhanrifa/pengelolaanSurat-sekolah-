@extends('layout.template')

@section('content')
    <h1>Data Guru</h1>
    <h5><a href="{{route('user.tu.dashboard.page')}}" class="text-primary-emphasis">Dashboard</a> / <a href="{{ route('user.guru.index')}}" class="text-primary">Data Guru</a>
    @if (Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-success">{{ Session::get('deleted') }}</div>
    @endif
    <div class="d-flex justify-content-start"><a href="{{ route('user.guru.create') }}" class="btn btn-primary me-3 " aria-current="page">Buat Data</a>
    </div>
    <div class="d-flex justify-content-end">
        <form action="{{ route('user.guru.index') }}" method="GET">
            <input type="text" name="nama" id="nama" class="ps-3" placeholder="Cari nama ?">
            <input type="submit" class="btn btn-secondary me-3">
        </form>
        <a href="{{ route('user.guru.index') }}"><button class="btn btn-secondary">Refresh</button></a>
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
            @php $no = ($users->currentPage() - 1) * $users->perPage() + 1;
                $i = 1;
            @endphp
            @foreach ($users as $item)
            @if($item['role'] == 'guru')
            <tr>
                <td>{{ $no++ }} </td>
                <td>{{$item['name']}} </td>
                <td>{{$item['email']}} </td>
                <td>{{$item['role']}} </td>
                <td>
                    <div class="d-flex justify-content-start">
                        <form action="{{ route('user.guru.delete', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger me-3" type="submit">Hapus</button>
                        </form>
                        <a href="{{ route('user.guru.edit', $item['id']) }}" class="btn btn-primary me-3 " aria-current="page">edit Data</a>
                    </div>
                </td>
              </tr>
              @else

            @endif


            @endforeach

      </table>
      <div class="d-flex justify-content-end">
        {{-- mengecek jika ada data > 0 --}}
        @if($users->count())
        {{-- memunculkan tampilan paginate --}}
            {{ $users->links() }}
        @endif
    </div>
@endsection
