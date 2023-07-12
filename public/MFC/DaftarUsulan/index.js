function  _onload(){
    respon(); 
    _.ind = 0; 
    viewInfo();
    // console.log(_); 
}
function respon(v){
    if(v!=undefined){
        _.usulan=v; 
    }
    $('#viewData').html(setTabel());
    _btabelStart("dt");
}
function setTabel(){
    btnAction=[]; 
    if(_.timerAct){
        btnAction.push({ 
            clsBtn:`btn2 cwarning`
            ,func:"updData()"
            ,icon:`<span class="mdi mdi-lead-pencil fz25"></span>`
            ,title:"Perbarui"
        });
        btnAction.push({ 
            clsBtn:`btn2 cdanger`
            ,func:"del()"
            ,icon:`<span class="mdi mdi-archive-remove fz25"></span>`
            ,title:"Delete"
        });
    }
    return btabel({
            id:"dt",
            class:'',
            isi:_tabel(
                {
                    data:_.usulan,
                    no:1,
                    kolom:['nmDinas',"nmUsulan","volume",'satuan','harga$','volume*harga'],
                    namaKolom:["Dinas","Usulan",'Volume','satuan','Harga','Total'],
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
        idKusulan   :_.idKusulan,
        kdUser      :_.duser[_.ind].value,
        kdLing      :_inpDrop.selected, 
        volume      :$("#volume").val(),
        hargaT      :0,
        satuanT     :0,
        penerima    :$("#penerima").val(),
        rt          :$("#rt").val(),
        rw	        :$("#rw").val(),
        catatan	    :$("#catatan").val(),
        harga       :$("#harga").val(),
        satuan      :$("#satuan").val(),
    }
    if(_.jenis=='hibah'){
        param.hargaT = $("#harga").val();
        param.satuanT = $("#satuan").val();
    }
    const valid = validateParam(param);
    if(!valid.exc){
        return _toastE(valid.msg);
    }
    
    
    _post('/setwan/usulan/added',param).then(v=>{
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
        <div class="form1 bwhite" style="min-width: 500px !important;">
            <div class="header ${(kond? 'bprimary':'bwarning' )} cwhite">
                <h3>${(kond? 'Entri':'Perbarui' )} Usulan</h3>
                <button class="btn1 bdark" onclick="formActClose()">
                    <span class="mdi mdi-close-circle fz25 cdanger"></span>
                </button>
            </div>
            <div class="body ">  
                ${_inputDropdown({
                    cinput:'cdark',
                    clabel:'mw75px',
                    label:'Usulan',
                    idInput:'nmUsulan',
                    valInput:(kond? '':v.nmUsulan),
                    change:'changeSearchKamus',
                    iddropContent:'dropKamus',
                    option:getOptionKamus({value:''}), 
                    save:'MFC'
                })}
                <div id="subForm">
                </div>
                ${_inputDropdown({
                    cinput:'cdark',
                    clabel:'mw75px',
                    label:'Alamat',
                    idInput:'nmLing',
                    valInput:(kond? '':v.nmLing),
                    dt:_.cbLingkungan, 
                })}
                <div class="doubleInput">  
                    <div class="double">
                        <div class="labelInput1">
                            <label>RT</label>
                            <input type="text" class=" w80p" id="rt" value="${(kond? '' : delUndife(v.rt))}"/>
                        </div>
                        <div class="labelInput1">
                            <label>RW</label>
                            <input type="text" class=" w80p" id="rw"  value="${(kond? '' : delUndife(v.rw))}"/>
                        </div>
                    </div>
                </div>
                <div class="labelInput2 mtb10px Cblack">
                    <label class="mw75px">Catatan</label>
                    <input type="text" id="catatan" value="${(kond? '' : delUndife(v.catatan))}"/>
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


// 3 item sepaket jika bentuk data tidak ada value 
function changeSearchKamus(v){
    $('#dropKamus').html(getOptionKamus(v));
}
function selectKamusUsulan(ind){
    $(this).next().focus();
    $('#nmUsulan').val(_.kusulan[ind].nmUsulan); 
    $('#dropKamus').html(getOptionKamus({value:_.kusulan[ind].valueName})); 
    settingForm({
        id      :_.kusulan[ind].id,
        jenis   :_.kusulan[ind].jenis,
        harga   :_.kusulan[ind].harga,
        satuan  :_.kusulan[ind].satuan,
        jenis   :_.kusulan[ind].jenis,
    });    
}
function getOptionKamus(val){
    let _html=`<ul class="m0 over200px">`,fkond=false,valueName='';
    _.kusulan.forEach((v,i) => {
        if(v.valueName==undefined){
            valueName=v.nmUsulan+"<br>"+_$(v.harga)+" ("+v.satuan+")<br>"+v.nmDinas;
            _.kusulan[i].valueName=valueName;
        }else{
            valueName=_.kusulan[i].valueName;
        }
        fkond=_searchText(valueName,val.value);
        if(fkond){
            _html+=`
                <li style="cursor:pointer;" class="pwrap" 
                    onclick="selectKamusUsulan(${i})">${valueName}</li>
            `;
        }
    });
    return _html+=`</ul>`;;
}

function settingForm(v){
    _.idKusulan = v.id;
    _.jenis = v.jenis;
    $('#subForm').html(`
        <div class="labelInput2 mtb10px Cblack">
            <label class="mw75px">Volume</label>
            <input type="text" id="volume" value="${delUndife(v.volume)}"/>
        </div>
        <div class="labelInput2 mtb10px Cblack">
            <label class="mw75px">Satuan</label>
            <input type="text" id="satuan" disabled value="${delUndife(v.satuan)}"/>
        </div>
        <div class="labelInput2 mtb10px Cblack">
            <label class="mw75px">Harga</label>
            <input type="text" id="harga" disabled value="${delUndife(v.harga)}"/>
        </div>
        <div class="labelInput2 mtb10px Cblack" id="ipenerima">
            <label class="mw75px">Penerima</label>
            <input type="text" id="penerima" disabled value="${delUndife(v.penerima)}"/>
        </div>
    `); 
    
    switch (v.jenis) { 
        case 'umum':
            $('#penerima').prop('disabled', false); 
        break;
        case 'fisik':
            $('#ipenerima').css('display', 'none'); 
        break;
        case 'hibah':
            $('#harga').prop('disabled', false); 
            $('#satuan').prop('disabled', false); 
            $('#penerima').prop('disabled', false); 
        break;
    }
}

function updData(ind) {
    formActOpen();
    $('#itemFormLeft').html(_htmlForm({
        ind,
        nmUsulan:_.usulan[ind].nmUsulan,
        nmLing  :_.usulan[ind].nmLing,
        rt      :_.usulan[ind].rt,
        rw      :_.usulan[ind].rw, 
        catatan :_.usulan[ind].catatan, 
    }));
    // set data terpilih
    _inpDrop.selected=_.usulan[ind].kdLing;
    _.idKusulan=_.usulan[ind].idKusulan;

    indKusulan =_searchInd(_.kusulan,_.usulan[ind].idKusulan,['id']); 
    settingForm({   
        id      :_.kusulan[indKusulan].id,
        jenis   :_.kusulan[indKusulan].jenis,
        harga   :_.usulan[ind].harga,
        satuan  :_.usulan[ind].satuan,
        volume  :_.usulan[ind].volume,
        penerima:_.usulan[ind].penerima,
    });
    // $('#kdKec').val(_.lingkungan[ind].kdKec);
    // $('#kdDesa').html(_selectOption(getDesaSesuaiKec(_.lingkungan[ind].kdKec)));
    // $('#kdDesa').val(_.lingkungan[ind].kdDesa);
}
function _upded(ind) {
    const param ={
        xuser:_.xuser,
        kdUsulan    :_.usulan[ind].kdUsulan,
        kdUser      :_.usulan[ind].kdUser,
        idKusulan   :_.idKusulan, 
        paguIni     :_.usulan[ind].volume*_.usulan[ind].harga,
        kdLing      :_inpDrop.selected, 
        volume      :$("#volume").val(),
        hargaT      :0,
        satuanT     :0,
        penerima    :$("#penerima").val(),
        rt          :$("#rt").val(),
        rw	        :$("#rw").val(),
        catatan	    :$("#catatan").val(),
        harga       :$("#harga").val(),
        satuan      :$("#satuan").val(),
    }
    if(_.jenis=='hibah'){
        param.hargaT = $("#harga").val();
        param.satuanT = $("#satuan").val();
    }
    const valid = validateParam(param);
    if(!valid.exc){
        return _toastE(valid.msg);
    }
    // return console.log(param);
    _post('/setwan/usulan/upded',param).then(v=>{
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
function del(ind) {
    dialogOpen();
    $('#dialog1').html(
        _fkonfirmasi({
            // cform:'',
            cheader:'bdanger clight',
            header:`
                <div class="icon">
                    <span class="mdi mdi-currency-usd fz25"></span>
                    <h3>Konfirmasi</h3>
                </div>
            `,
            // cbody:'',
            body:'<p>apa benar ingin menghapus data ini ?</p>',
            // cfooter:'',
            footer:`
                <div class="btnGroup">
                    <button class="btn2 bmuted clight" onclick="dialogClose()">Close</button>
                    <button class="btn2 bdanger clight" onclick="_deled(${ind})">Hapus</button>
                </div>
            `,
        })
    );
    
}
function _deled(ind){
    const param ={
        kdUsulan    :_.usulan[ind].kdUsulan,
        kdUser      :_.usulan[ind].kdUser,
        xuser:_.xuser,
    }
    
    // return console.log(param);
    _post('/setwan/usulan/deled',param).then(v=>{
        if(v.exc){
            dialogClose()
            return respon(v.data);
        } 
        return _toast({
            bg:'e',
            msg:v.msg
        })
    });
}


function validateParam(param){
    if(_isNull(_.jenis)) return _resF('tambahkan Usulan !!!');
    if(_.jenis=='hibah'){ 
        if(_isNull(param.hargaT)) return _resF('tambahkan harga !!!');
        if(_isNull(param.satuanT)) return _resF('tambahkan Satuan !!!');
        if(_isNull(param.penerima)) return _resF('tambahkan penerima !!!');
    }
    if(_isNull(param.volume)) return _resF('tambahkan volume !!!');
    if(_.jenis=='umum'){
        if(_isNull(param.penerima)) return _resF('tambahkan penerima !!!');
    }
    if(_isNull(param.kdLing)) return _resF('tambahkan Alamat !!!');

    return _resT();
}


function viewInfo(){
    $('#viewInfo').html(`
        <div class="justifyEnd">
            <div class="w50p ptb10px">
                ${_inputDropdown({ 
                    cinput:'bdark clight ',
                    clabel:'mw75px',
                    label:'Username',
                    idInput:'anggota',
                    valInput:delUndife(_.duser[_.ind].valueName),
                    change:'changeAnggota',
                    iddropContent:'dropAnggota',
                    option:_inputDropdownItem({value:''},_.duser,'selectUser'), 
                    save:'MFC'
                })}
            </div>
        </div>
    `);
}
function changeAnggota(v){ 
    $('#dropAnggota').html(_inputDropdownItem(v,_.duser,'selectUser')); 
}
function selectUser(ind){
    _redirectOpen("/setwan/dashboard/daftarUsulan/"+_.duser[ind].value);
}
