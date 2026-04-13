<?php
class Pessoa{
    private $idade = '17';
    protected $sobrenome = 'Mendes ';
    public $nome = 'Juan';

    public function getIdade(){
        return $this->idade;
    }

    public function getSobrenome(){
        return $this->sobrenome;
    }

    public function setIdade($value){
        $this->idade = $value;
    }

    public function setSobrenome($value){
        $this->sobrenome = $value;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    private function executarMania(){
        echo "Mexer no cabelo";
    }

    private function responder(){
        echo "Olá, tudo bem?";
    }

    public function executaracao(){
        $x = rand(1,10);
        if($x >= 1 && $x <= 8){
           echo $this->executarMania();
        } else {
           echo $this->responder();
        }
    }
}

$pessoa = new Pessoa();
echo $pessoa->getIdade() . '<br>';
echo $pessoa->getSobrenome() . '<br>';
echo $pessoa->nome . '<br>';
echo "<hr>";
echo $pessoa->executaracao();
?>