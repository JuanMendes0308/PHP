<?php
 
require_once __DIR__ . "/Config/Database.php";

use API_Pizzaria\Config\Database;
 
echo "<h1>Testando Conexão com o Banco de Dados</h1>";
 
$database = new Database();
$conexao = $database->getConnection();
 
if ($conexao) {
    echo "<p style='color: green;'>Conexão bem-sucedida!</p>";
} else {
    echo "<p style='color: red;'>Falha na conexão. Verifique as credenciais no arquivo config/Database.php e se o banco de dados 'pizzaria_db' existe.</p>";
}
?>