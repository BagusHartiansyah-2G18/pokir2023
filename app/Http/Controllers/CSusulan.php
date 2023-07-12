<?php

namespace App\Http\Controllers;

use App\Helper\Hdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CSusulan extends Controller
{
    public function added(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'idKusulan'=> 'required',
                'kdUser'=> 'required',
                'kdLing'=> 'required',
                'volume'=> 'required',
                'hargaT'=> 'required', 
                'satuanT'=> 'required', 
            ]);
            $sisaUang = Hdb::gsisaUang($request->kdUser);    
            if($sisaUang<($request->volume*$request->harga)){
                return response()->json([
                    'exc' => false,
                    'msg' => "Keuangan anda tidak mencukupi !!!"
                ], 200);
            }
            if(
                Hdb::addUsulan([ 
                    1,
                    $request->kdUser,
                    $request->idKusulan,
                    $request->kdLing,
                    $request->volume,
                    $request->hargaT,
                    $request->satuanT,
                    $request->penerima,
                    $request->rt,
                    $request->rw,
                    $request->catatan,
                ])
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::gdaftarUsulan($request->kdUser)
                ], 200);
            }
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 200);
    }
    public function upded(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'kdUsulan'=> 'required',
                'idKusulan'=> 'required',
                'kdUser'=> 'required',
                'kdLing'=> 'required',
                'volume'=> 'required',
                'hargaT'=> 'required', 
                'satuanT'=> 'required', 
                'paguIni'=> 'required', 
            ]);
            $sisaUang = Hdb::gsisaUang($request->kdUser);  
            // return print_r($sisaUang);
            if(($sisaUang+$request->paguIni)<($request->volume*$request->harga)){
                return response()->json([
                    'exc' => false,
                    'msg' => "Keuangan anda tidak mencukupi !!!"
                ], 200);
            }
            if(
                DB::table('daftar_usulan')
                ->where('kdUsulan',$request->kdUsulan)
                ->where('kdUser',$request->kdUser)
                ->update([
                    'idKusulan' => $request->idKusulan,
                    'kdLing' => $request->kdLing,
                    'volume' => $request->volume,
                    'hargaT' => $request->hargaT,
                    'satuanT' => $request->satuanT,

                    'penerima' => $request->penerima,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'catatan' => $request->catatan, 
                ])
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::gdaftarUsulan($request->kdUser)
                ], 200);
            }
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 200);
    }
    public function deled(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'kdUsulan'=> 'required',
                'kdUser'=> 'required',
            ]);
            if(
                DB::table('daftar_usulan')
                ->where('kdUsulan',$request->kdUsulan)
                ->where('kdUser',$request->kdUser)
                ->delete()
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::gdaftarUsulan($request->kdUser)
                ], 200);
            } 
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 200);
    }
    function portal($request){
        if($request->session()->has('duser')){
            if(base64_encode($request->session()->get('duser')->kdUser)==$request->xuser){
                return [
                    "ex"=>true,
                    "sess"=>$request->session()->get('duser')
                ];
            }
            return [
                "ex"=>false,
                "msg"=>"request not from user !!!"
            ];
        }
        return [
            "ex"=>false,
            "msg"=>"User not fount !!!"
        ];
    }
}
