<?php
$salarioBruto = $_GET['salario'];
 
function calcularIR($salarioBruto) {
    if ($salarioBruto < 1903.98) {
    echo 'Isento de imposto de renda.';
    }
    else if ($salarioBruto >= 1903.98 && $salarioBruto <= 2826.65) {
        echo 'Alíquota de 7,5% <br> Imposto a pagar: R$ ' . ($salarioBruto * 0.075);
    }
    else if ($salarioBruto > 2826.65 && $salarioBruto <= 3751.05) {
        echo 'Alíquota de 15% <br> Imposto a pagar: R$ ' . ($salarioBruto * 0.15);
    }
    else if ($salarioBruto > 3751.05 && $salarioBruto <= 4664.68) {
        echo 'Alíquota de 22,5% <br> Imposto a pagar: R$ ' . ($salarioBruto * 0.225);
    }
    else {
        echo 'Alíquota de 27,5% <br> Imposto a pagar: R$ ' . ($salarioBruto * 0.275);
    }
}
 
 
 
echo calcularIR($salarioBruto);
 
?>