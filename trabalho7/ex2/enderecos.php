<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT logradouro, bairro, cidade, cep
  FROM endereco
  SQL;
  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ex2</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <style>
    body {
      padding-top: 2rem;
    }
  </style>
</head>

<body>

  <div class="container">
    <h3>Enderecos</h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Logradouro</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Nome Cliente</th>
        <th>Email</th>
      </tr>

      <?php
      while ($row = $stmt->fetch()) {
        $logradouro = htmlspecialchars($row['logradouro']);
        $bairro = htmlspecialchars($row['bairro']);
        $cidade = htmlspecialchars($row['cidade']);
        $cep = htmlspecialchars($row['cep']);

        echo <<<HTML
          <tr>
            <td>$logradouro</td>
            <td>$bairro</td>
            <td>$cidade</td>
            <td>$cep</td> 
          </tr>      
        HTML;
      }
      ?>

    </table>
    <a href="../index.html">Menu de opções</a>
  </div>

</body>

</html>