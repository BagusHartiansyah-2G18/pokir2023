<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" id="viewport" content="width = 639, height = device-height, maximum scale = 1.0, minimum-scale = 1.0">
        <title>E - POKIR</title>
        <link rel="stylesheet" href="{{ url('/style/css/output.css')}}"/>
        <link rel="stylesheet" href="{{ url('MFC/library/MaterialDesignIcons6/css/materialdesignicons.min.css')}}";>
        @extends('Dasar.head')
    </head>
   <body>

        <header id="mfc1">
            <div class="left">
                <h2 style="margin-left: 10%;">E - POKIR</h2>
                <button class="btn1" id="menu"><span class="mdi mdi-menu clight"></span></button>
            </div>
            <div class="center posRelative" style="flex-direction: column;top: 25px;">
                <span class="mdi mdi-web cinfo fziconR2 "></span>
                <div class="btnGroup" style="display: flex; flex-direction: row;">
                    <button class="btn2 binfo cwhite" id="hari">0 Hari</button>
                    <button class="btn2 binfo cwhite" id="jam">0 jam</button>
                    <button class="btn2 binfo cwhite" id="menit">0 menit</button>
                    <button class="btn2 binfo cwhite" id="detik">0 detik</button>
                </div>
            </div>
            <div class="right clight">
                <div class="msgLabelIcon cinfo">
                    <label class="fz12"></label>
                    <span class="mdi mdi-mail  fz25"></span>
                </div>
                <div class="msgLabelIcon cwarning">
                    <label class="fz12"></label>
                    <span class="mdi mdi-lightbulb fz25"></span>
                </div>
                <a href="{{ url('pokir/logout')}}" class="btn2 cdanger "><span class="mdi mdi-logout fz20">Logout</span></a>
            </div>
        </header>

        <div class="leftBar2 lbActive" id="liftBar2">
            <div class="icon">
                <img src="{{url('/logo/boy.png')}}" />
                <h2 class="fziconS">{!! $dt['nmUser'] !!}</h2>
                <span class="fz25">{!! $dt['ketUser'] !!}</span>
            </div>
            <ul>
                <li>
                    <a href="{{url('pokir/dashboard')}}" class="fz25 cdark">
                        <label>Dashboard</label>
                        <span class="mdi mdi-apps"></span>
                    </a>
                </li>
                <li class="dnone">
                    <a href="{{url('pokir/dashboard/keuangan')}}" class="fz25 cdark">
                        <label>Keuangan</label>
                        <span class="mdi mdi-currency-usd"></span>
                    </a>
                </li>
                <li>
                    <a href="{{url('pokir/dashboard/kamusUsulan')}}" class="fz25 cdark">
                        <label>Kamus Usulan</label>
                        <span class="mdi mdi-database-search"></span>
                    </a>
                </li>
                <li>
                    <a href="{{url('pokir/dashboard/dataLingkungan')}}" class="fz25 cdark">
                        <label>Data Lingkungan </label>
                        <span class="mdi mdi-map-marker-path"></span>
                    </a>
                </li>
                <li>
                    <a href="{{url('pokir/dashboard/daftarUsulan/0')}}" class="fz25 cdark">
                        <label>Daftar Usulan</label>
                        <span class="mdi mdi-clipboard-list"></span>
                    </a>
                </li>
                <li>
                    <a href="{{url('pokir/dashboard/akun')}}" class="fz25 cdark">
                        <label>Akun</label>
                        <span class="mdi mdi-account"></span>
                    </a>
                </li>
                @if($dt['level']>5)
                <li>
                    <a href="{{url('pokir/dashboard/timer')}}" class="fz25 cdark">
                        <label>Timer</label>
                        <span class="mdi mdi-clock-time-eight-outline"></span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <div class="container2">
            <div class="headerPage1">
                <div class="title">
                    <span class="mdi mdi-@yield('logo') fziconM @yield('blogo')"></span>
                    <div class="page">
                        <h2>@yield('page')</h2>
                        <span>@yield('pageDetail')</span>
                    </div>
                </div>
                <div class="flexR dnone">
                    <button class="btn6 bmuted clight">
                        <span class="mdi mdi-currency-usd  bprimary fziconM"></span>
                        <label class="" style="padding: 0px 20px 0px 0px !important;">
                            <b>Total Keuangan</b><br>
                            <label id="uangM">Rp. 0</label>
                         </label>
                    </button>
                    <button class="btn6 bmuted clight">
                        <span class="mdi mdi-currency-usd-off bdanger   fziconM"></span>
                        <label class="" style="padding: 0px 20px 0px 0px !important;">
                            <b>Pengeluaran</b><br>
                            <label id="uangK">Rp. 0</label>
                         </label>
                    </button>
                    <button class="btn6 bmuted clight">
                        <span class="mdi mdi-currency-usd bwarning  fziconM"></span>
                        <label class="" style="padding: 0px 20px 0px 0px !important;">
                            <b>Keuangan</b><br>
                            <label id="uangS">Rp. 0</label>
                         </label>
                    </button>
                </div>
            </div>
            @yield('form')
        </div>

        <footer class="w100p">
            <div  id="copyRight">
                <div class="judulProject">
                    <span class="mdi mdi-alpha-c-circle-outline bdanger cwhite "></span>
                    <h2 class="bdanger clight">E-POKIR 2023</h2>
                </div>
            </div>
            <div style="height: 50px; width: 100%;" class="bdark"></div>
        </footer>
        <dialog class="modal1 mw600px" id="dialog1">
        </dialog>
        <script src="/MFC/Dashboard/style.js"></script>
        @extends('Dasar.footer')
        @section('folder', @url('/MFC/'.$code.'/index.js'))
   </body>
</html>
