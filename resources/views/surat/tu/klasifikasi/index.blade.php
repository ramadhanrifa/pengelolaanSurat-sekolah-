@extends('layout.template')

@section('content')

    <h1>Data Klasifikasi Surat</h1>
    <h3></h3>
    <div class="justify-content-start">
            <a href="{{ route('surat.tu.klasifikasi.create') }}" class="btn btn-primary me-3 " aria-current="page">Tambah</a>
            <a href="{{ route('surat.tu.klasifikasi.export.excel') }}" class="btn btn-primary me-3 " aria-current="page">Export to excel</a>
    </div>


    @if(Session::get('deleted'))
    <div class="alert alert-success">{{ Session::get('deleted') }}</div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kode Surat</th>
              <th scope="col">Klasifikasi Surat</th>
              <th scope="col">Surat Tertaut</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @php $no = ($type->currentPage() - 1) * $type->perPage() + 1; @endphp
            @foreach ($type as $tipe)
            <tr>
                     <td>{{ $no++}}</td>
                     <td>{{ $tipe['letter_code']}}</td>
                     <td>{{ $tipe['name_type']}}</td>
                     <td>
                        @if ($tipe->letter)
                            {{$tipe->letter->count()}}
                        @endif
                     </td>
                     <td>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('surat.tu.klasifikasi.detail', $tipe['id']) }}">Detail</a>
                             <form action="{{ route('surat.tu.klasifikasi.delete', $tipe['id']) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button class="btn btn-danger me-3" type="submit">Hapus</button>
                             </form>

                     </td>
                @endforeach

              </tr>


      </table>
      <div class="d-flex justify-content-end">
        {{-- jika data ada atau > 0 --}}
        @if($type->count())
            {{-- memunculkan tampilan pagination --}}
            {{ $type->links() }}
        @endif
    </div>

@endsection
