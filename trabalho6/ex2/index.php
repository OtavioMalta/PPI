<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ex2</title>
</head>
<body>
    
    <table class="table table-striped">
        <theader class="thead">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Produto</th>
                <th scope="col">Descriçao</th>
            </tr>
        </thead>
        <tbody>

        <?php 
        $qde=(int)$_GET["qde"];
        $produtos = ["Notebook","TV","Radio","Mesa","Fone","Sofá","Cadeira","Fita Led","Mouse","Teclado"];
        $descricoes = [
            "Notebook Gamer.",
            "Tv 55 polegadas.",
            "Radio JBL bluetooth.",
            "Mesa de escritório.",
            "Fone sem fio.",
            "Sofá retrátil.",
            "Cadeira Gamer Azul.",
            "Fita Led RGB.",
            "Mouse sem fio.",
            "Teclado RGB mecânico."];
            
        for($i=1; $i<=$qde; $i++){
            $aux = rand(0,9);
            echo <<<tbRow
                <tr>
                <th scope="row">$i</th>
                <td> $produtos[$aux] </td>
                <td> $descricoes[$aux] </td>
                </tr>
            tbRow;};
        ?>
        </tbody>
    </table>
</body>
</html>