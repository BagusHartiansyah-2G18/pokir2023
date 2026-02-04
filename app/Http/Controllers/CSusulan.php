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
                'tahapan'=> 'required',
            ]);
            $sisaUang = Hdb::gsisaUang($request->kdUser);
            // if($sisaUang<($request->volume*$request->harga)){
            //     return response()->json([
            //         'exc' => false,
            //         'msg' => "Keuangan anda tidak mencukupi !!!"
            //     ], 200);
            // }
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
                    $request->tahapan, //11
                    $cek['tahun']
                ])
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::gdaftarUsulan($request->kdUser, $request->tahapan,$cek['tahun'])
                ], 200);
            }
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 200);
    }
    public function upded(Request $request){
        // return print_r($request);
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
                'tahapan'=> 'required',
            ]);
            $sisaUang = Hdb::gsisaUang($request->kdUser);
            // return print_r($sisaUang);
            // if(($sisaUang+$request->paguIni)<($request->volume*$request->harga)){
            //     return response()->json([
            //         'exc' => false,
            //         'msg' => "Keuangan anda tidak mencukupi !!!"
            //     ], 200);
            // }
            if(
                DB::table('daftar_usulan')
                ->where('kdUsulan',$request->kdUsulan)
                ->where('kdUser',$request->kdUser)
                ->where('tahapan',$request->tahapan)
                ->where('tahun',$cek['tahun'])
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
                    'data' => Hdb::gdaftarUsulan($request->kdUser, $request->tahapan,$cek['tahun'])
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
                'tahapan'=> 'required',
            ]);
            if(
                DB::table('daftar_usulan')
                ->where('kdUsulan',$request->kdUsulan)
                ->where('kdUser',$request->kdUser)
                ->where('tahapan',$request->tahapan)
                ->where('tahun',$cek['tahun'])
                ->delete()
            ){
                return response()->json([
                    'exc' => true,
                    'data' => Hdb::gdaftarUsulan($request->kdUser, $request->tahapan,$cek['tahun'])
                ], 200);
            }
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 200);
    }
    public function export(Request $request){
        $cek = $this->portal($request);
        if($cek['ex']){
            $user =$request->session()->get('duser');
            $timer = DB::table('timer')->where('aktif',1)->first();
            $tahapan = $timer->keterangan;

            $where = "where tahun ='".$cek['tahun']."'  and tahapan='".$tahapan."'";
            if($user->kdJaba == 1 ){
                $where .=" and kdUser ='".$user->kdUser."'";
            }elseif ($user->kdJaba >1 &&  $user->kdJaba<4){
                if($tahapan !=  $user->kdJaba){
                    return response()->json([
                        'exc' => false,
                        'msg' => "Tidak sesuai dengan aturan sistem"
                    ], 200);
                }
            }
            DB::statement(" insert into daftar_usulan
                (
                    kdUsulan, kdUser, idKusulan, kdLing,
                    volume, hargaT, satuanT, penerima, rt,
                    rw, catatan, created_at, updated_at, tahun, tahapan
                )
                (
                    select kdUsulan, kdUser, idKusulan, kdLing,
                    volume, hargaT, satuanT, penerima, rt,
                    rw, catatan, created_at, updated_at, tahun,
                    '".($tahapan+1)."' as tahapan
                    from daftar_usulan
                    ".$where."
                )
            ");

            DB::table('users')
                ->where('kdUser',$user->kdUser)
                ->update([
                    'act'=>0
                ]);
            return response()->json([
                'exc' => true,
                'data'=>[]
            ], 200);
        }
        return response()->json([
            'exc' => false,
            'msg' => $cek['msg']
        ], 200);
    }

    function portal($request){
        if($request->session()->has('duser')){
            if(base64_encode($request->session()->get('duser')->kdUser)==$request->xuser || $request->session()->get('duser')->kdJaba>1){
                return [
                    "ex"=>true,
                    "tahun"=>"2025",
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
