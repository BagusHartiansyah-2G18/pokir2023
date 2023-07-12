<?php

namespace App\Http\Controllers;

use App\Helper\Hdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CSlingkungan extends Controller
{
    public function added(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'nmLing'=> 'required',
                'kdKec'=> 'required',
                'kdDesa'=> 'required',
            ]);
            if(
                Hdb::addLingkungan([ 
                    $request->nmLing,
                    $request->kdKec,
                    $request->kdDesa
                ])
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::getLingkungan()
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
                'kdLing'=> 'required',
                'kdKecx'=> 'required',
                'kdDesax'=> 'required',
                'nmLing'=> 'required', 
                'kdKec' => 'required', 
                'kdDesa'=> 'required', 
            ]); 
            if(
                DB::table('lingkungan')
                ->where('kdLing',$request->kdLing)
                ->where('kdKec',$request->kdKecx)
                ->where('kdDesa',$request->kdDesax)
                ->update([
                    'nmLing' => $request->nmLing,
                    'kdKec' => $request->kdKec,
                    'kdDesa' => $request->kdDesa
                ])
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::getLingkungan()
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
                'kdLing'=> 'required',
                'kdKec' => 'required', 
                'kdDesa'=> 'required',
            ]);
            if(
                DB::table('lingkungan')
                ->where('kdLing',$request->kdLing)
                ->where('kdKec',$request->kdKec)
                ->where('kdDesa',$request->kdDesa)
                ->delete()
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::getLingkungan()
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
