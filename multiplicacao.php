<?php
function semReturn(){
    $resultado = 6 * 7;
    echo 'O resultado de 6 x 7 é ' . $resultado;
}

function comReturn(){
    $num1 = 10;
    $num2 = 30;

    $result = $num1 * $num2;

    return $result;
}

semReturn();
echo '<br> <hr>';
echo 'O resultado de 10 x 30 é ' . comReturn();
?>