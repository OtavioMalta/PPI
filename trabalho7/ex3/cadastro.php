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
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();
    
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";
    $hash_senha = password_hash($senha, PASSWORD_DEFAULT);
    
    /*function salvaString($string, $arquivo){
        $arq = fopen($arquivo, "w");
        fwrite($arq, $string);
        fclose($arq);
    }*/

    try {

        $sql = <<<SQL
        INSERT INTO usuario(email, hash_senha)
        VALUES (?, ?)
        SQL;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $hash_senha]);
      
      } 
      catch (Exception $e) {
        
        exit('Ocorreu uma falha: ' . $e->getMessage());
      }

    echo <<<SUCESSO
    <div class="container">
        <h1>Os dados foram inseridos com sucesso!</h1>
        <a href="index.html">Voltar</a>
     </div>
    SUCESSO
    ?>
</body>
</html>