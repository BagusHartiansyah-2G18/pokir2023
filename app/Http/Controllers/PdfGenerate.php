<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Hdb;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class PdfGenerate extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    public function getUsulan($kdUser){
        $kdUser = base64_decode($kdUser);

        $user = DB::table('users')->where('kdUser',$kdUser)->first();
        $xtimer = DB::table('timer')->where('aktif',1)->first();
        $tahapan = $user->kdJaba;
        if($user->kdJaba>5){
            $tahapan = $xtimer->keterangan;
        }

        $tahun = "2025";
        $data = array();
        if($user->kdJaba == 1 ){
            $data = Hdb::gdaftarUsulan($kdUser,$tahapan,$tahun);
        }else{
            $data = Hdb::gdaftarUsulanNoUser($tahapan,$tahun);
        }



        // return print_r($data);
        $pdf = PDF::loadView('Pdf.usulan', [
            "data"=>$data
        ])
                ->setPaper('legal','portrait');
        return $pdf->stream('DaftarUsulan-t'.$tahapan.'.pdf');
    }
}
