<?php
    function carregaString($arquivo){
        $arq = fopen($arquivo, "r");
        $string = fgets($arq);
        fclose($arq);
        return $string;
    }

    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $emailAqr = htmlspecialchars(carregaString("../ex3/email.txt"));
    $senhaHashArq = htmlspecialchars(carregaString("../ex3/senhaHash.txt"));

    if ($emailAqr == $email && password_verify($senha, $senhaHashArq)) {
        header("location: sucesso.html");
        exit();
    }
    else {
        header("location: index.html");
        exit();
    }
?>