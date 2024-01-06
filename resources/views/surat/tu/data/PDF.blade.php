<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat</title>
    <style>
        .container-header {
            padding:20px 10px ;

        }
        h1 {
            font-size: 15px;
            border-bottom: 1px solid gray;

        }
        h3 {
            font-size: 13px
        }
        p{
            font-size: 10px
        }
        .flex{
            display: flex;
        }
        .sekolah {
           width: 12rem;
        }
        .kontak{
            margin-left: auto;
        }

        .line-head{
            height: 3px;
            background-color: black;
        }
        .tanggal-keluar {
            padding-right: auto;
            margin-top: auto;
            text-align: end;
        }
        .container-terlampir {
            display: flex;
            margin-top: 20px;
            padding: 25px 15px;
        }
        .data-surat {

        }
        .tujuan {
            margin-left: auto;
        }
        .container-isi{
            padding: 5px 25px;
        }
        .recipients {
            margin: 5rem;
        }
        .container-td{
            margin-top: 350;
            text-align: end;
            padding-right: 50px;

        }
        .td {
            margin-top: 20px;
        }
        .logo {
            width: 50px;
            height: 50px
        }

        #surat{
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: auto auto;
            width: 500px;
            background: #fff;
        }

        #back-wrap {
            margin: 30px auto 0 auto;
            width: 500px;
            display: flex;
            justify-content: flex-end;
        }
        .btn-back {
            width: fit-content;
            padding: 8px 15px;
            color: #fff;
            background: #666;
            border-radius: 5px;
            text-decoration: none;
        }
        .recipientsPresent{
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            width: 500px;
            background: #fff;
            margin: 100px auto;

        }
    </style>
</head>
<body>
    <div id="back-wrap">
        <a href="{{ route('surat.tu.data.index') }}" class="btn-back">Kembali</a>
    </div>
    <div id="surat">
        <a href="{{ route('surat.tu.download', $letters['id']) }}" class="btn-print">Cetak (.pdf)</a>

        <div class="container-header">
            <div class="flex">
                <img src="{{asset('wk-removebg-preview.png')}}" alt="" class="logo" class="logo">
                <div class="sekolah">
                    <h1>SMK WIKRAMA BOGOR</h1>
                    <h3>Bisnis dan Manajemen Teknologi dan Komunikasi Pariwisata</h3>
                </div>
                <div class="kontak">
                    <p>Jl.Raya Wangun Kel. Sindangsari Bogor</p> <br>
                    <p>Telp/Faks: (0251) 8242411 </p>
                    <p>e-mail: Prohumasi@smkwikrama.sch.id</p>
                    <p>website: www.smkwikrama.sch.id</p>
                </div>
            </div>
            <hr class="line-head">
        </div>

            <div class="tanggal-keluar"> {{ date('d F Y', strtotime($letters->created_at)) }}</div>

        <div class="container-terlampir">

                <div class="data-surat">
                    <div class="no_surat">
                        @if($letters->letter_type)
                            No : {{$letters->letter_type->letter_code}}
                        @endif
                    </div>
                    <div class="perihal">
                        Hal : <strong>{{$letters->letter_perihal}}</strong>
                    </div>
                </div>
                <div class="tujuan">
                    <p>Kepada</p>
                    <p>Yth.Bapak/Ibu Terlampir</p>
                    <p>di Tempat</p>
                </div>


        </div>

        <div class="container-isi">
         {!! $letters->content !!}
        </div>

        <div class="recipients">
            <ol>
                @foreach ($letters->recipients as $letter )

                    <li> {{$letter}} </li>
                @endforeach
            </ol>


        </div>

        <div class="container">
            <p>Hormat Kami,</p>
            <p>Kepala SMK Wikrama Bogor</p>

            <div class="td">
                (.............................)
            </div>
        </div>


    </div>


    <div class="recipientsPresent">
        <h2 style="text-align: center;">Peserta Rapat yang hadir</h2>
        <table class="table table-bordered" border="1" style="margin: auto auto; width: 500px;">
            <thead>
                <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">Peserta(ceklis jika 'ya') </th>
                </tr>
              </thead>
              <tbody>
                    @foreach($letters->recipients as $peserta)
                <tr>
                        <td> {{$peserta}} </td>
                        {{-- @foreach($letters->result->presence_recipients as $recipients) --}}
                        <td>
                          <div class="form-check">
                            @if($peserta === $letters->result->presence_recipients)
                                <input class="form-check-input" type="checkbox" name="recipients[]" disabled ></div>
                            @else
                                <input class="form-check-input" type="checkbox" value="{{$peserta}}" name="{{$peserta}}" checked disabled style="accent-color: #007ffd"></div>
                            @endif
                        </td>
                        {{-- @endforeach --}}

                        @endforeach
                </tr>
              </tbody>
        </table>
        <h3>Ringkasan</h3>

        <p>{!! $letters->result->notes !!}</p>
        <h5 style="text-align: end;">notulis: {{$letters->user->name}}</h5>
    </div>






</body>
</html>
