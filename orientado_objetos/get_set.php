<?php
class Funcionario {
        
        public $nome = null;
        public $sobrenome = null;
        public $telefone = null;
        public $numFilhos = null;
        public $cargo = null;
        public $salario = null;
        public $musica = null;
        public $esporte = null;
        public $altura = null;
        public $peso = null;

        function setNome($nome){
            $this->nome = $nome;
        }

        function getNome(){
            return $this->nome;
        }

        function resumirCadFunc() {
            return "$this->nome possui $this->numFilhos filho(s)";
        } 

        function setNumFilhos($numFilhos){
            $this->numFilhos = $numFilhos;
        }

        function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        function __get($atributo){
            return $this->$atributo;
           
        }

        function getNumFilhos(){
            return $this->numFilhos;
        }
    
    }
    ?>