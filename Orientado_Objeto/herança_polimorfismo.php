<?php
abstract class veiculo{

    public $ano = null;
    public $velocidade = null;
    public $cor = null;
    public $nome = null;

    function acelerar(){
        echo "acelerar";
    }

    function freiar(){
        echo "freiar";
    }

    function marcha(){
        echo "Pé para embreagem e mão para passar marchar!";
    }

    function __get($atributo){
        return $this->$atributo;
    }

    function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
}

class carro extends veiculo{
    public $tetosolar;
}

class moto extends veiculo{
    function marcha(){
        echo "mão para embreagem e pé para passar marchar!";
    }
}

Class Caminhao extends Veiculo{
        function cacamba() 
        { echo "Possui caçamba!"; }
}

    $ferrari = new Carro();
    $honda = new Moto();
    $volvo = new Caminhao();

    $ferrari -> __set("nome","Ferrari");
    $ferrari -> __set("cor","Vermelho");
    $ferrari -> __set("velocidade","250 km/h");
    $ferrari -> __set("ano","2024");
    $ferrari -> __set("tetosolar","Sim");

    echo "<b>Carro " . $ferrari ->__get("nome") . "</b>";
    echo "<br/>";
    echo "Cor: " . $ferrari ->__get("cor");
    echo "<br/>";
    echo "Velocidade: " . $ferrari ->__get("velocidade");
    echo "<br/>";
    echo "Ano de Fabricação: " . $ferrari ->__get("ano");
    echo "<br/>";
    echo "Possui teto solar: " . $ferrari ->__get("tetosolar");
    echo "<br/>";
    echo $ferrari->marcha();
    echo "<br/>";     
    echo "<hr>";  

    echo "<b>Moto Honda: </b>";
    echo $honda->marcha();
    echo "<hr>";

    echo "<b>Caminhão Volvo: </b>";
    echo $volvo-> cacamba();
    echo "<hr>";
?>