<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helper\Hdb;
class CSkeuangan extends Controller
{
    public function entriUang(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'kdPenerima'=> 'required',
                'nominal'   => 'required', 
            ]);
            if($cek['sess']->kdJaba<3){
                if($request->kdPenerima==$cek['sess']->kdUser){
                    return response()->json([
                        'exc' => false,
                        'msg' => "transfer terlarang !!!"
                    ], 200);
                }
                $sisaUang =Hdb::gsisaUang($cek['sess']->kdUser);
                if($sisaUang<0 || $sisaUang<$request->nominal){
                    return response()->json([
                        'exc' => false,
                        'msg' => "Keuangan anda tidak cukup !!!"
                    ], 200);
                }
            }
            $kdUang = Hdb::glastkdUang($cek['sess']->kdUser);  
            if(count($kdUang)==0){
                $kdUang=1;
            }else{
                $kdUang=$kdUang->first()->kdUang+1;
            }
            if(
                Hdb::addKeuangan([
                    $kdUang,
                    $cek['sess']->kdUser,
                    $request->kdPenerima,
                    $request->nominal,
                    (strlen($request->keterangan)==0?'-':$request->keterangan),
                ])
            ){
                return response()->json([
                    'exc' => true,
                    'data'=>Hdb::getKeuangan($cek['sess']->kdUser)
                ], 200);
            }
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 200);
    }
    public function tariKembaliUang(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'kdUang'=> 'required',
                'kdPengirim'=> 'required',
                'kdPenerima'=> 'required',
                'nominal'   => 'required', 
            ]);

            $sisaUang = Hdb::gsisaUang($request->kdPenerima); 
            if($sisaUang<$request->nominal){
                return response()->json([
                    'exc' => false,
                    'msg' => "Keuangan telah digunakan !!!"
                ], 200);
            }
            
            if(Hdb::batalkanTransfer($request->kdUang,$request->kdPengirim)){
                return response()->json([
                    'exc' => true,
                    'data'=>Hdb::getKeuangan($cek['sess']->kdUser)
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
