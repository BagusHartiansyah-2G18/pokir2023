// function ini tidak menggunakan _ 
const menu =document.getElementById('menu'); 
const formRight =document.getElementById('formRight'); 
const leftBar =document.getElementById('liftBar2');
const formActionLeft = document.getElementById('formActionLeft');
const itemFormLeft = document.getElementById('itemFormLeft');


menu.addEventListener('click',function (e){
    if(leftBar.classList.length==2){
        return leftBar.classList.add('lfAct');
    }
    return leftBar.classList.remove('lfAct');
});

const dialog = document.getElementById('dialog1');
function dialogOpen(){
    dialog.showModal();
}
function dialogClose(){
    dialog.close();
}

function openFormRight(){
    formRight.style.display='block';
}
function closeFormRight(){
    formRight.style.display='none';
}

function formActOpen(){
    formActionLeft.classList.add('formActionLeftAct');
    itemFormLeft.classList.remove('dnone');
}
function formActClose(){
    formActionLeft.classList.remove('formActionLeftAct');
    itemFormLeft.classList.add('dnone');
}