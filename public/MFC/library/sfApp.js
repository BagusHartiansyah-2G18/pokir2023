function setUang(){
    if(_.level<3){
        $('#uangM').html(`Rp. ${_$(_.uangM)}`);
        $('#uangK').html(`Rp. ${_$(_.uangK)}`);
        $('#uangS').html(`Rp. ${_$(_.uangS)}`);
    }
}

function startSupportApp(){
    _.timerAct =false;
    if(!_isNull(_.xtimer)){ //timer action
        // 1. memastikan bahwa sudah masuk tanggal start dengan waktu sekarang
        let xdtimer = _hitungTanggal({
            dateE:_.xtimer.dateS,
            timeE:_.xtimer.timeS,
        });
        if(xdtimer.aktif){
            // 2. memastikan bahwa sudah belum lewat tanggal akhir nya dengan waktu sekarang
            xdtimer = _hitungTanggal({
                dateE:_.xtimer.dateE,
                timeE:_.xtimer.timeE,
            });
            if(!xdtimer.aktif){
                _.timerAct = true;
                _counterDonw({
                    dateE : _.xtimer.dateE ,
                    timeE :_.xtimer.timeE
                }).then(resp=>{
                    _.timerAct =false;
                });
            }
        }

    }

    _onload();
    if(_.timerAct || (_.level>1 & _code=='keuangan')){
        // console.log(_.duser);
        if(_.xtahapan && _.level!=2 && _.act && _.level!=3){
            $('#fbtnAdd').html(`
                <button class="btn2 blight" onclick="_addForm()">Form Entri</button>
            `);
        }
    }
    // set data keuangan
    setUang();
}
startSupportApp();
