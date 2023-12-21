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
        .flex{
            display: flex;
        }
        .kontak{
            margin-left: auto;
        }
        .garis-sekolah{
            height: 1.5px;
        background: gray;
        }
        .line-head{
            height: 3px;
            background-color: black;
        }
        .tanggal-keluar {
            padding-right: 250px;
            margin-top: 30px;
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
            margin-left: 52rem;
        }
        .container-isi{
            padding: 20px 25px;
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
            margin-top: 200px;
        }

        #receipt {
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 30ox auto 0 auto;
            width: 500px;
            background: #fff;
        }
        #back-wrap {
            margin: 30px auto 0 auto;
            width: 500px;
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <div id="back-wrap">
        <a href="{{ route('kasir.order.index') }}" class="btn-back">Kembali</a>
    </div>
    <div id="receipt">
        <a href="{{ route('surat.download', $letter['id']) }}" class="btn-print">Cetak (.pdf)</a>
    </div>

    <div class="container-header">
        <div class="flex">
            <img src="{{asset('wk-removebg-preview.png')}}" alt="" class="logo">
            <div class="sekolah">
                <h1>SMK WIKRAMA BOGOR</h1>
                <hr class="garis-sekolah">
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

        <div class="tanggal-keluar"> {{$letter['created_at']}}</div>

    <div class="container-terlampir">

            <div class="data-surat">
                <div class="no_surat">
                    @if($letter->letter_type)
                        No : {{$letter->letter_type->letter_code}}
                    @endif
                </div>
                <div class="perihal">
                    Hal : {{$letter->letter_perihal}}
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
     {!! $letter->content !!}
    </div>

    <div class="recipients">
        <ol>
            @foreach ($letter->reciptients as $peserta )
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






</body>
</html>
