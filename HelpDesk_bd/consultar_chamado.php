<?php

require_once "validador_acesso.php";

//ARRAY DE CHAMADOS
$chamados = [];

//CAMINHO DO ARQUIVO
$caminho = '../../../help_desk_login/registros.txt';

$arquivo = fopen($caminho , 'r');

//LER O ARQUIVO SE VAI ENTRAR OU NAO
while(!feof($arquivo)){

$registro = fgets($arquivo);
//PEGA O REGISTRO DE UM ARRAY VAI TER OS CHAMADOS
$chamados[] = $registro;
}

fclose($arquivo);  //FECHA

?>

<html>

<head>
<meta charset="utf-8" />
<title>App Help Desk</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<style>

.card-consultar-chamado{
padding:30px 0 0 0;
width:100%;
margin:0 auto;
}

</style>

</head>

<body>

<nav class="navbar navbar-dark bg-dark">
<a class="navbar-brand" href="#">
<img src="logo.png" width="30" height="30">
App Help Desk
</a>
</nav>

<div class="container">    
<div class="row">

<div class="card-consultar-chamado">
<div class="card">

<div class="card-header">
Consulta de chamado
</div>

<div class="card-body">

<?php
foreach($chamados as $chamado){

$chamado_dados = explode('|', $chamado);

//VERIFICA SE TEM 4 CAMPOS
if(count($chamado_dados) < 4){
continue;
}

//FILTRO DE USUÁRIO

//SE FOR USUÁRIO COMUM
if(isset($_SESSION['perfil']) && $_SESSION['perfil'] == 'user'){  //SE FOR ADM (VE TUDO) USER (VE SOMENTE O DELE)

    if($_SESSION['id'] != $chamado_dados[0]){
        continue;
    }

}
?>

<div class="card mb-3 bg-light">

<div class="card-body">

<h5 class="card-title">
<?= $chamado_dados[1] ?>
</h5>

<h6 class="card-subtitle mb-2 text-muted">
<?= $chamado_dados[2] ?>
</h6>

<p class="card-text">
<?=($chamado_dados[3]) 

?>
</p>

</div>

</div>

<?php } ?> <!--TERMINA AQUI-->

<div class="row mt-5">
<div class="col-6">

<a href="home.php" class="btn btn-lg btn-warning btn-block">
Voltar
</a>

</div>
</div>

</div>
</div>
</div>

</div>
</div>
</div>

</body>

</html>