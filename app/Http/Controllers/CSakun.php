<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
class CSakun extends Controller{
    public function updPass(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'passO'=> 'required',
                'passN'=> 'required',
            ]);
            DB::table('users')
                ->where('kdUser',base64_decode($request->xuser))
                ->where('password',$request->passO)
                ->update(['password'=>$request->passN]); 
                // 
            return response()->json([
                'exc' => true,
            ], 200);
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 401);
    }
    public function added(Request $request){
        $cek = $this->portal($request); 
        if($cek['ex']){
            $request->validate([
                'nama'=> 'required',
                'username'=> 'required',
                'password'=> 'required',
                'kdJaba'=> 'required', 
            ]);
            $timer = new User;
            $timer->name = $request->nama;
            $timer->kdUser = $request->username;
            $timer->username = $request->username;
            $timer->password = $request->password;
            $timer->kdJaba = $request->kdJaba;
            $timer->email =$request->username.'-';
            $timer->save(); 
            return response()->json([
                'exc' => true,
                'data' => DB::table('users')
                            ->selectRaw('kdUser,name,password,kdJaba')
                            ->where('kdJaba','<=',$request->session()->get('duser')->kdJaba)
                            ->get()
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
                'nama'=> 'required',
                'username'=> 'required',
                'password'=> 'required',
                'kdJaba'=> 'required', 
            ]);
            DB::table('users')
                ->where('kdUser',$request->kdUser)
                ->update([
                    'name' => $request->nama,
                    'kdUser' => $request->username,
                    'username' => $request->username,
                    'password' => $request->password,
                    'kdJaba' => $request->kdJaba,
                ]); 
            return response()->json([
                'exc' => true,
                'data' => DB::table('users')
                            ->selectRaw('kdUser,name,password,kdJaba')
                            ->where('kdJaba','<=',$request->session()->get('duser')->kdJaba)
                            ->get()
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
                'kdUser'=> 'required',
            ]);
            DB::table('users')
                ->where('kdUser',$request->kdUser)
                ->delete(); 
            return response()->json([
                'exc' => true,
                'data' => DB::table('users')
                        ->selectRaw('kdUser,name,password,kdJaba')
                        ->where('kdJaba','<=',$request->session()->get('duser')->kdJaba)
                        ->get()
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
