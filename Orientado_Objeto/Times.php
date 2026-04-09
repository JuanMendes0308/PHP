<?php
abstract class times{
    public $nome = null;
    public $titulos = null;
    public $anoFundacao = null;
    public $estado = null;
    public $estadio = null;
    public $tecnico = null;
    public $capitao = null;
    public $titulosNacionais = null;
    public $titulosInternacionais = null;
    public $titulosEstaduais = null;

    function __get($atributo){
        return $this->$atributo;
    }

    function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    
}
?>