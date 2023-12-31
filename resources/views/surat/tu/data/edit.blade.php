@extends('layout.template')

@section('content')

    <h1>Tambah Data Surat</h1>
    <h5><a href="{{route('user.tu.dashboard.page')}}" class="text-primary-emphasis">Dashboard</a> / <a href="{{ route('surat.tu.data.index')}}" class="text-primary-emphasis">Data Surat</a> / <a href="#" class="text-primary">Edit Surat</a></h5>

    <form action="{{ route('surat.tu.data.update', $letter['id']) }}" method="POST" enctype="multipart/form-data" class="card ps-5 pe-5">
        @csrf
        @method('PATCH')


        {{-- @if(Session::get('created'))
        <div class="alert alert-success">{{ Session::get('created') }}</div>
        @endif
        @if(Session::get('failed'))
        <div class="alert alert-success">{{ Session::get('failed') }}</div>
        @endif --}}
        <div class="row mt-3">
            <div class="col">
              <label for="" class="form-label">Perihal</label>
              <input type="text" class="form-control" placeholder="Perihal apa" aria-label="First name" name="letter_perihal" id="perihal" value="{{ $letter['letter_perihal']}}">
            </div>
            <div class="col">
              <label for="" class="form-label">Klasifikasi Surat</label>
              <select class="form-select" aria-label="Default select example" name="letter_type_id" id="letter_type_id">
                @foreach ($letter_type as $letterType)
                <option value="{{ $letterType->id}}"> {{$letterType->name_type}} </option>
                @endforeach

              </select>
            </div>
        </div>
          <div class="mb-3 mt-3">
            <textarea name="content" id="textarea">{{$letter->content}}</textarea>
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
            <select class="form-select" aria-label="Default select example" name="notulis" id="notulis" >
                @foreach ($user as $name)
                    <option value="{{$name->id}}"> {{$name->name}} </option>
                @endforeach
              </select>
          </div>

        <button type="submit" class="btn btn-primary">Edit Pesan</button>
    </form>
@endsection
