let buttons = document.querySelectorAll('button.pagination-button');
let page = 1;
for(let i=0; i< buttons.length; i++){
    buttons[i].addEventListener('click', paginationHandler);
}

function paginationHandler(e){
    let elem = e.target;
    
    for(let i = 0; i < buttons.length; i++){
        if(buttons[i] == elem){
            buttons[i].classList.add('activ'); 
        }else{
             buttons[i].classList.remove('activ');
        }
    } 
}

