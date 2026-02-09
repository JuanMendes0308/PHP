    <?php
    $nome = $_POST['nome'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $imc = $peso / ($altura * $altura);

    echo 'Olá ' . $nome . ' seu Imc é de: ' . round($imc, 2) . '</br>';

    if ($imc < 18.5) {
        echo 'Você está abaixo do peso!';
    } else if ($imc == 18.5 || $imc < 24.9) {
        echo'Você está no peso ideal!';
    } else {
        echo'Você está acima do peso!';
    }
    ?>