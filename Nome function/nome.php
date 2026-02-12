<?php

$nome = $_POST['nome'];
function bemVindo(){
    echo 'Bem Vindo ' . $_POST['nome'] . '!';     
}

function bemVindo2($nome){
    echo 'Bem Vindo ' . $nome . '!'; 
}

bemVindo();
echo '<br> <hr>';
bemVindo2($nome);
?>