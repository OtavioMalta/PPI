<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ex3</title>
</head>
<body>
    <?php

    function salvaString($string, $arquivo){
        $arq = fopen($arquivo, "w");
        fwrite($arq, $string);
        fclose($arq);
    }

    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $arqEmail = "email.txt";
    $arqSenha = "senhaHash.txt";
    
    salvaString($email, $arqEmail);
    salvaString($senhaHash, $arqSenha);

    echo <<<SUCESSO
    <div class="container">
        <h1>Os dados foram inseridos com sucesso!</h1>
     </div>
    SUCESSO
    ?>
</body>
</html>