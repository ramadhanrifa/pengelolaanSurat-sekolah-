@extends('layout.template')

@section('content')

    <h1>Data Surat</h1>
    <h3></h3>

    <br>
    @if (Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-success">{{ Session::get('deleted') }}</div>
    @endif
    @if (Session::get('created'))
    <div class="alert alert-success">{{ Session::get('created') }}</div>
    @endif


    <div class="d-flex justify-content-start">
        <a href="{{ route('surat.tu.data.create') }}" class="btn btn-primary me-3 " aria-current="page">Buat Data</a>

    </div>
    {{-- <div class="d-flex justify-content-end">
        <form action="{{ route('surat.data.index') }}" method="GET">
            <input type="text" name="nama" id="nama" class="input-group input-group-sm mb-3" placeholder="Cari nama ?">
            <input type="submit" class="btn btn-secondary mt-3">
        </form>
        <a href="{{ route('surat.data.index') }}"><button class="btn btn-secondary">Refresh</button></a>
    </div> --}}
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">No Surat</th>
              <th scope="col">Perihal</th>
              <th scope="col">Tanggal Keluar</th>
              <th scope="col">Penerima Surat</th>
              <th scope="col">Notulis</th>
              <th scope="col">Hasil Rapat</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @php $no = 1;
            $count = 1;
            @endphp

            @foreach ($letters as $letter)
            <tr>
                <td>{{ $no ++ }}</td>
                <td>
                    {{-- harus di if dulu --}}
                     {{$letter->letter_type->letter_code}}/{{$count++}}
                </td>
                <td> {{$letter['letter_perihal']}} </td>
                <td>
                    @php
                        $tanggal = $letter['created_at']->format('d-F-Y')
                    @endphp
                    {{$tanggal}}
                </td>
                <td>
                @foreach ($letter['recipients'] as $recipients)
                <ul style="list-style-type: none;">
                    <li>
                        {{$recipients}}
                    </li>
                </ul>

                @endforeach
                </td>

                <td>
                    @if($letter->user)
                    {{$letter->user->name}}
                    @endif
                </td>

                <td>Hasil Rapat</td>

                <td>

                    <div class="d-flex justify-content-start">
                        <a href="{{ route('surat.tu.download', $letter['id']) }}" class="btn btn-success me-2">lihat</a>
                        <form action="{{ route('surat.tu.data.delete', $letter['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger me-2" type="submit">Hapus</button>
                        </form>
                    <a href="{{route('surat.tu.data.edit', $letter['id'])}}" class="btn btn-primary me-2 " aria-current="page">edit Data</a>
                    </div>

                </td>
            @endforeach

              </tr>

      </table>
@endsection

