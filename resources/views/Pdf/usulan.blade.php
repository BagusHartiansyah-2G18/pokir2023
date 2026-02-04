<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resume</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        .fz12{ font-size: 12px;}
        .fz14{ font-size: 14px;}
        .fz16{font-size: 16px;}

        .w100p{width: 100%;}
        .w70p{width: 70%;}
        .w60p{width: 60%;}
        .w50p{width: 50%;}
        .w40p{width: 40%;}
        .w30p{width: 30%;}
        .w20p{width: 20%;}
        .w15p{width: 15%;}
        .w10p{width: 10%;}
        .w5p{width: 5%;}
        .w2p{width: 2%;}

        .container{
            margin: 0 auto;
            display: block;
            width: 90%;
            /* display: flex;
            flex-direction: column; */
        }
        table{
            box-sizing: 1.5px;
        }
        #tabelNo{

        }
        #tabelNo td{
            padding: 0;
            margin: 0;
        }
        td{
            padding: 5px;
        }
        .pm0{padding: 0px; margin: 0px;}
        .p0{padding: 0px;}
        .right{
            width: 100%;
            margin-left: 60%;
        }
        ul{
            padding: 0px;
            margin: 0px;
        }
        ol{
            padding: 0px 0px 0px 20px;
            margin: 0px;
        }
        .tupper{text-transform: uppercase;}
        .tlower{text-transform: lowercase;}
        .pwrap{padding: 0px 30px;}
        .tcenter{text-align: center;}
        .tend{text-align: right;}
        .fz40{font-size: 40px;}
        .fz30{font-size: 30px;}
        .fz25{font-size: 25px;}
        .fz20{font-size: 20px;}
        .bbottom{border-bottom: 1px solid;}

        .capitalize{text-transform: capitalize;}
        .noBold{font-weight: normal;}
    </style>
    <title>Laporan</title>
</head>
<body class="fz14" style="font-family: Arial, Helvetica, sans-serif;">
    @php
        $spaceTT = '<br><br><br><br>';
        $line ='____________________';
        $titik ='..............................................';
        $br="<br><br><br>";
        $kop='
            <table>
                <tr>
                    <td class="w30p">
                        <img src="logo/ksb.png" width="60px">
                    </td>
                    <td class="pwrap tcenter mKop">
                        <h2 class=" tupper fz20 noBold pm0 " >
                            PEMERINTAH KABUPATEN SUMBAWA BARAT<br>
                            <b>BADAN PERENCANAAN PEMBANGUNAN DAERAH</b>
                        </h2>
                        <i style="font-size: small;" class="pm0">jl. Bung Karno No. 5 Komplek KTC - Taliwang Tlp. (0372) 8182595 <br> e-mail: <u>Sekretariatbappedaksb@gmail.com</u> Kode Pos : 84455</i>
                    </td>
                </tr>
            </table>
        ';
        $spaci4='&nbsp;&nbsp;&nbsp;&nbsp;';
    @endphp

    <div class=" container">
        @php echo($kop); @endphp
        <hr>
        <br>
        <!-- <br> -->
        <table class="fz12" style="text-transform: lowercase;" class="w100p" border="1px">
            <tr class="tcenter">
                <td class="w2p">No</td>
                <td class="w5p">Sumber</td>
                <td >Usulan</td>
                <td class="w10p">Volume Satuan</td>
                <td class="w20p">Alamat</td>
                <td class="w15p">SKPD</td>
            </tr>
            @foreach ($data as $v)
                <tr class="tcenter">
                    <td >{{$v->kdUsulan}}</td>
                    <td >{{$v->kdUser}}</td>
                    <td >{{$v->nmUsulan}}</td>
                    <td >{{$v->volume}} ({{$v->satuan}})</td>
                    <td >@php echo((strlen($v->rt)>0? 'rt/rw. '.$v->rt.'/'.$v->rw."<br>":'').$v->nmLing );  @endphp </td>
                    <td >{{$v->nmDinas}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
