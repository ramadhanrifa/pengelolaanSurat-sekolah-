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
            font-size: 20px;
            border-bottom: 1px solid gray;

        }
        h3 {
            font-size: 15px
        }
        p{
            font-size: 12px
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
    </style>
</head>
<body>
    <div class="container-header">
        <div class="flex">
            <img src="{{public_path('/wk-removebg-preview.png')}}" alt="" class="logo">
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

        <div class="tanggal-keluar">
                @php
                    $tanggal = \Carbon\Carbon::parse($letter['created_at'])->format('d F Y')
                @endphp

            {{$tanggal}}
        </div>

    <div class="container-terlampir">

            <div class="data-surat">
                <div class="no_surat">
                        No : {{$letter['letter_type']['letter_code']}}
                </div>
                <div class="perihal">
                    Hal : {{$letter['letter_perihal']}}
                </div>
            </div>
            <div class="tujuan">
                <p>Kepada</p> <br>
                <p>Yth.Bapa/Ibu Terlampir</p>
                <p>di</p>
                <p>Tempat</p>
            </div>


    </div>

    <div class="container-isi">
     {!! $letter['content'] !!}
    </div>

    <div class="recipients">
        <ol>
            @foreach ($letter['recipients'] as $peserta )
            <li> {{$peserta}} </li>

        </ol>
            @endforeach

    </div>

    <div class="container">
        <p>Hormat Kami,</p>
        <p>Kepala SMK Wikrama Bogor</p>

        <div class="td">
            (.............................)
        </div>
    </div>


    <div class="lampiran">
        @if($letter['attachment'])
            <img src="" alt="">
        @endif
    </div>



</body>
</html>
