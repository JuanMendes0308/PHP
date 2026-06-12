<?php
//localhost/API_Pokemon/API/Treinador/getalltreinador.php

use API_Pokemon\Models\Treinador;
use API_Pokemon\Config\Database;

// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../Config/Database.php';
include_once '../../Models/Treinador.php';
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Treinador
$treinador = new Treinador($db);

try {
    //colocar para demonstrar erro com coluna errada mas lá no método read em treinador
    // Chamar o método getall() para buscar os treinadores
    $stmt = $treinador->getall();
    $num = $stmt->rowCount();

    // Verificar se mais de 0 registros foram encontrados
    if ($num > 0) {
        // Array de treinadores
        $treinadores_arr = array();

        // Percorrer o resultado da consulta
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // A função extract transforma $row['nome'] em apenas $nome
            extract($row);

            $treinador_item = array(
                "nome" => $nome,
                "idade" => $idade,
                "altura" => $altura,
                "peso" => $peso,
                "qtdInsignias" => $qtdInsignias,
                "qtdPokemonCapturado" => $qtdPokemonCapturado,
                "qtdPokemonRegistrado" => $qtdPokemonRegistrado,
            );
            array_push($treinadores_arr, $treinador_item);
        }

        // Definir o código de resposta como 200 OK
        http_response_code(200);

        // Mostrar os dados dos treinadores em formato JSON
        echo json_encode($treinadores_arr);

    } else {
        // Se nenhum treinador for encontrado, definir o código de resposta como 404 Not Found
        http_response_code(404);

        // Informar ao usuário que nenhum treinador foi encontrado
        echo json_encode(
            array("Mensagem" => "Nenhum treinador encontrado.")
        );
    }

} catch (PDOException $e) {
    echo json_encode(array("erro" => $e->getMessage()));
}  

catch (Throwable $e) {
    echo json_encode(array("erro" => $e->getMessage()));
}