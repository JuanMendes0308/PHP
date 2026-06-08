<?php

namespace API_Pizzaria\Models;
use PDO;
use PDOException;

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

public function get(){
 // Cria a consulta
        $query = 'SELECT
                p.idPizza,
                p.nome,
                p.ingredientes,
                p.valor
            FROM
                ' . $this->tabela . ' p
            WHERE
                p.idPizza = ?    
            LIMIT 1';
 
        // Prepara a query
        $stmt = $this->db->prepare($query);
 
        // Vincula o ID
        $stmt->bindParam(1, $this->id);
       
        // Executa a query
        $stmt->execute();
 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // Define as propriedades
        $this->nome = $row['nome'];
        $this->ingredientes = $row['ingredientes'];
        $this->valor = $row['valor'];
}

public function add(){
// Query de inserção
        $query = 'INSERT INTO ' . $this->tabela . ' (nome, ingredientes, valor) '.
        ' VALUES (:nome, :ingredientes, :valor)';
 
        // Preparar a query
        $stmt = $this->db->prepare($query);
 
        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':ingredientes', $this->ingredientes);
        $stmt->bindParam(':valor', $this->valor);
 
        // Executar a query
        if ($stmt->execute()) {
            return true;
        }        
        return false;

} 
}