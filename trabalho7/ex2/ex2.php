<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados do endereço de entrega
$cep = $_POST["CEP"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$bairro = $_POST["bairro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$sql = <<<SQL
  INSERT INTO endereco
    (cep, logradouro, bairro, cidade, estado)
  VALUES (?, ?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();
  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([
    $cep, $logradouro, $bairro, $cidade, $estado
  ])) throw new Exception('Falha na inserção');
  $pdo->commit();

  header("location: ../enderecos.php");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}

