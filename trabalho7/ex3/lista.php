<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ex3</title>
</head>

<body>

    <div class="container">
        <h3>Clientes Cadastrados</h3>
        <table class="table table-striped">
        <tr>
            <th>Email</th>
            <th>SenhaHash</th>
        </tr>
    <?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

   /* function carregaString($arquivo){
        $arq = fopen($arquivo, "r");
        $string = fgets($arq);
        fclose($arq);
        return $string;
    }*/
   
    try {
        $sql = <<<SQL
        SELECT email, hash_senha
        FROM usuario
        SQL;
        $stmt = $pdo->query($sql); // sem possibilidade de Injection
      } 
      catch (Exception $e) {
        exit('Ocorreu uma falha: ' . $e->getMessage());
      }

    while ($row = $stmt->fetch()) {
        $email = htmlspecialchars($row['email']);
        $hash_senha = htmlspecialchars($row['hash_senha']);

        echo <<<HTML
        <tr>
          <td>$email</td>
          <td>$hash_senha</td>
        </tr>      
      HTML;}
    ?>
        </table>
        <a href="index.html">Voltar</a>
    </div>
</body>
</html>