console.log("hey!");
window.onload=function(){


let btn_close = document.querySelector('#close');
let cont_cookies = document.getElementsByClassName("cookie_box");


let cookieAlert = () => {
    if(btn_close) {
        btn_close.addEventListener("click", () => 
    {
    let opacityLow = cont_cookies[0].style.opacity = 0;
    return opacityLow
    });
    
}

}

let cookieOpacity = () =>  {
    if(btn_close){
    return setTimeout(()=>{cont_cookies[0].style.opacity = 0;}, 7000) }
}
cookieAlert();
cookieOpacity();

}

