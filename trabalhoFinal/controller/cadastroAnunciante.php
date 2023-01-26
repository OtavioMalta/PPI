<?php

class Anunciante {
    private $id;
    private $name;
    private $cpf;
    private $email;
    private $password;
    private $confirm_password;
    private $telephone;

    public function __construct($id, $name, $cpf, $email, $password, $confirm_password, $telephone){
        $this->id   = $id;
        $this->name = $name;
        $this->cpf  = $cpf;
        $this->email  = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->telephone = $telephone;
    }

    public function isValid(){
        $validation = array(
            "valid" => true,
            "messages" => []
        );
        
        if($this->name == ""){
            $validation ['valid'] = false;
            array_push($validation['messages'], "Informe o nome");            
        }

        if($this->cpf == "" || strlen($this->cpf) != 11){
            $validation ['valid'] = false;
            array_push($validation['messages'], "O CPF deve ter 11 dígitos");
        }
        
        $emailValido = filter_var($this->email, FILTER_VALIDATE_EMAIL);

        if(!$emailValido || $this->email == ""){
            $validation ['valid'] = false;
            array_push($validation['messages'], "O e-mail é inválido");
        }

        if($this->password == "" || strlen($this->password) < 5){
            $validation ['valid'] = false;
            array_push($validation['messages'], "A senha deve ter pelo menos 5 caracteres");
        }

        if($this->confirm_password == ""){
            $validation ['valid'] = false;
            array_push($validation['messages'], "Confirme a senha");
        }

        if($this->password != $this->confirm_password){
            $validation ['valid'] = false;
            array_push($validation['messages'], "As senhas não batem");
        }

        if($this->telephone == ""){
            $validation ['valid'] = false;
            array_push($validation['messages'], "O telefone deve ser informado");
        }

        return $validation;
    }

    public function getParamsToSave(){
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        
        $params = [
            $this->name,
            $this->cpf,
            $this->email,
            $passwordHash,
            $this->telephone
        ];

        return $params;
    }

    public function getEmail(){ return $this->email;}
    public function getCpf(){ return $this->cpf;}
}


// Início do tratamento da requisição
header('Content-Type: application/json; charset=utf-8');
if(!empty($_POST)) {
    $name             = $_POST['name'] ?? "";
    $cpf              = $_POST['cpf'] ?? "";
    $email            = $_POST['email'] ?? "";
    $password         = $_POST['password'] ?? "";
    $confirm_password = $_POST['confirm_password'] ?? "";
    $phone            = $_POST['phone'] ?? "";
    
    $anunciante = new Anunciante(0, $name, $cpf, $email, $password, $confirm_password, $phone);
    $validation = $anunciante->isValid();
    
    if(!$validation['valid']){
        http_response_code(400);     
        echo json_encode(getResponseTemplate(false, $validation['messages']));
    } else {
        echo json_encode(saveAnunciante($anunciante));
    }

} else {
    http_response_code(400);
    echo json_encode(
        getResponseTemplate(false, ["É necessário fornecer os dados para o cadastro do anunciante"])
    );
}

function saveAnunciante(Anunciante $adv){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/database/dbConnector.php");
    $pdo = getConnection();
    
    $advExists = anuncianteExists($adv, $pdo);
    if($advExists){
        return getResponseTemplate(false, ["Já existe um anunciante cadastrado com estes dados"]);
    }

    $query = <<<SQL
    INSERT INTO anunciante (nome, cpf, email, senha, telefone) 
    VALUES (?, ?, ?, ?, ?);
    SQL;
    
    try {
        $statement = $pdo->prepare($query);
        if(!$statement->execute($adv->getParamsToSave())){
            throw new Exception("Falha ao cadastrar o anunciante");
        }
        return getResponseTemplate(true,["Anunciante cadastrado(a) com sucesso"]);
    } catch(Exception $e) {
        return getResponseTemplate(false,[$e->getMessage()]);
    }
}

function anuncianteExists(Anunciante $adv, PDO $pdo){
    $email = $adv->getEmail();
    $cpf = $adv->getCpf();

    $query = <<<SQL
    SELECT COUNT(nome) as existe
    FROM anunciante 
    WHERE email = ?
        OR cpf = ?;
    SQL;

    $statement = $pdo->prepare($query);
    $statement->execute([$email, $cpf]);
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
?>