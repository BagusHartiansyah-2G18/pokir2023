function  _onload(){
    respon();
}
function respon(v){
    if(v!=undefined){
        _.lingkungan=v;
    }
    $('#viewData').html(setTabel());
    _btabelStart("dt");
}
function setTabel(){
    btnAction=[];
    if(_.level>5){
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
                    data:_.lingkungan,
                    no:1,
                    kolom:["nmDinas","nmDesa",'nmLing'],
                    namaKolom:["Kecamatan","Desa",'Dusun'],
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
        nmLing    :$("#nmLing").val(),
        kdKec   :$("#kdKec").val(),
        kdDesa  :$("#kdDesa").val()
    }

    // return console.log(param);
    _post('/pokir/lingkungan/added',param).then(v=>{
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
                    <label class="mw75px">Dusun</label>
                    <input type="text" id="nmLing" value="${(kond? '':v.nmLing )}"/>
                </div>
                ${
                    _select({
                        c:'Cblack',
                        clabel:'mw75px',
                        label:'Kecamatan',
                        idSelect:'kdKec',
                        dt  :_.kec,
                        change:'changeKec(this)',
                    })+
                    _select({
                        c:'Cblack',
                        clabel:'mw75px',
                        label:'Desa',
                        idSelect:'kdDesa',
                        dt  :getDesaSesuaiKec(_.kec[0].value)
                    })
                }

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
function changeKec(v){
    $('#kdDesa').html(_selectOption(getDesaSesuaiKec(v.value)));
}
function getDesaSesuaiKec($kdKec){
    return _.desa.filter(v=>v.kdKec==$kdKec);
}
function updData(ind) {
    formActOpen();
    $('#itemFormLeft').html(_htmlForm({
        ind,
        nmLing  :_.lingkungan[ind].nmLing,
        kdKec   :_.lingkungan[ind].kdDinas,
        kdDesa  :_.lingkungan[ind].kdDesa,
    }));
    $('#kdKec').val(_.lingkungan[ind].kdKec);
    $('#kdDesa').html(_selectOption(getDesaSesuaiKec(_.lingkungan[ind].kdKec)));
    $('#kdDesa').val(_.lingkungan[ind].kdDesa);
}
function _upded(ind) {
    const param ={
        kdLing:_.lingkungan[ind].kdLing,
        kdKecx:_.lingkungan[ind].kdKec,
        kdDesax:_.lingkungan[ind].kdDesa,
        xuser:_.xuser,
        nmLing   :$("#nmLing").val(),
        kdKec   :$("#kdKec").val(),
        kdDesa  :$("#kdDesa").val()
    }

    // return console.log(param);
    _post('/pokir/lingkungan/upded',param).then(v=>{
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
        kdLing:_.lingkungan[ind].kdLing,
        kdKec:_.lingkungan[ind].kdKec,
        kdDesa:_.lingkungan[ind].kdDesa,
        xuser:_.xuser,
    }

    // return console.log(param);
    _post('/pokir/lingkungan/deled',param).then(v=>{
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
