<?php

namespace API_Pokemon\Models;
use PDO;
use PDOException;

class Pokemon{
//Propriedade do objeto Pokemon

public $id;
public $numPokedex;
public $nome;
public $tipo;
public $peso;
public $altura;
public $fraqueza;
public $vida;
public $genero;
public $ataque;
public $defesa;
public $ataqueEspecial;
public $defesaEspecial;
public $velocidade;
public $regiao;
public $idTreinador;
private $db;
private $tabela = "pokemon";

//Método construtor

public function __construct($db){
    $this->db = $db;
}

public function getall(){
    $query = "SELECT idPokemon, numPokedex, nome, tipo, peso, altura, fraqueza, vida, genero, ataque, defesa, ataqueEspecial, defesaEspecial, velocidade, regiao, idTreinador FROM " . $this->tabela;

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt;
}

public function get(){
 // Cria a consulta
        $query = 'SELECT
                p.idPokemon,
                p.nome,
                p.numPokedex,
                p.tipo,
                p.peso,
                p.altura,
                p.fraqueza,
                p.vida,
                p.genero,
                p.ataque,
                p.defesa,
                p.ataqueEspecial,
                p.defesaEspecial,
                p.velocidade,
                p.regiao,
                p.idTreinador
            FROM
                ' . $this->tabela . ' p
            WHERE
                p.idPokemon = ?    
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
        $this->numPokedex = $row['numPokedex'];
        $this->tipo = $row['tipo'];
        $this->peso = $row['peso'];
        $this->altura = $row['altura'];
        $this->fraqueza = $row['fraqueza'];
        $this->vida = $row['vida'];
        $this->genero = $row['genero'];
        $this->ataque = $row['ataque'];
        $this->defesa = $row['defesa'];
        $this->ataqueEspecial = $row['ataqueEspecial'];
        $this->defesaEspecial = $row['defesaEspecial'];
        $this->velocidade = $row['velocidade'];
        $this->regiao = $row['regiao'];
        $this->idTreinador = $row['idTreinador'];
}

public function add(){
// Query de inserção
        $query = 'INSERT INTO ' . $this->tabela . ' (nome, numPokedex, tipo, peso, altura, fraqueza, vida, genero, ataque, defesa, ataqueEspecial, defesaEspecial, velocidade, regiao, idTreinador) '.
        ' VALUES (:nome, :numPokedex, :tipo, :peso, :altura, :fraqueza, :vida, :genero, :ataque, :defesa, :ataqueEspecial, :defesaEspecial, :velocidade, :regiao, :idTreinador)';
 
        // Preparar a query
        $stmt = $this->db->prepare($query);
 
        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':numPokedex', $this->numPokedex);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':altura', $this->altura);
        $stmt->bindParam(':fraqueza', $this->fraqueza);
        $stmt->bindParam(':vida', $this->vida);
        $stmt->bindParam(':genero', $this->genero);
        $stmt->bindParam(':ataque', $this->ataque);
        $stmt->bindParam(':defesa', $this->defesa);
        $stmt->bindParam(':ataqueEspecial', $this->ataqueEspecial);
        $stmt->bindParam(':defesaEspecial', $this->defesaEspecial);
        $stmt->bindParam(':velocidade', $this->velocidade);
        $stmt->bindParam(':regiao', $this->regiao);
        $stmt->bindParam(':idTreinador', $this->idTreinador);
 
        // Executar a query
        if ($stmt->execute()) {
            return true;
        }        
        return false;

} 

    public function update(){
 
 // Query de atualização
            $query = 'UPDATE ' . $this->tabela. ' SET numPokedex=:numPokedex, nome=:nome, tipo=:tipo, peso=:peso, altura=:altura, fraqueza=:fraqueza, vida=:vida, genero=:genero, ataque=:ataque, defesa=:defesa, ataqueEspecial=:ataqueEspecial, defesaEspecial=:defesaEspecial, velocidade=:velocidade, regiao=:regiao, idTreinador=:idTreinador WHERE idPokemon=:id';
   
            // Preparar a query
            $stmt = $this->db->prepare($query);
                 
            // Vincular os parâmetros
            $stmt->bindParam(':numPokedex', $this->numPokedex);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':peso', $this->peso);
            $stmt->bindParam(':altura', $this->altura);
            $stmt->bindParam(':fraqueza', $this->fraqueza);
            $stmt->bindParam(':vida', $this->vida);
            $stmt->bindParam(':genero', $this->genero);
            $stmt->bindParam(':ataque', $this->ataque);
            $stmt->bindParam(':defesa', $this->defesa);
            $stmt->bindParam(':ataqueEspecial', $this->ataqueEspecial);
            $stmt->bindParam(':defesaEspecial', $this->defesaEspecial);
            $stmt->bindParam(':velocidade', $this->velocidade);
            $stmt->bindParam(':regiao', $this->regiao);
            $stmt->bindParam(':idTreinador', $this->idTreinador);
            $stmt->bindParam(':id', $this->id);
   
            // Executar a query
            if($stmt->execute()) {
                return true;
            }
         
            return false;
 
    }
}