<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Exemplo PHP 1</title>

    <style>
        td{
        padding: 12px;
        border: solid 1px gray;
        }
    </style>

</head>
<body>
    <?php 
    $CEP=$_POST["CEP"];
    $logradouro=$_POST["logradouro"];
    $bairro=$_POST["bairro"];
    $cidade=$_POST["cidade"];

    echo <<<HTML
        <table>
            <tr>
                <td>$CEP</td>
                <td>$logradouro</td>
                <td>$bairro</td>
                <td>$cidade</td>
                <td>$estado</td>
            </tr>
        </table>
    HTML;
    ?>
</body>
</html>