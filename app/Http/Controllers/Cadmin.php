<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helper\Hdb;
use Illuminate\Support\Facades\Hash;

class Cadmin extends Controller{
    public function __construct(){
    }
    public function index(Request $request){
        if($request->session()->has('duser')){
            $user =$request->session()->get('duser');
            // return print_r(   $request->session()->token());
            // // $password = Hash::make('secret');
            // // $2y$10$mOdQAo5YaiOMdUdjqqFGM.o7vRhaA5XLIY4JLBgPtthyLEwJteXuK1
            // // yKh6aiPdjVVetU0F7BnuB46xit1PFrhI9ZT7I1YD1
            // // yKh6aiPdjVVetU0F7BnuB46xit1PFrhI9ZT7I1YD1
            // // return print_r($password);
            // $password = bcrypt('secret');
            // return print_r($password);

            return view('Dashboard.index')->with([
                'code'  =>'Dashboard',
                'dt'    =>array_merge(
                    [ 
                        'listBelanja'=> Hdb::glistUangBelanja($user->kdUser)
                    ],
                        $this->getData($request->session()->get('duser'))
                    )
            ]);
        }
        return redirect('setwan')->with('succsess','');
    }
    public function keuangan(Request $request){
        if($request->session()->has('duser')){ 
            $user =$request->session()->get('duser');
            $dusers= Hdb::cbUsers($user);
            $duang= Hdb::getKeuangan($user->kdUser); 
            return view('keuangan.index')->with([
                'code'  =>'keuangan',
                'dt'    =>array_merge(
                    [
                        'level'=>$user->kdJaba,
                        'duser'=>$dusers,
                        'duang'=>$duang
                    ],
                        $this->getData($request->session()->get('duser'))
                    )
            ]);
        }
        return redirect('setwan')->with('succsess','');
    }
    public function kamusUsulan(Request $request){
        if($request->session()->has('duser')){
            $user =$request->session()->get('duser');
            return view('kamusUsulan.index')->with([
                'code'  =>'kamusUsulan',
                'dt'    =>array_merge(
                    [
                        'dinas'=>Hdb::cbDinas(),
                        'level'=>$user->kdJaba,
                        'kamus' => Hdb::getKamusUsulan()
                    ],
                        $this->getData($request->session()->get('duser'))
                    )
            ]);
        }
        return redirect('setwan')->with('succsess','');
    }
    public function dataLingkungan(Request $request){
        if($request->session()->has('duser')){
            return view('DataLingkungan.index')->with([
                'code'  =>'DataLingkungan',
                'dt'    =>array_merge(
                    [ 
                        'desa'=>Hdb::cbDesa(),
                        'kec'=>Hdb::cbKec(),
                        'lingkungan'=>Hdb::getLingkungan(),
                    ],
                        $this->getData($request->session()->get('duser'))
                    )
            ]);
        }
        return redirect('setwan')->with('succsess','');
    }
    public function daftarUsulan(Request $request,$kdUser){ 
        if($request->session()->has('duser')){
            $user =$request->session()->get('duser');
            $dusers=[];
            $name = '';
            $kdJaba =$request->session()->get('duser')->kdJaba; 
            if($kdJaba>1){
                $dusers= DB::table('users')
                            ->selectRaw('kdUser as value, name as valueName ')
                            ->where('kdJaba',1)
                            ->get();
                if($kdUser==0){
                    $kdUser = $dusers[0]->value;
                    $name = $dusers[0]->valueName;
                }else{
                    $getName= DB::table('users')
                            ->selectRaw('kdUser as value, name as valueName ')
                            ->where('kdUser',$kdUser)
                            ->get();
                    $name = $getName[0]->valueName;
                }
            } else{
                $kdUser = $user->kdUser;
                $dusers= DB::table('users')
                            ->selectRaw('kdUser as value, name as valueName ')
                            ->where('kdUser',$user->kdUser)
                            ->get();
                $name = $dusers[0]->valueName;
            }
           
            return view('DaftarUsulan.index')->with([
                'code'  =>'DaftarUsulan',
                'dt'    =>array_merge(
                    [
                        'usulan'        =>Hdb::gdaftarUsulan($kdUser),
                        'duser'         =>$dusers,
                        'cbLingkungan'  => Hdb::cbLingkungan(),
                        'kusulan'       => Hdb::getKamusUsulan()
                    ],
                        $this->getData([
                            "kdUser" => $kdUser,
                            "kdJaba" => 1,
                            "name"  => $name,
                        ])
                    )
            ]);
        }
        return redirect('setwan')->with('succsess','');
    }
    public function akun(Request $request){
        if($request->session()->has('duser')){
            // return print_r(   $request->session()->token());
            $dusers=[];
            $kdJaba =$request->session()->get('duser')->kdJaba;
            if($kdJaba>1){
                $dusers= DB::table('users')
                            ->selectRaw('kdUser,name,password,kdJaba')
                            ->where('kdJaba','<=',$kdJaba)
                            ->get();
            } 
            return view('Akun.index')->with([
                'code'  =>'Akun',
                'dt'    =>array_merge(
                    [ 
                        "users" => $dusers,
                    ],
                        $this->getData($request->session()->get('duser'))
                    )
            ]);
        }
        return redirect('setwan')->with('succsess','');
    }
    public function timer(Request $request){
        $cek = $this->portal($request);
        if($cek['ex']){
            return view('Timer.index')->with([
                'code'  =>'Timer',
                'dt'    =>array_merge(
                    [
                        "timer"=>DB::table('timer')->get()
                    ],
                        $this->getData($request->session()->get('duser'))
                    )
            ]);
        }
        return redirect('setwan/dashboard')->with('succsess','');
    }
    function getData($v){ 
        try {
            return [
                "xuser"=>base64_encode($v->kdUser),
                "xtimer"=>DB::table('timer')->where('aktif',1)->first(),
                "nmUser"=>$v->name,
                "ketUser"=>"@pengguna",
                "uangM"=>Hdb::guangMasuk($v->kdUser),
                "uangK"=>Hdb::guangKeluar($v->kdUser),
                "uangS"=>Hdb::gsisaUang($v->kdUser),
                "level"=>$v->kdJaba,
            ];
        } catch (\Throwable $th) {
            return [
                "xuser"=>base64_encode($v['kdUser']),
                "xtimer"=>DB::table('timer')->where('aktif',1)->first(),
                "nmUser"=>$v['name'],
                "ketUser"=>"@pengguna",
                "uangM"=>Hdb::guangMasuk($v['kdUser']),
                "uangK"=>Hdb::guangKeluar($v['kdUser']),
                "uangS"=>Hdb::gsisaUang($v['kdUser']),
                "level"=>$v['kdJaba'],
            ];
        }
    }
    function portal($request){
        if($request->session()->has('duser')){
            $user= $request->session()->get('duser');
            if($user->kdJaba>1){
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
