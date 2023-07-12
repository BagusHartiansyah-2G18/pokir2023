function _fkonfirmasi(v){
    // {
    //     cform:'',
    //     cheader:'',
    //     header:'',
    //     cbody:'',
    //     body:'',
    //     cfooter:'',
    //     footer:'',
    // }
    return `
        <div class="form1 m0 ${v.cform}">
            <div class="header ${v.cheader}">
                ${v.header}
            </div>
            <div class="body ${v.cbody}">${v.body}</div>
            <div class="footer posEnd ${v.cfooter}">${v.footer}</div>
        </div>
    `;
}