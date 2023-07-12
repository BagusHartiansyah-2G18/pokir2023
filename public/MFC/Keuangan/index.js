function  _onload(){
    respon(); 
}
function respon(v){
    if(v!=undefined){
        _.duang=v; 
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
            isi:_htmlTabel()
        });
}
function _htmlTabel(){
    btnAction=[];
    btnAction.push({ 
        clsBtn:`btn2 bdanger clight`
        ,func:"_cancelTransfer()"
        ,icon:`<span class="mdi mdi-archive-cancel fz25"></span>Batalkan`
        ,title:"Batalkan"
    }); 
    let _html=`
        <thead>
            <th>No</th>
            <th>Penerima</th>
            <th>Pengirim</th>
            <th>Nominal</th>
            <th>Catatan</th>
            <th>Total</th>
            <th>Date time</th>
            ${_.level==1?'':'<th>Action</th>'}
        </thead>
        <tbody>
    `;
    let hitung=0,exec=false;
    _.duang.forEach((v,i) => {
        exec=(v.kdPenerima===atob(_.xuser));
        if(exec){
            hitung+=parseFloat(v.nominal);
        }else{
            hitung-=parseFloat(v.nominal);
        }
        _html+=`
            <tr>
                <td>${i+1}</td>
                <td>${v.nmPenerima}</td>
                <td>${v.nmPengirim}</td>
                <td>${(exec? _$(v.nominal): `(${_$(v.nominal)})`)}</td>
                <td>${v.keterangan}</td> 
                <td>${_$(hitung)}</td> 
                <td>${v.created_at}</td> 
                ${_.level==1?'':(exec? '<td></td>':`<td>${_btnTabel(btnAction,i)}</td>`)}
            </tr>
        `;
        
    });

    return _html+=`</tbody>`;
    
}
function _addForm() {
    formActOpen();
    $('#itemFormLeft').html(_htmlFormEntri());
}
function _addFormEntried(){
    const param ={
        xuser:_.xuser,
        kdPenerima  :_inpDrop.selected, 
        nominal     :$("#nominal").val(), 
        keterangan  :$("#keterangan").val()
    }
    
    // return console.log(param);
    _post('/setwan/keuangan/entriUang',param).then(v=>{
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
function _htmlFormEntri(v) { 
    const kond=(v==undefined? true:false);
    return `
        <div class="form1 bwhite">
            <div class="header ${(kond? 'bprimary':'bwarning' )} cwhite">
                <h3>${(kond? 'Entri':'Perbarui' )} Keuangan</h3>
                <button class="btn1 bdark" onclick="formActClose()">
                    <span class="mdi mdi-close-circle fz25 cdanger"></span>
                </button>
            </div>
            <div class="body ">  
                ${_inputDropdown({
                    label:'Penerima',
                    idInput:'penerima',
                    valInput:(kond? '':v.penerima),
                    dt:_.duser, 
                })}
                <div class="labelInput2 mtb10px bdark clight">
                    <label class="mw75px">Nominal</label>
                    <input type="number" id="nominal" value="${(kond? '':v.nominal )}"/>
                </div>
                <div class="labelInput2 mtb10px bdark clight">
                    <label class="mw75px">Catatan</label>
                    <input type="text" id="keterangan" value="${(kond? '':v.catatan )}"/>
                </div>
            </div>
            <div class="footer posEnd">
                <div class="btnGroup">
                    <button class="btn2 bmuted clight" onclick="formActClose()">close</button>
                    <button class="btn2  ${(kond? 'bprimary clight':'bwarning cdark' )}" onclick="${(kond? '_addFormEntried()': `_addFormEntried(${v.ind})` )}">${(kond? 'Entri':'Perbarui' )}</button>
                </div>
            </div>
        </div>
    `; 
}
function _cancelTransfer(ind){
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
            body:'<p>apa benar ingin membatalkan transfer ini ?</p>',
            // cfooter:'',
            footer:`
                <div class="btnGroup">
                    <button class="btn2 bmuted clight" onclick="dialogClose()">Close</button>
                    <button class="btn2 bdanger clight" onclick="_cancelTransfered(${ind})">Batalkan</button>
                </div>
            `,
        })
    );
    
}
function _cancelTransfered(ind) {
    const param ={
        xuser:_.xuser,
        kdPengirim  :_.duang[ind].kdPengirim, 
        kdPenerima  :_.duang[ind].kdPenerima,
        nominal     :_.duang[ind].nominal, 
        kdUang      :_.duang[ind].kdUang
    }
    
    // return console.log(param);
    _post('/setwan/keuangan/tariKembaliUang',param).then(v=>{
        if(v.exc){
            dialogClose();
            return respon(v.data);
        }
        return _toast({
            bg:'e',
            msg:v.msg
        })
    }); 
}