// const { functions } = require("lodash");

let _vimg={
    size :15000000 //2 MB
    ,data:Array()
    ,fileName:["jpg","jpeg","png","bmp"]
    ,maxUpload:2
    ,idView:"sImage"
  },
  _vfile={
    size :15000000 //2 MB
    ,data:Array()
    ,fileName:["application/pdf","pdf"]
    ,maxUpload:2
    ,idView:"files"
  },
  _inpDrop={};

function _readImage(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        new Promise(function(res){
            let img = new Image;
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                img.src = reader.result;
                res({
                    src :img.src,
                    nama:input.files.item(0).name,
                    size:input.files.item(0).size,
                    type:input.files.item(0).type
                });
            }
        }).then(resp=>{
            
            // console.log("Bagus H");
            if(resp.size<=_vimg.size){
                nama=resp.nama.split(".");
                let checked=false;
                _vimg.fileName.forEach(v => {
                    if(nama[1].toUpperCase()==v.toUpperCase()){
                        checked=true;
                    }
                });
                if(checked){
                    if(_vimg.data.length+1<=_vimg.maxUpload){
                        _vimg.data.push(resp);
                        // console.log(_getImage());
                        $('#'+_vimg.idView).html(_getImage());
                    }else{
                        return _toast({bg:'e', msg:"cukup "+_vimg.maxUpload+" file photo saja !!!"});
                    }
                }else{
                    let ket="";
                    _vimg.fileName.forEach(v => {
                        ket+=v+" ";
                    });
                    _toast({bg:'e', msg:"Format File Harus "+ket+" !!!"});
                }
            }else{
                _toast({bg:'e', msg:"Ukuran File Maksimal "+(_vimg.size/1000000)+" MB !!!"});
            }
        })
    }
}
function _getImage(){
    let tam=`
    <div class="table-border-style">
      <div class="table-responsive">
        <table class="table" id="dataTabel">
        <thead>
            <tr>
            <th>no</th>
            <th>Nama</th>
            <th colspan="2" style="text-align:center;">Action</th>
            </tr>
            </thead>
            <tbody>
    `;
    for(let a=0;a<_vimg.data.length;a++){
      tam+=`
      <tr>
          <td>`+(a+1)+`</td>
          <td>`+_vimg.data[a].nama+`</td>
          <td class="text-center">`+
            _btnTabel([{ 
                clsBtn:`btn-outline-warning`
                ,func:`_viewImage(`+a+`)`
                ,icon:`<i class="mdi mdi-eye"></i>`
                ,title:"Lihat Gambar"
            },
            { 
                clsBtn:`btn-outline-danger`
                ,func:`_deleteImage(`+a+`)`
                ,icon:`<i class="mdi mdi-delete-forever"></i>`
                ,title:"Delete"
            }])
          +`
          </td>
      </tr>
      `;
    }
    tam+=`
          </tbody>
          </table>
      </div>
      </div>
    `;
    return tam;
}
function _viewImage(ind){
  return  window.open(_vimg.data[ind].src,'Image');
}
function _deleteImage(ind){
    _vimg.data.splice(ind,1);
  $('#'+_vimg.idView).html(_getImage());


}
function _resetImg(){
    _vimg.data=[];
    $('#images').html('');
}

function _inputDropdown(v){
    // {
    //     label:'',
    //     idInput:'',
    //     dt:[], 
    // }
    // {
    //     label:'',
    //     idInput:'',
        // valInput:'',
    //     dt:[],
    //     iddropContent : '',
        // cinput:'',
    // }
    if(v.save==undefined){
        _inpDrop=v;
    }
    return `
    <div class="labelInput2 dropdown ${(v.cinput==undefined?' bdark clight':v.cinput)}">
        <label class="${(v.clabel==undefined?'':v.clabel)}">${v.label}</label>
        <input type="text" id="${v.idInput}" value="${(v.valInput==undefined?'':v.valInput)}" onchange="${(v.change==undefined?'_inputDropdownChange':v.change)}(this)" class="dropdown-toggle" />
        <div class="dropdown-content cdark" id="${(v.iddropContent==undefined?'dropContent':v.iddropContent)}">
            ${(v.option==undefined?_inputDropdownItem({value:''},v.dt):v.option)}
        </div>
    </div>
    `;
}
function _inputDropdownItem(val,dt,click) {
    const xdt=(dt==undefined?_inpDrop.dt:dt);
    let _html=`<ul class="m0 over200px">`,fkond=false;
    xdt.forEach((v,i) => {
        fkond=_searchText(v.valueName,val.value);
        if(fkond){
            _html+=`
                <li style="cursor:pointer;" class="pwrap" onclick="${(click==undefined?'_inputDropdownSelected':click)+`(${i})`}">${v.valueName}</li>
            `;
        }
    });
    return _html+=`</ul>`;
}
function _inputDropdownChange(v){
    $('#dropContent').html(_inputDropdownItem(v,_inpDrop.dt));
}
function _inputDropdownSelected(ind){  
    $('#'+_inpDrop.idInput).val(_inpDrop.dt[ind].valueName); 
    _inputDropdownChange({value:_inpDrop.dt[ind].valueName});
    _inpDrop.selected = _inpDrop.dt[ind].value;
    $(this).next().focus();
}



function _select(v){
    return `
        <div class="labelInput2 mtb10px ${delUndife(v.c)}">
            <label class="${delUndife(v.clabel)}">${v.label}</label>
            <select 
                id="${v.idSelect}" 
                class="${delUndife(v.cselect)}" 
                onchange="${delUndife(v.change)}" 
                value="${delUndife(v.value)}" >
                ${_selectOption(v.dt)}
            </select>
        </div>
    `;
}
function _selectOption(d,ind){
    let _html=``;
    d.forEach((v,i)=>{
        _html+=`<option value="${(ind==undefined? v.value:i)}">${ v.valueName}</option>`;
    })
    return _html;
}