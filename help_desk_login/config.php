<?php
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('BASE','helpdesk');

$conexao = new mysqli(HOST, USER, PASS, BASE);
$conexao->set_charset('utf8mb4');
?>