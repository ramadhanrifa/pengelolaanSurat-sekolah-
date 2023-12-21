@extends('layout.template')

@section('content')

    <h1>Tambah Data Surat</h1>
    <h3></h3>

    <form action="{{ route('surat.tu.data.store') }}" method="POST" enctype="multipart/form-data" class="card ps-5 pe-5">
        @csrf

        @if(Session::get('created'))
        <div class="alert alert-success">{{ Session::get('created') }}</div>
        @endif
        @if(Session::get('failed'))
        <div class="alert alert-success">{{ Session::get('failed') }}</div>
        @endif
        <div class="row mt-3">
            <div class="col">
              <label for="" class="form-label">Perihal</label>
              <input type="text" class="form-control" placeholder="Perihal apa" aria-label="First name" name="letter_perihal" id="perihal">
            </div>
            <div class="col">
              <label for="" class="form-label">Klasifikasi Surat</label>
              <select class="form-select" aria-label="Default select example" name="letter_type_id" id="letter_type_id">
                @foreach ($letters as $letterType)
                <option value="{{ $letterType->id}}"> {{$letterType->name_type}} </option>
                @endforeach

              </select>
            </div>
        </div>
          <div class="mb-3 mt-3">
            <textarea name="content" id="textarea"></textarea>
            <script>
                ClassicEditor
                    .create( document.querySelector( '#textarea' ) )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
          </div>
          <div class="mb-3 mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th scope="col">Nama</th>
                      <th scope="col">Peserta(ceklis jika 'ya') </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user as $item)
                    <tr>

                            <td> {{$item->name}} </td>
                            <td>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $item->name }}" id="recipients" name="recipients[]"></div>
                            </td>
                        @endforeach
                    </tr>
                  </tbody>
            </table>
            {{ $user->links() }}
          </div>

          <div class="mb-3 mt-3">
            <label for="formFile" class="form-label">Lampiran</label>
            <input class="form-control" type="file" id="lampiran" name="attachment">
          </div>
          <div class="mb-3 mt-3">
            <label for="formFile" class="form-label">Notulis</label>
            <select class="form-select" aria-label="Default select example" name="notulis" id="notulis">
                @foreach ($user as $name)
                    <option value="{{$name->id}}"> {{$name->name}} </option>
                @endforeach
              </select>
          </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endsection
