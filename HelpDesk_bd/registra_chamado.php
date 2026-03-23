<?php
    require_once "validador_acesso.php";
    require 'config.php';

    $titulo = $_GET['titulo'];
    $categoria = $_GET['categoria'];
    $descricao = $_GET['descricao'];
    $id_usuario = $_SESSION['id'];
    $statuschamado = 'Aberto';

    //Inserção de dados no banco
    $sql = "INSERT INTO chamados(titulo, categoria, descricao, id_usuario, statuschamado) VALUES('{$titulo}', '{$categoria}', '{$descricao}', '{$id_usuario}', '{$statuschamado}')";

    $res = $conexao->query($sql);

        if($res==true){
            //Redirecionando o arquivo e passando os dados para efetivar um aviso com alert em javascript
            header('location: abrir_chamado.php?cadastro=efetuado');
        } else { header('location: abrir_chamado.php?cadastro=falha');}
?>