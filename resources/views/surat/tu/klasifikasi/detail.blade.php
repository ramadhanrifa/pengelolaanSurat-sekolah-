@extends('layout.template')

@section('content')

    <h1>Detail Klasifikasi Surat</h1>
    <h5><a href="{{route('user.tu.dashboard.page')}}" class="text-primary-emphasis">Dashboard</a> / <a href="{{ route('surat.tu.klasifikasi.index')}}" class="text-primary-emphasis">Data Klasifikasi Surat</a> / <a href="#" class="text-primary">Detail Klasifikasi</a></h5>

    <br><br>
    <a href="{{ route('surat.tu.klasifikasi.index') }}" class="btn btn-primary me-3 " aria-current="page">kembali</a>

    @foreach ($letter_type as $tipe)
    <h1>{{ $tipe['letter_code']}} |</h1>
    <h2>|{{ $tipe['name_type']}}</h2>
    <br>
    @foreach ($tipe->letter as $letter)

    <div class="card mb-5" style="width: 18rem;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">{{ $letter->letter_perihal }}</h5>
                <a href="{{ route('surat.tu.download', $letter['id']) }}"><img src="{{ asset('downloads.png') }}" alt="" style="width: 20px"></a>
            </div>

            <p class="card-text">{{ $letter->created_at }}</p>
            <ol type="1">
                @if($letter->recipients)
                    @foreach ($letter->recipients as $peserta)
                        <li>{{ $peserta }}</li>
                    @endforeach
                @else
                    <li>No recipients found</li>
                @endif
            </ol>
        </div>
    </div>
    @endforeach

    <br><br>
@endforeach


@endsection
