function  _onload(){
    respon(); 
}

function respon(v){
    if(v!=undefined){
        _.kamus=v; 
    }
    $('#viewData').html(setTabel());
    _btabelStart("dt");
}
function setTabel(){
    btnAction=[];
    if(_.level>1){
        btnAction.push({ 
            clsBtn:`btn2 cwarning`
            ,func:"updData()"
            ,icon:`<span class="material-icons">edit</span>`
            ,title:"Perbarui"
        });
        btnAction.push({ 
            clsBtn:`btn2 cdanger`
            ,func:"del()"
            ,icon:`<span class="material-icons">delete</span>`
            ,title:"Perbarui"
        });
    }
    return btabel({
            id:"dt",
            class:'',
            isi:_tabel(
                {
                    data:_.kamus,
                    no:1,
                    kolom:['nmDinas',"nmUsulan","satuan",'harga','jenis'],
                    namaKolom:["Dinas","Uraian","satuan",'harga','jenis'],
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
        nmUsulan:$("#nmUsulan").val(),
        satuan  :$("#satuan").val(), 
        harga   :$("#harga").val(), 
        jenis   :$("#jenis").val(),
        kdDinas :_inpDrop.selected,
    }
    
    // return console.log(param);
    _post('/setwan/kamus/added',param).then(v=>{
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
                <h3>${(kond? 'Entri':'Perbarui' )} Kamus Usulan</h3>
                <button class="btn1 bdark" onclick="formActClose()">
                    <span class="mdi mdi-close-circle fz25 cdanger"></span>
                </button>
            </div>
            <div class="body ">  
                <div class="labelInput2 mtb10px Cblack">
                    <label class="mw75px">Uraian</label>
                    <input type="text" id="nmUsulan" value="${(kond? '':v.nmUsulan )}"/>
                </div>
                <div class="labelInput2 mtb10px Cblack">
                    <label class="mw75px">Satuan</label>
                    <input type="text" id="satuan" value="${(kond? '':v.satuan )}"/>
                </div>
                <div class="labelInput2 mtb10px Cblack">
                    <label class="mw75px">Harga</label>
                    <input type="number" id="harga" value="${(kond? '':v.harga )}"/>
                </div>
                <div class="labelInput2 mtb10px Cblack">
                    <label class="mw75px">Jenis</label>
                    <select id="jenis"  value="${(kond? '':v.jenis )}">
                        <option value="umum">umum</option>
                        <option value="fisik">fisik</option>
                        <option value="hibah">hibah</option>
                    </select>
                </div>
                ${_inputDropdown({
                    cinput:'cdark',
                    clabel:'mw75px',
                    label:'Dinas',
                    idInput:'nmDinas',
                    valInput:(kond? '':v.nmDinas),
                    dt:_.dinas, 
                })}
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
    formActOpen();
    $('#itemFormLeft').html(_htmlForm({
        ind,
        nmUsulan :_.kamus[ind].nmUsulan,
        satuan  :_.kamus[ind].satuan,
        harga   :_.kamus[ind].harga,
        jenis   :_.kamus[ind].jenis, 
        nmDinas :_.kamus[ind].nmDinas,
    }));
    $('#jenis').val(_.kamus[ind].jenis);
    _inpDrop.selected = _.kamus[ind].kdDinas;
}
function _upded(ind) {
    const param ={
        id  :_.kamus[ind].id,
        xuser:_.xuser,
        nmUsulan:$("#nmUsulan").val(),
        satuan  :$("#satuan").val(), 
        harga   :$("#harga").val(), 
        jenis   :$("#jenis").val(),
        kdDinas :_inpDrop.selected,
    }
    
    // return console.log(param);
    _post('/setwan/kamus/upded',param).then(v=>{
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
        id  :_.kamus[ind].id,
        xuser:_.xuser,
    }
    
    // return console.log(param);
    _post('/setwan/kamus/deled',param).then(v=>{
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