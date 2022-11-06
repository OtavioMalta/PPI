window.onload = function(){
    const h1 = document.querySelector("h1");
    h1.addEventListener('click', alteraH1);

    const h2 = document.querySelectorAll("h2");
    for (let h of h2) {
        h.onclick = () => h.textContent = 'Obrigado';
      }
    }

function alteraH1(e){
    const h1 = e.target;
    h1.textContent = 'Dono do currículo';
}