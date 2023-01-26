<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

class Anuncio{
  private $codigo;
  private $titulo;
  private $descricao;
  private $preco;
  private $dataHora;
  private $cep;
  private $bairro;
  private $cidade;
  private $estado;
  private $codCategoria;
  private $codAnunciante;

  public function __construct($codigo, $titulo, $descricao, $preco, $dataHora, $cep, $bairro, $cidade, $estado, $codCategoria, $codAnunciante){
    $this->codigo = $codigo;
    $this->titulo = $titulo;
    $this->descricao = $descricao;
    $this->preco = $preco;
    $this->dataHora = $dataHora;
    $this->cep = $cep;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
    $this->estado = $estado;
    $this->codCategoria = $codCategoria;
    $this->codAnunciante = $codAnunciante;
  }
}

function retornaAnuncio(Codigo $codigo){
  require_once($_SERVER['DOCUMENT_ROOT'] . "/database/dbConnector.php");
  $pdo = getConnection();

  try {
    $sql = <<<SQL
    SELECT codigo, titulo, descricao, preco, dataHora, cep, bairro, cidade, estado, codCategoria, codAnunciante
    FROM anuncio where codigo = ?
    SQL;
  
    try {
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$codigo]);
      $row = $stmt->fetch();

      if (!$row) return new Anuncio('', '', '', '', '', '', '', '', '', '', '');
      return new Anuncio(
        $row['codigo'], $row['titulo'], $row['descricao'],
        $row['preco'], $row['dataHora'], $row['cep'], 
        $row['bairro'], $row['cidade'], $row['estado'], 
        $row['codCategoria'], $row['codAnunciante']);
    } 
    catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }
  
}

$codigo = $_GET['codigo'] ?? '';
$anuncio = retornaAnuncio($codigo);
header('Content-type: application/json');

echo json_encode($anuncio);
header("location: ../anuncio.php");
?>