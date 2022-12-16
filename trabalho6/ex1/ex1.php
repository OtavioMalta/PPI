<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ex1</title>
</head>
<body>
    <div class="row g-2">
        <?php
            $cep = htmlspecialchars($_POST["cep"] ?? "");
            $cidade = htmlspecialchars($_POST["cidade"] ?? "");
            $bairro = htmlspecialchars($_POST["bairro"] ?? "");
            $estado = htmlspecialchars($_POST["estado"] ?? "");
            $logradouro = htmlspecialchars($_POST["logradouro"] ?? "" );

            echo <<<HTML
                <div class="row g-2">
                    <div class="col-sm">$cep</div>
                    
                    <div class="col-sm">$cidade</div>
                    
                    <div class="col-sm">$bairro</div>
                    
                    <div class="col-sm">$estado</div>
                    
                    <div class="col-sm">$logradouro</div>
                </div>
            HTML;
        ?>
  </div>
</body>
</html>