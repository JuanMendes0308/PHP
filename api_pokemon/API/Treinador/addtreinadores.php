<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
 
include_once '../../Config/Database.php';
include_once '../../Models/Pokemon.php';
 
use API_Pokemon\Config\Database;
use API_Pokemon\Models\Treinador;
 
// Instanciar o banco de dados e conectar
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Treinador
$treinador = new Treinador($db);
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Obter os dados postados
        $data = json_decode(file_get_contents("php://input"));
 
        // Verificar se os dados não estão vazios
        if (
            !empty($data->numPokedex) &&
            !empty($data->nome) &&
            !empty($data->idade) &&
            !empty($data->altura) &&
            !empty($data->peso) &&
            !empty($data->qtdInsignias) &&
            !empty($data->qtdPokemonCapturado) &&
            !empty($data->qtdPokemonRegistrado)
        ) {
            // Atribuir os valores ao objeto Treinadores
            $treinador->nome = $data->nome;
            $treinador->idade = $data->idade;
            $treinador->altura = $data->altura;
            $treinador->peso = $data->peso;
            $treinador->qtdInsignias = $data->qtdInsignias;
            $treinador->qtdPokemonCapturado = $data->qtdPokemonCapturado;
            $treinador->qtdPokemonRegistrado = $data->qtdPokemonRegistrado;
 
            // Criar o treinador
            if ($treinador->add()) {
                http_response_code(201);
                // Resposta de sucesso
                echo json_encode(
                    array('Mensagem' => 'Treinador Criado com Sucesso')
                );
            } else {
                http_response_code(400);
                // Resposta de erro
                echo json_encode(
                    array('Erro' => 'Nao foi possivel criar o Treinador')
                );
            }
        } else {
            http_response_code(400);
            // Resposta se dados estiverem incompletos
            echo json_encode(
                array('Erro' => 'Dados Incompletos. Nao foi possivel criar o Treinador.')
            );
        }
    } catch (Exception $e) {
        echo json_encode(array("Erro" => $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array("Erro" => "Método não suportado!"));
}