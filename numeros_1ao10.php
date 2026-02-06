<?php
$numeros = [10, 5, 7, 8, 9];



echo $numeros [2];
echo '<br>';

$resultado = $numeros[2] * $numeros[4];

echo $resultado;

$num = rand(1, 10);
    if (!in_array($num, $numeros)){
        $numeros[] = $num;
    }
    else {
        echo '<br>'. 'O número ' . $num . ' já existe no array';
    }

echo '<pre>';
print_r($numeros);
echo '</pre>';
?>