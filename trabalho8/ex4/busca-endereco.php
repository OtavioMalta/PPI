<?php

class Endereco
{
  public $rua;
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade)
  {
    $this->rua = $rua;
    $this->bairro = $bairro; 
    $this->cidade = $cidade;
  }
}

function buscaCep($pdo, $cep){
  $sql = <<<SQL
  SELECT cep, rua, cidade, bairro
  FROM enderecos where cep = ?
  SQL;

  
  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cep]);
    $row = $stmt->fetch();
    if (!$row) return new Endereco('', '', '');

    $rua = htmlspecialchars($row['rua']);
    $bairro = htmlspecialchars($row['bairro']);
    $cidade = htmlspecialchars($row['cidade']);

    return new Endereco($rua, $bairro, $cidade);
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$cep = $_GET['cep'] ?? '';

$endereco = buscaCep($pdo, $cep);

header('Content-type: application/json');  
echo json_encode($endereco);