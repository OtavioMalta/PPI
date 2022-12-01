<?php

class Contato
{
  public $nome;
  public $email;
  public $telefone;

  function __construct($nome, $email, $telefone)
  {
    $this->nome = $nome;
    $this->email = $email;
    $this->telefone = $telefone;
  }

  public function AddToFile($arquivo)
  {
    // abre o arquivo para escrita de conteúdo no final
    $arq = fopen($arquivo, "a");
    fwrite($arq, "\n{$this->nome};{$this->email};{$this->telefone}");
    fclose($arq); 
  }
}

function carregaContatosDeArquivo()
{
  $arrayContatos = null;
  
  // Abre o arquivo contatos.txt para leitura
  $arq = fopen("contatos.txt", "r");
  if ( !$arq )
    return null;

  // Le os dados do arquivo, linha por linha, e armazena no vetor $contatos
  while (!feof($arq)) {
    // fgets lê uma linha de texto do arquivo
    $contato = fgets($arq); 
    
    // Separa dados na linha utilizando o ';' como separador
    list($nome, $email, $telefone) = array_pad(explode(';', $contato), 3, null);

    // Cria novo objeto representado o contato e adiciona no final do array
    $novoContato = new Contato($nome, $email, $telefone);
    $arrayContatos[] = $novoContato;
  }
      
  // Fecha o arquivo
  fclose($arq);  
  return $arrayContatos;
}

?>