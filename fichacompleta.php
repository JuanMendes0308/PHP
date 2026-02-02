<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $nome= 'Juan';
    $idade= '17';
    $salario= '1.100';

    // opção 1:
    $fichacompleta = '<strong>Nome: </strong>' . $nome .
    '<br>' . "<strong>Idade: </strong>" . $idade .
    '<br>'. "<strong>Salário: </strong>" . $salario;
    echo "opção 1: " . $fichacompleta;
    echo '<hr>';

    // opção 2:     
    $fichacompleta = "Nome: $nome - ";
    $fichacompleta .= "Idade: $idade - ";
    $fichacompleta .= "salário:  $salario. ";
    echo 'opção 2: ' . $fichacompleta . "<hr>";

    //opção 3:
    $fichacompleta = "Meu nome é {$nome}, tenho {$idade} anos e recebo {$salario} reais.";
    echo 'opção 3: ' . $fichacompleta . '<hr>';

    //opção 4:
    echo "opção 4: Meu nome é {$nome}, tenho {$idade} anos e recebo {$salario} reais.";
    ?>
</body>
</html>