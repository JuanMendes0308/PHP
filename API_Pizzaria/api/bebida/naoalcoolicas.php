<?php
//localhost/API_PIZZARIA/api/pizza/getall.php

use API_Pizzaria\Models\Bebida;
use API_Pizzaria\Config\Database;

// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../Config/Database.php';
include_once '../../Models/Bebida.php';
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Bebida
$bebida = new Bebida($db);

$query = "SELECT * FROM bebidas where categoria = 'Não alcoólica'";
$stmt = $db->prepare($query);
$stmt->execute();

$bebida = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($bebida);