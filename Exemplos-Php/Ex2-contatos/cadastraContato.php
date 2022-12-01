<?php

require "contatos.php";

// coleta os dados do formulário
$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";

// cria um novo contato e acrescenta no arquivo de texto
$novoContato = new Contato($nome, $email, $telefone);
$novoContato->AddToFile("contatos.txt");

// redireciona o navegador para a página de listagem de contatos
header("location: listaContatos.php");

?>