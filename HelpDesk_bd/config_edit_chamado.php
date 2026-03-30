<?php
    require_once "validador_acesso.php";
    require 'config.php';

    $titulo = $_GET['titulo'];
    $categoria = $_GET['categoria'];
    $id_chamado = $_GET['id_chamado'];
    $descricaotecnico = $_GET['descricaotecnico'];
    $statuschamado = $_GET['status'];
    $valor = $_GET['valor'];

    //Atualização de dados no banco
    $sql = "UPDATE chamados SET titulo = '$titulo', categoria = '$categoria', descricaotecnico = '$descricaotecnico', statuschamado = '$statuschamado', valor = '$valor' WHERE id_chamado = $id_chamado";

    $res = $conexao->query($sql);

        if($res==true){
            //Redirecionando o arquivo e passando os dados para efetivar um aviso com alert em javascript
            header('location: editar_chamado.php?edicao=sucesso');
        } else { header('location: editar_chamado.php?edicao=falha');}
?>