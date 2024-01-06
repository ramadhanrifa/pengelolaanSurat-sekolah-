@extends('layout.template');

@section('content');

<h1>Data Surat</h1>
<h5><a href="{{route('guru.dashboard.page')}}" class="text-primary-emphasis">Dashboard</a> / <a href="{{ route('guru.index')}}" class="text-primary">Data Surat Masuk</a></h5>

@if(Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

<div class="d-flex justify-content-end">
    <form action="{{ route('guru.index') }}" method="GET">
        <input type="text" name="nama" id="nama" class="ms-3" placeholder="Cari nama ?">
        <input type="submit" class="btn btn-secondary me-3">
    </form>
    <a href="{{ route('guru.index') }}"><button class="btn btn-secondary">Refresh</button></a>
</div>
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
        @endphp

        @foreach ($letters as $letter)
        <tr>
            <td>{{ $no ++ }}</td>
            <td>
                 {{$letter->letter_type->letter_code}}/{{$letter->id}}/SMKWikrama/XI
            </td>
            <td> {{$letter['letter_perihal']}} </td>
            <td>
                @php
                    $tanggal = $letter['created_at']->format('d-F-Y')
                @endphp
                {{$tanggal}}
            </td>
            <td>
                @php $no =1 @endphp
            @foreach ($letter['recipients'] as $recipients)
            <ol style="list-style-type: none;">
                <li>
                   {{$no++}}.{{$recipients}}
                </li>
            </ol>

            @endforeach
            </td>

            <td>
                @if($letter->user)
                {{$letter->user->name}}
                @endif
            </td>

                <td>
                        {{-- @foreach($results as $result) --}}
                            @if($letter->result->notes == null)
                                <a href="{{ route('guru.create', $letter->id)}}"><button type="button" class="btn btn-warning">Buat Hasil Rapat</button></a>
                            @else
                            <p class="text-success">Sudah Dibuat</p>
                            @endif
                        {{-- @endforeach --}}
                    {{-- @endif --}}


                </td>



            <td>

                <div class="d-flex justify-content-start">
                    <a href="{{ route('guru.lihat', $letter['id']) }}" class="btn btn-success me-2">lihat</a>
                </div>

            </td>
        @endforeach

          </tr>

  </table>
@endsection

