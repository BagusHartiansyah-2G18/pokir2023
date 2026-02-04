<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" id="viewport" content="width = 639, height = device-height, maximum scale = 1.0, minimum-scale = 1.0">
        <title>E - POKIR</title>
        <link rel="stylesheet" href="{{ url('/style/css/output.css')}}"/>
        <link rel="stylesheet" href="{{ url('MFC/library/MaterialDesignIcons6/css/materialdesignicons.min.css')}}";>
        @extends('Dasar.head')
    </head>
    <body id="mfc">
        <div class="wrapLogin1 mh650p">
            <div class="wrap bdark clight">
                <div class="logo">
                    <img src="/logo/ksb.png" />
                </div>
                <div>
                    <h2>BAPPEDA</h2>
                    <p>Badan Perencanaan Pembangunan Daerah</p>
                </div>
                <div class="subitem">
                    <div class="" id="kanan">
                        <span class="mdi mdi-login cinfo"></span>
                    </div>
                    <div class="binfo" id="text"><span class="title"> Login Sistem</span></div>
                </div>
            </div>
            <div class="login blight">
                <div class="wrap">
                    <div class="nmApp">
                        <!-- <img src="/logo/ksb.png" height="100px"/> -->
                        <p>E - POKIR</p>
                    </div>
                    <div class="form">
                        <div class="labelInput2 bdark clight">
                            <label>Username</label>
                            <input type="text" id="username" />
                        </div>
                        <div class="labelInput2 bdark clight">
                            <label>Password</label>
                            <input type="password" id="password" />
                        </div>
                        <button class="btn1 wmax bprimary clight" id="blogin">Login</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flexC bmuted">
            <div class="flexR algI m0auto pwrap">
                <h2 class="tjudul clight fziconS">
                    Sumbawa Barat
                    <span class="mdi mdi-copyright cdanger "></span>
                    2023
                </h2>
            </div>
        </div>
    </body>
    @extends('Dasar.footer')
    @section('folder', @url('/MFC/'.$code.'/index.js'))
</html>
