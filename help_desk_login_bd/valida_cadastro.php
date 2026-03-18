<?php
    include ('config.php');
   
    $sql = "SELECT * FROM usuarios WHERE email = '{$_GET['email']}'";
    $res = $conexao->query($sql);

    if ($res->num_rows > 0) {
        header('location: cadastro.php?email=erro');
        exit();
    }   

    if($_GET['perfil'] === "-- Selecione --")
    {
        header('location: cadastro.php?validaperfil=erro');
    } else {

        $nome = $_GET['nome'];
        $email = $_GET['email'];
        $senha = md5($_GET['senha']);
        $perfil = $_GET['perfil'];

        $sql = "INSERT INTO usuarios(nome, email, senha, perfil) VALUES('{$nome}', '{$email}', '{$senha}', '{$perfil}')";
        $res = $conexao->query($sql);

        if($res==true){
            header('location: index.php?usuario=sucesso');
        } else { header('location: cadastro.php?usuario=falha');}
    }
?>