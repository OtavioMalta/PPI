<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ex4</title>
</head>

<body>
    <?php

    function carregaString($arquivo){
        $arq = fopen($arquivo, "r");
        $string = fgets($arq);
        fclose($arq);
        return $string;
    }
    $email = htmlspecialchars(carregaString("../ex3/email.txt"));
    $senhaHash = htmlspecialchars(carregaString("../ex3/senhaHash.txt"));

    echo <<<DADOS
    <div class="container">
        <h1>Dados inseridos:</h1>
        <p>$email</p>
        <p>$senhaHash</p>
     </div>
    DADOS
    ?>
</body>
</html>