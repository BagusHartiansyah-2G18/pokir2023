<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Mtimer;
use Illuminate\Http\Request;
class CStimer extends Controller
{
    public function added(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'judul'=> 'required',
                'dateS'=> 'required',
                'timeS'=> 'required',
                'dateE'=> 'required',
                'timeE'=> 'required',
            ]);
            $timer = new Mtimer;
            $timer->judul = $request->judul;
            $timer->dateS = $request->dateS;
            $timer->timeS = $request->timeS;
            $timer->dateE = $request->dateE;
            $timer->timeE = $request->timeE;
            $timer->keterangan = $request->keterangan;
            $timer->kdUser = $request->xuser;
            DB::table('timer')->update(['aktif'=>0]);
            $timer->save();
            
            return response()->json([
                'exc' => true,
                'data' => Mtimer::all()
            ], 200);
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 401);
    }
    public function upded(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'judul'=> 'required',
                'dateS'=> 'required',
                'timeS'=> 'required',
                'dateE'=> 'required',
                'timeE'=> 'required',
                'id'=> 'required',
            ]);
            $timer = Mtimer::find($request->id);
            $timer->judul = $request->judul;
            $timer->dateS = $request->dateS;
            $timer->timeS = $request->timeS;
            $timer->dateE = $request->dateE;
            $timer->timeE = $request->timeE;
            $timer->keterangan = $request->keterangan;
            $timer->kdUser = $request->xuser;
            $timer->update();
            return response()->json([
                'exc' => true,
                'data' => Mtimer::all()
            ], 200);
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 401);
    }
    public function deled(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'id'=> 'required',
            ]);
            $timer = Mtimer::find($request->id);
            $timer->delete();
            return response()->json([
                'exc' => true,
                'data' => Mtimer::all()
            ], 200);
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 401);
    }
    function portal($request){
        if($request->session()->has('duser')){
            if(base64_encode($request->session()->get('duser')->kdUser)==$request->xuser){
                return [
                    "ex"=>true
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
