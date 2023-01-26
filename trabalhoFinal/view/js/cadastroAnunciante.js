document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#btn-cadastrar").addEventListener("click", cadastrarAnunciante);
})

async function cadastrarAnunciante(){
    cleanMessages();

    let form = document.querySelector("form");
    
    let valid = validaDados(form);


    if(!valid){
        return;
    }

    let formData = new FormData(form);

    const options = {
        method: "POST",
        body: formData
    }
    
    const response = await fetch("/controller/cadastroAnunciante.php", options);
    const data = await response.json();
    if(data.success){
        form.hidden = true;
        document.querySelector(".title").innerText = "Cadastro realizado com sucesso!";
        p = document.createElement("p");
        p.innerHTML = 'Redirecionando para a <a href="/view/login.html">página de login</a>';
        document.querySelector(".success").appendChild(p);
        setTimeout(() => window.location = "/view/login.html", 3000);
    } else {
        window.alert(data.messages[0]);
        return
    }
}

function validaDados(form){

    let valid = true;

    let name = form.name.value;
    let cpf = form.cpf.value;
    let email = form.email.value;
    let password = form.password.value;
    let confirm_password = form.confirm_password.value;
    let telephone = form.phone.value;

    if(name == ""){
        valid = false;
        document.querySelector(".span-name").innerText = "Informe o nome";
    }

    if(cpf == "" || cpf.length != 11){
        valid = false;
        document.querySelector(".span-cpf").innerText = "O CPF deve ter 11 dígitos";
    }

    let emailValido = email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)
    
    if(!emailValido || email == ""){
        valid = false;      
        document.querySelector(".span-email").innerText = "O e-mail é inválido";
    }

    if(password == "" || password.length < 5){
        valid = false;
        document.querySelector(".span-password").innerText = "A senha deve ter pelo menos 5 caracteres";
    }

    if(confirm_password == ""){
        valid = false;
        document.querySelector(".span-confirm-password").innerText = "Confirme a senha";
    }

    if(password != confirm_password){
        valid = false;
        document.querySelector(".span-confirm-password").innerText = "As senhas não batem";
    }

    if(telephone == ""){
        valid = false;
        document.querySelector(".span-phone").innerText = "O telefone deve ser informado";
    }

    return valid;
}

function cleanMessages() {
    document.querySelectorAll(".msg").forEach(msg => {
        msg.innerText = "";
    });
}