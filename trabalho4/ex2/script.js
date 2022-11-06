window.onload = function(){
    const h2 = document.querySelectorAll("h2");
    for (let h of h2) {
        h.onclick = () => {
            const p = h.nextElementSibling;
            p.style.display = 'none';
        }

        h.ondblclick = () => {
            const p = h.nextElementSibling;
            p.style.display = 'block';
        }
      }
    }