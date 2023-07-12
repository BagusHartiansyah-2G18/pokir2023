function  _onload(){
    
}
$("#blogin").click( function() {
    const param ={
        username:$("#username").val(),
        password:$("#password").val(),
        // _token  :$("meta[name='csrf-token']").attr("content")
    }
    _post('/setwan/prosesLogin',param).then(v=>{
        if(v.exc){
            return _redirect('/setwan/dashboard');
        }
        return _toast({
            bg:'e',
            msg:v.msg
        })
    }); 

});