<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" id="viewport" content="width = 639, height = device-height, maximum scale = 1.0, minimum-scale = 1.0">
        <title>SETWAN</title>
        <link rel="stylesheet" href="{{ url('/style/css/output.css')}}"/>
        <link rel="stylesheet" href="{{ url('MFC/library/MaterialDesignIcons6/css/materialdesignicons.min.css')}}";>
        @extends('Dasar.head') 
    </head>
    <body id="mfc">
        <div class="wrapLogin2">
            <div class="wrap bdark clight">
                <div class="logo">
                    <span class="mdi mdi-web cinfo fziconR2 mdi-spin"></span>
                </div>  
            </div>
            <div class="login blight">
                <div class="wrap">
                    <div class="nmApp"><p>Sistem Registrasi SETWAN</p> </div>
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
    </body>
    @extends('Dasar.footer') 
    @section('folder', @url('/MFC/'.$code.'/index.js'))
</html>