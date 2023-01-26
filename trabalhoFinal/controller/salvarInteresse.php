<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/database/dbConnector.php");
$pdo = getConnection();

class Interesse {
  private $codigo;
  private $mensagem;
  private $dataHora;
  private $contato;
  private $codAnuncio;

  public function __construct($codigo, $mensagem, $dataHora, $contato, $codAnuncio){
    $this->codigo = $codigo;
    $this->mensagem = $mensagem;
    $this->dataHora = $dataHora;
    $this->contato = $contato;
    $this->codAnuncio = $codAnuncio;
  }
}

public function isValid(){
  $validation = array(
      "valid" => true,
      "messages" => []
  );
  
  if($this->codigo == ""){
      $validation ['valid'] = false;
      array_push($validation['messages'], "Informe a mensagem");            
  }
  
  $emailValido = filter_var($this->email, FILTER_VALIDATE_EMAIL);
  if(!$emailValido || $this->email == ""){
      $validation ['valid'] = false;
      array_push($validation['messages'], "O e-mail é inválido");
  }
  return $validation;
}

public function getParamsToSave(){
  $params = [
      $this->codigo = $codigo;
      $this->mensagem = $mensagem;
      $this->dataHora = $dataHora;
      $this->contato = $contato;
      $this->codAnuncio = $codAnuncio;
  ];
  return $params;
}

header('Content-Type: application/json; charset=utf-8');
if(!empty($_POST)) {
    $codigo           = $_POST['codigo'] ?? "";
    $mensagem         = $_POST['mensagem'] ?? "";
    $dataHora         = $_POST['dataHora'] ?? "";
    $contato          = $_POST['contato'] ?? "";
    $codAnuncio       = $_POST['codAnuncio'] ?? "";
    
    $interesse = new Interesse($codigo, $mensagem, $dataHora, $contato, $codAnuncio);
    $validation = $interesse->isValid();
    
    if(!$validation['valid']){
        http_response_code(400);     
        echo json_encode(getResponseTemplate(false, $validation['messages']));
    } else {
        echo json_encode(saveInteresse($interesse));
    }

} else {
    http_response_code(400);
    echo json_encode(
        getResponseTemplate(false, ["É necessário fornecer os dados para o cadastro do interesse"])
    );
}


function saveInteresse(Interesse $int){
  require_once($_SERVER['DOCUMENT_ROOT'] . "/database/dbConnector.php");
  $pdo = getConnection();
  
  $intExists = InteresseExists($int, $pdo);
  if($intExists){
      return getResponseTemplate(false, ["Já existe um Interesse cadastrado com estes dados"]);
  }

  $query = <<<SQL
  INSERT INTO interesse (codigo, mensagem, dataHora, contato, codAnuncio)
  VALUES (?, ?, ?, ?, ?);
  SQL;
  
  try {
      $statement = $pdo->prepare($query);
      if(!$statement->execute($int->getParamsToSave())){
          throw new Exception("Falha ao cadastrar o Interesse");
      }
      return getResponseTemplate(true,["Interesse cadastrado(a) com sucesso"]);
  } catch(Exception $e) {
      return getResponseTemplate(false,[$e->getMessage()]);
  }
}

function interesseExists(Interesse $int, PDO $pdo){
  $contato = $int->getContato();

  $query = <<<SQL
  SELECT COUNT(nome) as existe
  FROM Interesse 
  WHERE contato = ?;
  SQL;

  $statement = $pdo->prepare($query);
  $statement->execute([$contato]);
  $row = $statement->fetch();
  $existe = $row['existe'];
  return $existe;
}

function getResponseTemplate($success = true, $messages = []) {
  return array(
      "success" => $success,
      "messages" => $messages
  );
}

public function getContato(){ return $this->contato;}
?>