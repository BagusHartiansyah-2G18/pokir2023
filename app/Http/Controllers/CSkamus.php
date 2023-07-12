<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Hdb;
use Illuminate\Support\Facades\DB;

class CSkamus extends Controller
{
    public function added(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'nmUsulan'=> 'required',
                'satuan'=> 'required',
                'harga'=> 'required',
                'jenis'=> 'required', 
                'kdDinas'=> 'required', 
            ]);
            if(
                Hdb::addKamusUsulan([ 
                    $request->nmUsulan,
                    $request->satuan,
                    $request->harga,
                    $request->kdDinas,
                    $request->jenis
                ])
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::getKamusUsulan()
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
                'nmUsulan'=> 'required',
                'satuan'=> 'required',
                'harga'=> 'required',
                'jenis'=> 'required', 
                'kdDinas'=> 'required', 
                'id'    => 'required', 
            ]);
            if(
                DB::table('kamus_usulan')
                ->where('id',$request->id)
                ->update([
                    'nmUsulan' => $request->nmUsulan,
                    'satuan' => $request->satuan,
                    'harga' => $request->harga,
                    'jenis' => $request->jenis,
                    'kdDinas' => $request->kdDinas,
                ])
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::getKamusUsulan()
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
                'id'=> 'required',
            ]);
            if(
                DB::table('kamus_usulan')
                ->where('id',$request->id)
                ->delete()
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::getKamusUsulan()
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
            $user =$request->session()->get('duser');
            if($user->kdJaba==1){
                return [
                    "ex"=>false,
                    "msg"=>"can't execute !!!"
                ];
            }
            if(base64_encode($user->kdUser)==$request->xuser){
                return [
                    "ex"=>true,
                    "sess"=>$user
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
