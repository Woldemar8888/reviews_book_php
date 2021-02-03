let buttons = document.querySelectorAll('button.pagination-button');
let page = 1;
for(let i=0; i< buttons.length; i++){
    buttons[i].addEventListener('click', paginationHandler);
}

let obj = {'page': 1};
function paginationHandler(e){
    let elem = e.target;
    obj.page = elem.value;
    
    for(let i = 0; i < buttons.length; i++){
        if(buttons[i] == elem){
            buttons[i].classList.add('activ'); 
        }else{
             buttons[i].classList.remove('activ');
        }
    }
    console.log(obj); 
}

function sendSettings(obj){
    fetch("content.php", {
            method: "POST",
            headers: {
                "Content-type": "text/plain"
            },
            body: JSON.stringify(obj) 
        })
//        .then(response=>response.text())
//        .then(data=>{
//        try{
//            data = JSON.parse(data);
//                 setSongs(data);
//            }catch(e){
//                 console.log("error");
//            }       
//        });
}