<?php
 
//localhost/API_Pokemon/API/Treinador/gettreinador.php
 
//API/Treinador/gettreinador.php - parte 1
 
// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../Config/Database.php';
include_once '../../Models/Treinador.php';
 
use API_Pokemon\Config\Database; // Importando a classe Database do namespace Apipizza\Config
use API_Pokemon\Models\Treinador; // Importando a classe Treinador do namespace Apipizza\Models
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Treinador
$treinador = new Treinador($db);
 
$treinador->id = isset($_GET['id']) ? $_GET['id'] : null;
 
try {
 
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ($treinador->id) {
        // Busca o treinador
        $treinador->get();
 
        if($treinador->nome != null){
        // Cria o array de resposta
        $treinador_arr = array(
            "id" => $treinador->id,
            "nome" => $treinador->nome,
            "idade" => $treinador->idade,
            "altura" => $treinador->altura,
            "peso" => $treinador->peso,
            "qtdInsignias" => $treinador->qtdInsignias,
            "qtdPokemonCapturado" => $treinador->qtdPokemonCapturado,
            "qtdPokemonRegistrado" => $treinador->qtdPokemonRegistrado
        );
        }
 
        // Converte para JSON e envia a resposta
        // `JSON_PRETTY_PRINT` é opcional, mas deixa o JSON mais legível
        echo json_encode($treinador_arr, JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(
            array("Mensagem" => "Treinador não encontrado.")
        );
    }
} else {
    http_response_code(405);
    echo json_encode(
        array("Mensagem" => "Método não permitido.")
    );
}
 
} catch (PDOException $e) {
 
    http_response_code(500);
    echo json_encode(
        array("Mensagem" => "Erro ao buscar o treinador: " . $e->getMessage())
    );
 
} catch (Throwable $e) {
 
    http_response_code(500);
    echo json_encode(
        array("Mensagem" => "Erro inesperado: " . $e->getMessage())
    );
}