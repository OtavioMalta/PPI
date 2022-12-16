<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$bairro = $_POST["bairro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
try {

  $sql = <<<SQL
  INSERT INTO endereco(cep, logradouro, bairro, cidade, estado)
  VALUES (?, ?, ?, ?, ?)
  SQL;
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cep, $logradouro, $bairro, $cidade, $estado]);

  header("location: enderecos.php");
  exit();
} 
catch (Exception $e) {  
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
?>


