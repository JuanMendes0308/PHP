<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="doador.php" method="POST">
        <label for="idade">Idade:</label>
        <input type="text" name="idade" id="idade" placeholder="Ex: 18">

        <label for="peso">Peso:</label>
        <input type="number" name="peso" id="peso" placeholder="Ex: 65.9" step="0.10">

        <button type="submit">Calcular</button>
    </form>

<?php

$idade = $_POST['idade'];
$peso = $_POST['peso'];

if ($idade > 16 and $idade < 69 and $peso >= 50){
    echo 'Atende aos requisitos';
}
else{
    echo "Não atende aos requisitos";
}

?>
</body>
</html>