<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

try {

  $sql = <<<SQL
  SELECT nome, peso, altura, tipo_sanguineo
  FROM paciente INNER JOIN pessoa ON pessoa.codigo = paciente.id
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
  <title>Pacientes</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <style>
    body {
      padding-top: 2rem;
    }
  </style>
</head>

<body>

  <div class="container">
    <h3>Pacientes</h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Nome</th>
        <th>Peso</th>
        <th>Altura</th>
        <th>Tipo Sanguíneo</th>
      </tr>

      <?php
      while ($row = $stmt->fetch()) {

        $nome = htmlspecialchars($row['nome']);
        $peso = htmlspecialchars($row['peso']);
        $altura = htmlspecialchars($row['altura']);
        $tipo_sanguineo = htmlspecialchars($row['tipo_sanguineo']);

        echo <<<HTML
          <tr>
            <td>$nome</td>
            <td>$peso</td>
            <td>$altura</td>
            <td>$tipo_sanguineo</td> 
          </tr>      
        HTML;
      }
      ?>

    </table>
    <a href="index.html">Menu de opções</a>
  </div>

</body>

</html>