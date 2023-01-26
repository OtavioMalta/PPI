var tempo = 3500;

window.onload = function () { 
    img1()
}

function img1(){
    document.getElementById("notebookImg").src = "../images/notebook1.jpg";
    setTimeout("img2()", tempo);
}

function img2(){
    document.getElementById("notebookImg").src = "../images/notebook2.jpg";
    setTimeout("img3()", tempo);
}

function img3(){
    document.getElementById("notebookImg").src = "../images/notebook3.jpg";
    setTimeout("img1()", tempo);
}


function btnInteresse() {
     document.getElementById('interesse').style.display = "block";
     document.getElementById('tenhoInteresse').style.display = "none";

 }