<?php
    require_once "validador_acesso.php";
    require 'config.php';

    $titulo = $_GET['titulo'];
    $categoria = $_GET['categoria'];
    $descricao = $_GET['descricao'];
    $id_usuario = $_SESSION['id'];
    $statuschamado = 'Aberto';

    $sql = "INSERT INTO chamados(titulo, categoria, descricao, id_usuario, statuschamado) VALUES('{$titulo}', '{$categoria}', '{$descricao}', '{$id_usuario}', '{$statuschamado}')";

    $res = $conexao->query($sql);

        if($res==true){
            header('location: abrir_chamado.php?cadastro=efetuado');
        } else { header('location: abrir_chamado.php?cadastro=falha');}
?>