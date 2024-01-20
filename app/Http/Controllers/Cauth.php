<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cauth extends Controller
{
    public function index(){
        // if($user = Auth::user()){
        //     if ($user->kdJaba==2) {
        //         return redirect()->intended(2);
        //     }elseif ($user->kdJaba==1){
        //         return redirect()->intended(1);
        //     }
        // }
        return view('Login.index')->with([
            'code'  =>'Login',
            'dt'    =>[]
        ]);
    }
    public function prosesLogin(Request $request){
        $validated =$request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $users = DB::table('users')->
            where('username',$validated['username'])->
            where('password',$validated['password'])->
            first();
        // return print_r(Auth::attempt($kridensil));
        // if (Auth::attempt($kridensil)) {
        //     $user = Auth::user();
        //     if ($user->kdJaba==2) {
        //         return redirect()->intended(2);
        //     }elseif ($user->kdJaba==1){
        //         return redirect()->intended(1);
        //     }
        //     return redirect()->intended('/');
        // }
        if(!empty($users->name)){
            $request->session()->put('duser',$users);
            return response()->json([
                'exc' => true
            ], 200);
        }
        return response()->json([
            'exc' => false,
            'msg' => 'Data tidak ditemukan !!!'
        ], 401);
        // return redirect('login')
        //         ->withInput()
        //         ->withErrors(['loginGagal'=>'data not found !!!']);

    }
    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('pokir');
    }
}
