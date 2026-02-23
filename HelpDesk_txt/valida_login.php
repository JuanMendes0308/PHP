<?php
session_start();

// Usuários pré-cadastrados
$usuarios = array(
    ['id' => '1',
    'perfil' => 'adm',
    'nome' => 'Juan',
    'email' => 'juanmendes0308@gmail.com',
    'senha' => '0308'],

    ['id' => '2',
    'perfil' => 'user',
    'nome' => 'Lívia',
    'email' => 'liviasd@gmail.com',
    'senha' => '2204'],

    ['id' => '3',
    'perfil' => 'user',
    'nome' => 'Caio',
    'email' => 'caioac@gmail.com',
    'senha' => '1107']
);

$usuarioAutenticado = false;

$emailUsuario = $_GET['email'];
$senhaUsuario = $_GET['senha'];

for ($idx = 0; $idx < count($usuarios); $idx ++) {
    if($emailUsuario == $usuarios[$idx]['email'] && $senhaUsuario == $usuarios[$idx]['senha']){
        $usuarioAutenticado = true;
        $_SESSION['id'] = $usuarios[$idx]['id'];
        $_SESSION['perfil'] = $usuarios[$idx]['perfil'];
        $usuarios['nome'] = $usuarios[$idx]['nome'];
        break;
    }else{
        $usuarioAutenticado = false;
    }
}

if($usuarioAutenticado){
    $_SESSION['autenticado'] = 'sim';
    header('location: home.php');
}else{
    $_SESSION['autenticado'] = 'nao';
    header('location: index.php?login=erro');
}

?>