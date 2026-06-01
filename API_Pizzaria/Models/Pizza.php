<?php

namespace API_Pizzaria\Models;

class Pizza{
//Propriedade do objeto Pizza

public $id;
public $nome;
public $ingredientes;
public $valor;
private $db;
private $tabela = "pizzas";

//Método construtor

public function __construct($db){
    $this->db = $db;
}

public function getall(){
    $query = "SELECT idPizza, nome, ingredientes, valor FROM " . $this->tabela;

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt;
}

} 