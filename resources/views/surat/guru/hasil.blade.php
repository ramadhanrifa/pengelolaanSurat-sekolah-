@extends('layout.template')

@section('content')

<h1>Hasil Surat</h1>
<h5><a href="{{route('guru.dashboard.page')}}" class="text-primary-emphasis">Dashboard</a> / <a href="{{ route('guru.index')}}" class="text-primary-emphasis">Data Surat Masuk</a> / <a href="#" class="text-primary">Hasil Surat</a></h5>

<form action="{{ route('guru.update') }}" method="POST" enctype="multipart/form-data" class="card ps-5 pe-5">
    @csrf
    @method('PATCH')

    <input type="number" id="id" name="letter_id" value="{{$letters->id}}" hidden>

    <label for="">Kehadiran</label>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
              <th scope="col">Nama</th>
              <th scope="col">Peserta(ceklis jika 'ya') </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($letters->recipients as $people)
            <tr>

                    <td> {{$people}} </td>
                    <td>
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="{{ $people }}" id="presence_recipients" name="presence_recipients[]">
                        </div>
                    </td>
                @endforeach
            </tr>
          </tbody>
    </table>

    <label for="">Ringkasan Hasil Rapat</label>
    <div class="mb-3 mt-3">
        <textarea name="notes" id="textarea"></textarea>
        <script>
            ClassicEditor
                .create( document.querySelector( '#textarea' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
        {{-- {{ $user->links() }} --}}
      </div>


    <button type="submit" class="btn btn-primary">Buat</button>

</form>

@endsection
