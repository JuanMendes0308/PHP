<?php

namespace API_Pokemon\Models;
use PDO;
use PDOException;

class Treinador{
//Propriedade do objeto Treinador

public $id;
public $nome;
public $idade;
public $altura;
public $peso;
public $qtdInsignias;
public $qtdPokemonCapturado;
public $qtdPokemonRegistrado;
private $db;
private $tabela = "treinador";

//Método construtor

public function __construct($db){
    $this->db = $db;
}

public function getall(){
    $query = "SELECT nome, idade, altura, peso, qtdInsignias, qtdPokemonCapturado, qtdPokemonRegistrado FROM " . $this->tabela;

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt;
}

public function get(){
 // Cria a consulta
        $query = 'SELECT
                p.idTreinador,
                p.nome,
                p.idade,
                p.altura,
                p.peso,
                p.qtdInsignias,
                p.qtdPokemonCapturado,
                p.qtdPokemonRegistrado
            FROM
                ' . $this->tabela . ' p
            WHERE
                p.idTreinador = ?    
            LIMIT 1';
 
        // Prepara a query
        $stmt = $this->db->prepare($query);
 
        // Vincula o ID
        $stmt->bindParam(1, $this->id);
       
        // Executa a query
        $stmt->execute();
 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // Define as propriedades
        if($row){
        $this->nome = $row['nome'];
        $this->idade = $row['idade'];
        $this->altura = $row['altura'];
        $this->peso = $row['peso'];
        $this->qtdInsignias = $row['qtdInsignias'];
        $this->qtdPokemonCapturado = $row['qtdPokemonCapturado'];
        $this->qtdPokemonRegistrado = $row['qtdPokemonRegistrado'];
}{
        $this->nome = null;
    }
}
              
public function add(){
// Query de inserção
        $query = 'INSERT INTO ' . $this->tabela . ' (nome, idade, altura, peso, qtdInsignias, qtdPokemonCapturado, qtdPokemonRegistrado) '.
        ' VALUES (:nome, :idade, :altura, :peso, :qtdInsignias, :qtdPokemonCapturado, :qtdPokemonRegistrado)';
 
        // Preparar a query
        $stmt = $this->db->prepare($query);
 
        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':altura', $this->altura);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':qtdInsignias', $this->qtdInsignias);
        $stmt->bindParam(':qtdPokemonCapturado', $this->qtdPokemonCapturado);
        $stmt->bindParam(':qtdPokemonRegistrado', $this->qtdPokemonRegistrado);
 

        // Executar a query
        if ($stmt->execute()) {
            return true;
        }        
        return false;

} 

    public function update(){
 
 // Query de atualização
            $query = 'UPDATE ' . $this->tabela. ' SET nome=:nome, idade=:idade, altura=:altura, peso=:peso, qtdInsignias=:qtdInsignias, qtdPokemonCapturado=:qtdPokemonCapturado, qtdPokemonRegistrado=:qtdPokemonRegistrado WHERE idTreinador=:id';
   
            // Preparar a query
            $stmt = $this->db->prepare($query);
                 
            // Vincular os parâmetros
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':idade', $this->idade);
            $stmt->bindParam(':altura', $this->altura);
            $stmt->bindParam(':peso', $this->peso);
            $stmt->bindParam(':qtdInsignias', $this->qtdInsignias);
            $stmt->bindParam(':qtdPokemonCapturado', $this->qtdPokemonCapturado);
            $stmt->bindParam(':qtdPokemonRegistrado', $this->qtdPokemonRegistrado);
            $stmt->bindParam(':id', $this->id);
   
            // Executar a query
            if($stmt->execute()) {
                return true;
            }
         
            return false;
 
    }

    public function delete(){
        // Query de exclusão
        $query = 'DELETE FROM ' . $this->tabela . ' WHERE idTreinador = :id';
 
        // Preparar a query
        $stmt = $this->db->prepare($query);
 
        // Vincular o ID
        $stmt->bindParam(':id', $this->id);
 
        // Executar a query
        if ($stmt->execute()) {
            return true;
        }
         
        return false;
    }
}