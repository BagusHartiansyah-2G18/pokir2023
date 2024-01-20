<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Cadmin;
use \App\Http\Controllers\CStimer;
use \App\Http\Controllers\CSakun;
use \App\Http\Controllers\CSkeuangan;
use \App\Http\Controllers\CSkamus;
use \App\Http\Controllers\CSlingkungan;
use \App\Http\Controllers\CSusulan;
use \App\Http\Controllers\PdfGenerate;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('pokir','\App\Http\Controllers\Cauth@index')->name('login');
Route::post('pokir/prosesLogin','\App\Http\Controllers\Cauth@prosesLogin')->name('prosesLogin');
Route::get('pokir/logout','\App\Http\Controllers\Cauth@logout')->name('logout');

Route::controller(Cadmin::class)->name('dashboard.')->prefix('pokir/dashboard')->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/keuangan','keuangan')->name('keuangan');
    Route::get('/kamusUsulan','kamusUsulan')->name('kamusUsulan');
    Route::get('/dataLingkungan','dataLingkungan')->name('dataLingkungan');
    Route::get('/daftarUsulan/{id}','daftarUsulan')->name('daftarUsulan');
    Route::get('/akun','akun')->name('akun');
    Route::get('/timer','timer')->name('akun');
});
Route::controller(CStimer::class)->name('proses.')->prefix('pokir/timer')->group(function(){
    Route::post('/added','added')->name('added');
    Route::post('/upded','upded')->name('upded');
    Route::post('/deled','deled')->name('deled');
});
Route::controller(CSakun::class)->name('proses.')->prefix('pokir/akun')->group(function(){
    Route::post('/updPass','updPass')->name('updPass');
    Route::post('/added','added')->name('added');
    Route::post('/upded','upded')->name('upded');
    Route::post('/deled','deled')->name('deled');
});
Route::controller(CSkeuangan::class)->name('proses.')->prefix('pokir/keuangan')->group(function(){
    Route::post('/entriUang','entriUang')->name('entriUang');
    Route::post('/tariKembaliUang','tariKembaliUang')->name('tariKembaliUang');
});
Route::controller(CSkamus::class)->name('proses.')->prefix('pokir/kamus')->group(function(){
    Route::post('/added','added')->name('added');
    Route::post('/upded','upded')->name('upded');
    Route::post('/deled','deled')->name('deled');
});
Route::controller(CSlingkungan::class)->name('proses.')->prefix('pokir/lingkungan')->group(function(){
    Route::post('/added','added')->name('added');
    Route::post('/upded','upded')->name('upded');
    Route::post('/deled','deled')->name('deled');
});

Route::controller(CSusulan::class)->name('proses.')->prefix('pokir/usulan')->group(function(){
    Route::post('/added','added')->name('added');
    Route::post('/upded','upded')->name('upded');
    Route::post('/deled','deled')->name('deled');
    Route::post('/export','export')->name('export');
});

Route::controller(PdfGenerate::class)->name('pdf.')->prefix('pokir/pdf')->group(function(){
    Route::get('/getusulan/{kdUser}','getusulan')->name('getusulan');
});
