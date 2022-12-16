<?php

function login($pdo, $email, $senha)
{
  $sql = <<<SQL
    SELECT hash_senha
    FROM usuario
    WHERE email = ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();
    if (!$row) return false; 

    return password_verify($senha, $row['hash_senha']);
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";

if (login($pdo, $email, $senha))
    header("location: sucesso.html");
else
    header("location: login.html"); 
