<?php
//localhost/API_Pokemon/API/Pokemon/getallpokemon.php

use API_Pokemon\Models\Pokemon;
use API_Pokemon\Config\Database;

// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../Config/Database.php';
include_once '../../Models/Pokemon.php';
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Pokemon
$pokemon = new Pokemon($db);

try {
    //colocar para demonstrar erro com coluna errada mas lá no método read em pokemon
    // Chamar o método getall() para buscar os pokemons
    $stmt = $pokemon->getall();
    $num = $stmt->rowCount();

    // Verificar se mais de 0 registros foram encontrados
    if ($num > 0) {
        // Array de pokemons
        $pokemons_arr = array();

        // Percorrer o resultado da consulta
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // A função extract transforma $row['nome'] em apenas $nome
            extract($row);

            $pokemon_item = array(
                "id" => $idPokemon,
                "numPokedex" => $numPokedex,
                "nome" => $nome,
                "tipo" => $tipo,
                "peso" => $peso,
                "altura" => $altura,
                "fraqueza" => $fraqueza,
                "vida" => $vida,
                "genero" => $genero,
                "ataque" => $ataque,
                "defesa" => $defesa,
                "ataqueEspecial" => $ataqueEspecial,
                "defesaEspecial" => $defesaEspecial,
                "velocidade" => $velocidade,
                "regiao" => $regiao,
                "idTreinador" => $idTreinador
            );
            array_push($pokemons_arr, $pokemon_item);
        }

        // Definir o código de resposta como 200 OK
        http_response_code(200);

        // Mostrar os dados dos pokemons em formato JSON
        echo json_encode($pokemons_arr);

    } else {
        // Se nenhum pokemon for encontrado, definir o código de resposta como 404 Not Found
        http_response_code(404);

        // Informar ao usuário que nenhum pokemon foi encontrado
        echo json_encode(
            array("Mensagem" => "Nenhum pokemon encontrado.")
        );
    }

} catch (PDOException $e) {
    echo json_encode(array("erro" => $e->getMessage()));
}
catch (Throwable $e) {
    echo json_encode(array("erro" => $e->getMessage()));
}