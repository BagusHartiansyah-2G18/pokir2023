// support function library digunakan untuk libarry tambahan dari pengembangkan untuk menyelsaikan masalah
let _={},_html=``,
    uang = new Intl.NumberFormat('en-US',
            { 
                style: 'currency', 
                currency: 'USD',
                minimumFractionDigits: 3 
            }
        );
function _getKeyRay(data) {
    // digunakan untuk mendapatkan key dan judul 1 array yang didalamnya terdapat array
    ftam={
        key:[],
        judul:[]
    };
    try {// jika non array
        data[0].forEach((v,i) => {
            ftam.key.push(i);
            ftam.judul.push(v);
        });
    } catch (error) {
        
    }
    return ftam;
}
function _readExcel(id){
    // var input = document.getElementById(id)
    return new Promise(function(res){
        readXlsxFile(id.files[0], { dateFormat: 'MM/DD/YY' }).then(function(data) {
                res({
                    exec:true,
                    data:JSON.parse(JSON.stringify(data, null, 2))
                })},
            function (error) {
                res({
                    exec:false,
                    msg:error
                });
            }
        )
    })
    
}
function _valforQuery(val){
    val=String(val);
    split=val.split('"');
    splitx1=val.split("'");

    res="";
    for(a=0;a<split.length;a++){
        if(a>0){
            res+='"';
        }
        res+=split[a];
    }
    if(res!="" && splitx1.length==1){
        return "'"+res+"'";
    }
    res="";
    for(a=0;a<splitx1.length;a++){
        if(a>0){
            res+="'";
        }
        res+=splitx1[a];
    }
    return '"'+res+'"'.toString();
}
function _toast(v){
    // _toast({
    //     bg:'e',
    //     msg:'Maaf tester'
    // })
    toastr.options.timeOut = 1500; // 1.5s
    switch (v.bg) {
        case 'i':
            toastr.info(v.msg);
        break;
        case 'w':
            toastr.warning(v.msg);
        break;
        case 'e':
            toastr.error(v.msg);
        break;
        case 's':
            toastr.success(v.msg);
        break;
    }
}
function _toastE(v){
    return _toast({
        bg:'e',
        msg:v
    })
}
function _modalShow(id) {
    $('#modalEx'+id).modal("show"); 
}
function _modalHide(id) {
    $('#modalEx'+id).modal("hide"); 
}
function _swal(v){
    // _swal({
    //     type:true,
    //     title:'Error',
    //     text:'Terjadi kesalahan'
    // })
    switch (v.type) {
        case 'loading':
            return swal.fire({
                title:v.title,
                text:v.text,
                onOpen: function () {
                  swal.showLoading()
                }
            })
        break;
    }
}
function _$(val){
    var tam="";
    if(val==null || val=='null'){
        return '';
    }
    if(uang.format(val).substring(0,1)=="$"){
        // _log(uang.format(val).substring(1),"D")   
        tam=uang.format(val).substring(1);
    }else{
        tam=uang.format(val);
    }
    
    return tam.substring(0,tam.length-4);
}
function delUndife(lv){
    if(lv==undefined || lv==NaN){
        return '';
    }
    return lv;
}
function _isNull(val){
    if(val==null || val.length==0){
        return true;
    }
    return false;
}
function _searchIndCB(v,value){
    fdata=null;
    v.forEach((v1,i) => {
        if(v1.valueName==value || v1.value==value){
            fdata=i;
        }
    });
    return fdata;
}
function _searchInd(v,value,obj){
    // _searchInd(_.kusulan,_.usulan[ind].id,['kdUsulan']); 
    fdata=null;
    try {
        v.forEach((v1,i) => {
            try {
                obj.forEach((v2)=>{
                    if(v1[v2]==value){  
                        throw i;
                    }
                })
            } catch (error) { 
                throw error;   
            } 
        });
    } catch (error) {
        fdata = error;
    }
    return fdata;
}
function _searchText(data,search){ 
    if(data.trim().toUpperCase()==search.trim().toUpperCase()){
        return true;
    }
    var count=data.trim().toUpperCase().split(search.trim().toUpperCase());
    if(count.length>1){
        return true;
    }
    return false;
}
function _counterDonw(val){
    // let xdtimer = _hitungTanggal({
    //     dateE:val.dateS,
    //     timeE:val.timeS,
    // });  
    // if(xdtimer.aktif){
    //     xdtimer = _hitungTanggal({
    //         dateE:_.xtimer.dateE,
    //         timeE:_.xtimer.timeE,
    //     });  
    //     if(!xdtimer.aktif){
    //         var x = setInterval(function() {  
    //             const {aktif,days,hours,minutes,seconds} =_hitungTanggal({
    //                 dateE:_.xtimer.dateE,
    //                 timeE:_.xtimer.timeE,
    //             });
    //             _setValueCounterDown({aktif,days,hours,minutes,seconds});
    //             if (aktif) {
    //                 clearInterval(x);
    //                 setValueCounterDown({
    //                     days:0,hours:0,minutes:0,seconds:0,aktif:1
    //                 });
    //                 // document.getElementById("hari").innerHTML = "EXPIRED";
    //             }
    //         }, 1000);
    //     }
    // }
    return new Promise(resolve =>{
        setInterval(function() {  
            const {aktif,days,hours,minutes,seconds} =_hitungTanggal({
                dateE:val.dateE,
                timeE:val.timeE,
            });
            _setValueCounterDown({aktif,days,hours,minutes,seconds});
            if (aktif) {
                clearInterval(x);
                setValueCounterDown({
                    days:0,hours:0,minutes:0,seconds:0,aktif:1
                });
                resolve(false);
            }
        }, 1000);
    })
}
function _hitungTanggal(v) {
    const end = new Date(v.dateE+" "+v.timeE).getTime();
    const start = (v.dateS==undefined?new Date().getTime(): new Date(v.dateS+" "+v.timeS).getTime());
    
    var distance = end - start;

    const days    = Math.floor(distance / (1000 * 60 * 60 * 24)),
        hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
        minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
        seconds = Math.floor((distance % (1000 * 60)) / 1000);
    let aktif= 0;
    
    if(distance<0){
        aktif=1;
    }  
    return {days,hours,minutes,seconds,aktif}
}
function _setValueCounterDown(v){ 
    $('#hari').html(v.days +" hari");
    $('#jam').html(v.hours +" jam");
    $('#menit').html(v.minutes +" menit");
    $('#detik').html(v.seconds +" detik");
}

function _resF(v){
    return {
        exc :false,
        msg :v
    }
}
function _resT(){
    return {exc :true}
}