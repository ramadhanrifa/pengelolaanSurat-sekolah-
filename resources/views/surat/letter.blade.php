<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat</title>
    <style>
        .-td-header {
            padding:20px 10px ;
            display: flex;

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
            flex-direction: column;
            align-items: center;
        }
        .sekolah {
           width: 18rem;
           margin-left: 85px;
           float: inline-start;
           /* height: 80%; */
        }
        .kontak{
            margin-left: 60%;
            /* margin-bottom: 50%; */
            width: 40%;
            float: inline-end;
            /* height: 80%; */
        }

        .line-head{
            margin-top: 25%;
            border-bottom: 1px solid;
            height: 3px;
            background-color: black;
        }
        .tanggal-keluar {
            float: right;
            padding-right: auto;
            margin-top: auto;
            text-align: end;
        }
        .-td-terlampir {
            display: flex;

            float: inline-start;
        }
        .data-surat {
            float: inline-start;
            margin-top: 20px;
            padding: 25px 15px;
        }
        .tujuan {
            margin-left: 40rem;
            /* float: inline-end; */
            margin-top: 3rem;
            /* padding: 25px 15px; */
        }
        .-td-isi{
            margin-top: 15rem;
            padding: 5px 25px;
            margin-left: 2%;
        }
        .recipients {
            margin: 5rem 0;
        }
        .container-td{
            margin-top: 7rem;
            text-align: end;
            padding-right: 50px;
            float: right;
        }
        .td {
            margin-top: 5rem;
            float: right;
        }
        .logo {
            width: 75px;
            height: 75px;
            float: left;
        }
    </style>
</head>
<body>
    <div class="-td-header">
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

    </div>
        <div class="line-head"> </div>

        <div class="tanggal-keluar">
                @php
                    $tanggal = \Carbon\Carbon::parse($letter['created_at'])->format('d F Y')
                @endphp

            {{$tanggal}}
        </div>

    <div class="-td-terlampir">

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

    <div class="-td-isi">
     {!! $letter['content'] !!}
    </div>

    <div class="recipients">
        @php
            $no = 1;
        @endphp
        @foreach ($letter['recipients'] as $peserta )
        <ol style="list-style: none">

            <li> {{$no++}} {{$peserta}} </li>

        </ol>
            @endforeach

    </div>

    <div class="container-td">
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
