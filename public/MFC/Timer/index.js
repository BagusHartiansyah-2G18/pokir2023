function  _onload(){
    respon();
    // console.log(_);
    // const selected = [dtgroup[Math.floor(Math.random() * (8 - 1) + 1)]];
    // ${Math.floor(Math.random() * (10 - 1) + 1)}
}
function respon(v){
    if(v!=undefined){
        _.timer=v;
    }
    $('#viewData').html(setTabel());
    _btabelStart("dt");
}
function setTabel(){
    btnAction=[];
    btnAction.push({
        clsBtn:`btn2 cwarning`
        ,func:"updData()"
        ,icon:`<span class="material-icons">edit</span>`
        ,title:"Perbarui"
    });
    btnAction.push({
        clsBtn:`btn2 cdanger`
        ,func:"deled()"
        ,icon:`<span class="material-icons">delete</span>`
        ,title:"Perbarui"
    });
    return btabel({
            id:"dt",
            class:'',
            isi:_tabel(
                {
                    data:_.timer,
                    no:1,
                    kolom:["judul","dateS&timeS",'dateE&timeE','keterangan','aktif'],
                    namaKolom:["Judul","Start",'Akhir','Keterangan','Status'],
                    action:btnAction
                })
        });
}
function _addForm() {
    formActOpen();
    $('#itemFormLeft').html(_htmlForm());
}
function _added(){
    const param ={
        xuser:_.xuser,
        judul:$("#judul").val(),
        dateS:$("#dateS").val(),
        timeS:$("#timeS").val(),
        dateE:$("#dateE").val(),
        timeE:$("#timeE").val(),
        keterangan:($("#keterangan").val().length==0? '-':$("#keterangan").val()),
    }

    // return console.log(param);
    _post('/pokir/timer/added',param).then(v=>{
        if(v.exc){
            _addForm();
            return respon(v.data);
        }
        return _toast({
            bg:'e',
            msg:v.msg
        })
    });
}
function _htmlForm(v) {
    const kond=(v==undefined? true:false);
    return `
        <div class="form1 bwhite">
            <div class="header ${(kond? 'bprimary':'bwarning' )} cwhite">
                <h3>${(kond? 'Entri':'Perbarui' )} Timer</h3>
                <button class="btn1 bdark" onclick="formActClose()">
                    <span class="mdi mdi-close-circle fz25 cdanger"></span>
                </button>
            </div>
            <div class="body ">
                <div class="labelInput2 mtb10px Cblack">
                    <label class="">Judul</label>
                    <input type="text" id="judul" value="${(kond? '':v.judul )}"/>
                </div>
                <div class="doubleInput">
                    <label class="">Tanggal Mulai</label>
                    <div class="double">
                        <div class="labelInput1">
                            <label>Date</label>
                            <input type="date" min="2022-01-01" max="2025-12-31" class="borderB" id="dateS" value="${(kond? '':v.dateS )}"/>
                        </div>
                        <div class="labelInput1">
                            <label>Time</label>
                            <input type="time" class="borderB" id="timeS"  value="${(kond? '':v.timeS )}"/>
                        </div>
                    </div>
                </div>
                <div class="doubleInput">
                    <label>Tanggal Berakhir</label>
                    <div class="double">
                        <div class="labelInput1">
                            <label>Date</label>
                            <input type="date" min="2022-01-01" max="2025-12-31" class="borderB" id="dateE"  value="${(kond? '':v.dateE )}"/>
                        </div>
                        <div class="labelInput1">
                            <label>Time</label>
                            <input type="time" class="borderB" id="timeE"  value="${(kond? '':v.timeE )}"/>
                        </div>
                    </div>
                </div>
                <div class="labelInput2 mtb10px Cblack">
                    <label class="">Keterangan</label>
                    <input type="text" id="keterangan" value="${(kond? '':v.keterangan )}"/>
                </div>
            </div>
            <div class="footer posEnd">
                <div class="btnGroup">
                    <button class="btn2 bmuted clight" onclick="formActClose()">close</button>
                    <button class="btn2  ${(kond? 'bprimary clight':'bwarning cdark' )}" onclick="${(kond? '_added()': `_upded(${v.ind})` )}">${(kond? 'Entri':'Perbarui' )}</button>
                </div>
            </div>
        </div>
    `;
}

function updData(ind) {
    if(!Number(_.timer[ind].aktif)){
        return _toast({
            bg:'e',
            msg:'Data sudah tidak aktif',
        })
    }
    formActOpen();
    $('#itemFormLeft').html(_htmlForm({
        ind,
        judul :_.timer[ind].judul,
        dateS :_.timer[ind].dateS,
        timeS :_.timer[ind].timeS,
        dateE :_.timer[ind].dateE,
        timeE :_.timer[ind].timeE,
        keterangan   :_.timer[ind].keterangan,
    }));
}
function _upded(ind) {
    const param ={
        id:_.timer[ind].id,
        xuser:_.xuser,
        judul:$("#judul").val(),
        dateS:$("#dateS").val(),
        timeS:$("#timeS").val(),
        dateE:$("#dateE").val(),
        timeE:$("#timeE").val(),
        keterangan:($("#keterangan").val().length==0? '-':$("#keterangan").val()),
    }

    // return console.log(param);
    _post('/pokir/timer/upded',param).then(v=>{
        if(v.exc){
            formActClose();
            return respon(v.data);
        }
        return _toast({
            bg:'e',
            msg:v.msg
        })
    });
}
function deled(ind) {
    const param ={
        id:_.timer[ind].id,
        xuser:_.xuser,
    }

    // return console.log(param);
    _post('/pokir/timer/deled',param).then(v=>{
        if(v.exc){
            return respon(v.data);
        }
        return _toast({
            bg:'e',
            msg:v.msg
        })
    });
}
