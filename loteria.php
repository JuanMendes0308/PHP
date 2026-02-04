<?php 

$numeros = [];
while (count($numeros) <= 5) {

    $num = rand(1, 60);
    if (!in_array($num, $numeros)){
        $numeros[] = $num;
    }
}

echo '<pre>';
print_r($numeros);
echo '</pre>';

?>