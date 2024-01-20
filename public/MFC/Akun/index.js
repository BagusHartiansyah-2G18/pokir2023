function  _onload(){
    respon();
}

function respon(v){
    if(v!=undefined){
        _.users=v;
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
        ,func:"del()"
        ,icon:`<span class="material-icons">delete</span>`
        ,title:"Perbarui"
    });
    return btabel({
            id:"dt",
            class:'',
            isi:_tabel(
                {
                    data:_.users,
                    no:1,
                    kolom:["name","kdUser",'password','kdJaba'],
                    namaKolom:["Nama","Username",'Password','Level'],
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
        nama    :$("#nama").val(),
        username:$("#username").val(),
        password:$("#password").val(),
        kdJaba  :$("#kdJaba").val()
    }

    // return console.log(param);
    _post('/pokir/akun/added',param).then(v=>{
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
                    <label class="mw75px">Nama</label>
                    <input type="text" id="nama" value="${(kond? '':v.nama )}"/>
                </div>
                <div class="labelInput2 mtb10px Cblack">
                    <label class="mw75px">Username</label>
                    <input type="text" id="username" value="${(kond? '':v.username )}"/>
                </div>
                <div class="labelInput2 mtb10px Cblack">
                    <label class="mw75px">Password</label>
                    <input type="password" id="password" value="${(kond? '':v.password )}"/>
                </div>
                <div class="labelInput2 mtb10px Cblack">
                    <label class="mw75px">Level</label>
                    <select id="kdJaba"  value="${(kond? '':v.kdJaba )}">
                        <option value="1">User</option>
                        <option value="2">Admin</option>
                    </select>
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
    formActOpen();
    $('#itemFormLeft').html(_htmlForm({
        ind,
        nama :_.users[ind].name,
        username :_.users[ind].kdUser,
        password :_.users[ind].password,
        kdJaba :_.users[ind].kdJaba,
    }));
}
function _upded(ind) {
    const param ={
        kdUser:_.users[ind].kdUser,
        xuser:_.xuser,
        nama:$("#nama").val(),
        username:$("#username").val(),
        password:$("#password").val(),
        kdJaba:$("#kdJaba").val(),
    }

    // return console.log(param);
    _post('/pokir/akun/upded',param).then(v=>{
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
            body:'<p>apa benar ingin menghapus Akun ini ?</p>',
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
        kdUser:_.users[ind].kdUser,
        xuser:_.xuser,
    }

    // return console.log(param);
    _post('/pokir/akun/deled',param).then(v=>{
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
function updPass(){
    const param ={
        xuser:_.xuser,
        passO:$("#passO").val(),
        passN:$("#passN").val(),
    }
    _post('/pokir/akun/updPass',param).then(v=>{
        if(v.exc){
            return _redirect('/pokir/logout');
        }
        return _toast({
            bg:'e',
            msg:v.msg
        })
    });
}
