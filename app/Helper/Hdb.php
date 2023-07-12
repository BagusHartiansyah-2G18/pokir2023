<?php 
namespace App\Helper;
use Illuminate\Support\Facades\DB;
class Hdb {
    function glastkdUang($kdPengirim){ 
        return DB::table('keuangan')
            ->selectRaw('kdUang')
            ->where('kdPengirim','<=',$kdPengirim)
            ->orderBy('kdUang','desc')
            ->get();
    }
    function addKeuangan($v){ 
        return DB::insert("
            insert keuangan (kdUang, kdPengirim, kdPenerima, nominal, keterangan) values 
            (?, ?, ?, ?, ?)  
        ",$v); 
    }
    function getKeuangan($kdUser){ 
        return DB::select("
            select 
                a.kdUang, a.kdPengirim, a.kdPenerima, a.nominal, a.created_at, a.keterangan,
                (
                    select name from users where kdUser=a.kdPengirim limit 1
                ) as nmPengirim,
                (
                    select name from users where kdUser=a.kdPenerima limit 1
                ) as nmPenerima
            from keuangan a 
            where a.aktif=1 and a.kdPengirim ='".$kdUser."'   or
                a.kdPenerima ='".$kdUser."'
            order by a.created_at asc
        ");
    }
    function guangMasuk($kdUser){
        $uangM= DB::table('keuangan')
            ->selectRaw('sum(nominal) as total')
            ->where('kdPenerima',$kdUser)
            ->where('aktif','1')
            ->get()->first();  
        try {
            if(!(new static)->_cekEmpty($uangM['total'])){
                $uangM['total']=0;
            }
            return $uangM['total'];
        } catch (\Throwable $th) {
            if(!(new static)->_cekEmpty($uangM->total)){
                $uangM->total=0;
            }
            return $uangM->total;
        }
       
    }
    function guangKeluar($kdUser){
        $uangB=(new static)->guangBelanja($kdUser);
        $uangK= DB::table('keuangan')
                ->selectRaw('sum(nominal) as total')
                ->where('kdPengirim',$kdUser)
                ->where('aktif','1')
                ->get()->first();
        try {
            if(!(new static)->_cekEmpty($uangK['total'])){
                $uangK['total']=0;
            }
            return $uangK['total']+$uangB;
        } catch (\Throwable $th) {
            if(!(new static)->_cekEmpty($uangK->total)){
                $uangK->total=0;
            }
            return $uangK->total+$uangB;
        }
    }
    function guangBelanja($kdUser){
        $uangB= DB::select("
            select  
                sum(a.volume*
                case 
                    when a.hargaT=0 then b.harga
                    else a.hargaT
                end) as total
            from daftar_usulan a 
            join kamus_usulan b on
                a.idKusulan=b.id 
            where a.kdUser='".$kdUser."'
        ")[0];
        // return print_r($uangB);
        try {
            if(!(new static)->_cekEmpty($uangB['total'])){
                $uangB['total']=0;
            }
            return $uangB['total'];
        } catch (\Throwable $th) {
            if(!(new static)->_cekEmpty($uangB->total)){
                $uangB->total=0;
            }
            return $uangB->total;
        }
    }
    function glistUangBelanja($kdUser){
        $uangB= DB::select("
            select  
                (a.volume*
                case 
                    when a.hargaT=0 then b.harga
                    else a.hargaT
                end) as y
            from daftar_usulan a 
            join kamus_usulan b on
                a.idKusulan=b.id 
            where a.kdUser='".$kdUser."'
        ");
        // return print_r($uangB);
        return $uangB;
    }
    function gsisaUang($kdUser){
        $uangM=(new static)->guangMasuk($kdUser);
        $uangK=(new static)->guangKeluar($kdUser);
        // $uangB=(new static)->guangBelanja($kdUser);
        return $uangM-$uangK;
        // return [$uangM,$uangK,$uangB];
    }
    function batalkanTransfer($kduang,$kdPengirim){
        return DB::table('keuangan')
                ->where('kdUang',$kduang)
                ->where('kdPengirim',$kdPengirim)
                ->update(['aktif'=>0]);
    }
    function _cekEmpty($v){
        return (empty($v)=="");
        // $bool=empty($v);
        // if(strlen($bool)==1){
        //     return $bool;
        // }
        // return false;
    }
    //users
    function cbUsers($user){
        return DB::table('users')
            ->selectRaw('kdUser as value,name as valueName')
            ->where('kdJaba','<=',$user->kdJaba)
            ->where('kdUser','!=',$user->kdUser)
            ->get();
    }
    

    // kamus usulan
    function getKamusUsulan(){ 
        return DB::select("
            select 
                a.*,b.nmDinas
            from kamus_usulan a 
            join dinas b on
                    a.kdDinas=b.kdDinas 
        ");
    }
    function addKamusUsulan($v){ 
        return DB::insert("
            insert kamus_usulan (nmUsulan, satuan, harga, kdDinas, jenis) values 
            (?, ?, ?, ?, ?)  
        ",$v); 
    } 
    
    // lingkungan
    function getLingkungan(){
        // concat(a.kdLing,'|',b.kdDesa,'|',c.kdDinas) as kdLingx
        return DB::select("
            select 
                a.nmLing,a.kdLing,
                b.nmDesa,b.kdDesa,
                c.nmDinas,c.kdDinas as kdKec
            from lingkungan a 
            join desa b on
                a.kdDesa=b.kdDesa and
                a.kdKec = b.kdKec
            join dinas c on
                b.kdKec = c.kdDinas
        ");
    }
    function cbLingkungan(){ 
        return DB::select("
            select  
                concat(a.nmLing,', Desa. ',b.nmDesa,',',c.nmDinas) as valueName,
                concat(a.kdLing,'|',b.kdDesa,'|',c.kdDinas) as value
            from lingkungan a 
            join desa b on
                a.kdDesa=b.kdDesa and
                a.kdKec = b.kdKec
            join dinas c on
                b.kdKec = c.kdDinas
        ");
    }
    function addLingkungan($v){
        $kdLink = DB::table('lingkungan')
                    ->selectRaw(' kdLing ')
                    ->where('kdKec',$v[1])
                    ->where('kdDesa',$v[2])
                    ->orderBy('kdLing','desc')
                    ->get()->first();
        try {
            if(!(new static)->_cekEmpty($kdLink['kdLing'])){
                $kdLink=1;
            }
        } catch (\Throwable $th) {
            $kdLink=$kdLink->kdLing+1;
        }
        $v[3]=$kdLink;
        return DB::insert("
            insert lingkungan (nmLing,kdKec,kdDesa,kdLing) values 
            (?, ?, ?, ?)  
        ",$v); 
    }

    // dinas
    function cbDinas(){
        return DB::table('dinas')
            ->selectRaw('kdDinas as value,nmDinas as valueName')
            ->get();
    }

    // kecamatan
    function cbKec(){
        return DB::table('dinas')
            ->selectRaw('kdDinas as value,nmDinas as valueName')
            ->where('nmDinas','like','%kecamatan%')
            ->get();
    }
    function cbDesa(){
        return DB::table('desa')
            ->selectRaw('kdDesa as value,nmDesa as valueName, kdKec ')
            ->get();
    }

    //daftar usulan
    function gdaftarUsulan($kdUser){ 
        return DB::select("
            select  
                a.kdUsulan,a.kdUser,a.idKusulan,a.kdLing,a.volume,a.catatan,a.penerima,
                    a.rt,a.rw,
                case 
                    when a.hargaT=0 then b.harga
                    else a.hargaT
                end as harga,
                case 
                    when a.satuanT=0 then b.satuan
                    else a.satuanT
                end as satuan,
                b.nmUsulan,b.kdDinas,b.jenis,
                c.nmDinas,
                (
                    select  
                        concat(a1.nmLing,', Desa1. ',b1.nmDesa,',',c1.nmDinas) as valueName
                    from lingkungan a1 
                    join desa b1 on
                        a1.kdDesa=b1.kdDesa and
                        a1.kdKec = b1.kdKec
                    join dinas c1 on
                        b1.kdKec = c1.kdDinas
                    where concat(a1.kdLing,'|',b1.kdDesa,'|',c1.kdDinas)=a.kdLing
                ) as nmLing
            from daftar_usulan a 
            join kamus_usulan b on
                a.idKusulan=b.id
            join dinas c on
                b.kdDinas = c.kdDinas
            where a.kdUser='".$kdUser."'
        ");
    }
    function addUsulan($v){ 
        $kdUsulan = DB::table('daftar_usulan')
                    ->selectRaw(' kdUsulan ')
                    ->where('kdUser',$v[1]) 
                    ->orderBy('kdUsulan','desc')
                    ->get()->first();
        try {
            if(!(new static)->_cekEmpty($kdUsulan['kdUsulan'])){
                $kdUsulan=1;
            }
        } catch (\Throwable $th) {
            $kdUsulan=$kdUsulan->kdUsulan+1;
        }
        $v[0]=$kdUsulan;
        return DB::insert("
            INSERT INTO `daftar_usulan`(
                `kdUsulan`, `kdUser`, `idKusulan`, `kdLing`, 
                `volume`, `hargaT`, `satuanT`, `penerima`, 
                `rt`, `rw`, `catatan`
            ) VALUES 
            (
                ?, ?, ?, ?,
                ?, ?, ?, ?,
                ?, ?, ?
            )  
        ",$v); 
    } 
}

?>