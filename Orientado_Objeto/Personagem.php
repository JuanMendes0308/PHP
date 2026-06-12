<?php
class Pokemon{
    public $nome = null;
    public $peso = null;
    public $altura = null;

    function resumirCadPokemon() {
        return "$this->nome tem $this->peso kg e $this->altura m de altura";
    }

    function modificarNome($nome) {
        $this->nome = $nome;
    }

    function modificarPeso($peso) {
        $this->peso = $peso;
    }

    function modificarAltura($altura) {
        $this->altura = $altura;
    }
}

$pokemon1 = new Pokemon;
$pokemon1->modificarNome("Pikachu");
$pokemon1->modificarPeso(6.0);
$pokemon1->modificarAltura(0.40);
echo $pokemon1->resumirCadPokemon();

echo "<br>";

$pokemon2 = new Pokemon;
$pokemon2->modificarNome("Charizard");
$pokemon2->modificarPeso(90.5);
$pokemon2->modificarAltura(1.70);
echo $pokemon2->resumirCadPokemon();

echo "<br>";

$pokemon3 = new Pokemon;
$pokemon3->modificarNome("Rayquaza");
$pokemon3->modificarPeso(206.5);
$pokemon3->modificarAltura(7.00);
echo $pokemon3->resumirCadPokemon();
?>