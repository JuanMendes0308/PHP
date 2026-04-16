<?php
class Calculadora
{
    public static function somar($a, $b)
    {
        return $a + $b;
    }

    public static function subtrair($a, $b)
    {
        return $a - $b;
    }

    public static function multiplicar($a, $b)
    {
        return $a * $b;
    }

    public static function dividir($a, $b)
    {
        if ($b == 0) {
            return "Erro: Divisão por zero não é permitida.";
        }
        return $a / $b;
    }
}

// Acesso direto via operador de resolução de escopo (::)
echo Calculadora::somar(10, 5);
echo "<br>";
echo Calculadora::subtrair(10, 5);
echo "<br>";
echo Calculadora::multiplicar(10, 5);
echo "<br>";
echo Calculadora::dividir(10, 5);

?>