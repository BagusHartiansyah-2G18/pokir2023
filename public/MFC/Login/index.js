function  _onload(){

}
$("#blogin").click( function() {
    const param ={
        username:$("#username").val(),
        password:$("#password").val(),
        // _token  :$("meta[name='csrf-token']").attr("content")
    }
    _post('/pokir/prosesLogin',param).then(v=>{
        if(v.exc){
            return _redirect('/pokir/dashboard');
        }
        return _toast({
            bg:'e',
            msg:v.msg
        })
    });

});
