<?php
 
//localhost/API_Pokemon/API/Pokemon/getpokemon.php
 
//API/Pokemon/getpokemon.php - parte 1
 
// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../Config/Database.php';
include_once '../../Models/Pokemon.php';
 
use API_Pokemon\Config\Database; // Importando a classe Database do namespace Apipizza\Config
use API_Pokemon\Models\Pokemon; // Importando a classe Pokemon do namespace Apipizza\Models
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Pokemon
$pokemon = new Pokemon($db);
 
$pokemon->id = isset($_GET['id']) ? $_GET['id'] : null;
 
try {
 
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ($pokemon->id) {
        // Busca o pokemon
        $pokemon->get();
 
        if($pokemon->nome != null){
        // Cria o array de resposta
        $pokemon_arr = array(
            "id" => $pokemon->id,
            "numPokedex" => $pokemon->numPokedex,
            "nome" => $pokemon->nome,
            "tipo" => $pokemon->tipo,
            "peso" => $pokemon->peso,
            "altura" => $pokemon->altura,
            "fraqueza" => $pokemon->fraqueza,
            "vida" => $pokemon->vida,
            "genero" => $pokemon->genero,
            "ataque" => $pokemon->ataque,
            "defesa" => $pokemon->defesa,
            "ataqueEspecial" => $pokemon->ataqueEspecial,
            "defesaEspecial" => $pokemon->defesaEspecial,
            "velocidade" => $pokemon->velocidade,
            "regiao" => $pokemon->regiao,
            "idTreinador" => $pokemon->idTreinador
        );
        http_response_code(200);
 
        // Converte para JSON e envia a resposta
        // `JSON_PRETTY_PRINT` é opcional, mas deixa o JSON mais legível
        echo json_encode($pokemon_arr, JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(
            array("Mensagem" => "Pokemon não encontrado.")
        );
    }
    }else {
 
            http_response_code(400); // BAD REQUEST : ERRO
            echo json_encode(
                array("Mensagem" => "ID não informado.")
            );
        }
} else {
    http_response_code(405);
    echo json_encode(
        array("Mensagem" => "Método não permitido.")
    );
}}
 
 catch (PDOException $e) {
 
    http_response_code(500);
    echo json_encode(
        array("Mensagem" => "Erro ao buscar o pokemon: " . $e->getMessage())
    );
 
} catch (Throwable $e) {
 
    http_response_code(500);
    echo json_encode(
        array("Mensagem" => "Erro inesperado: " . $e->getMessage())
    );
}