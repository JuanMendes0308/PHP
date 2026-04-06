<?php
    require_once("get_set.php");

    $y = new Funcionario();

    $y->setNome("Goku");
    $y->setNumFilhos(0);

    $y->__set("cargo","Professor");
    $y->__set("salario","9.999,00");

    echo "Teste funcionário Y: </br>";
    echo $y->resumirCadFunc();
    echo "</br>";

    echo $y->getNome() ." possui ". $y->getNumFilhos() ." filho(s)";
    echo "</br>";

    echo "Seu cargo é ".$y->__get("cargo")." e recebe R$". $y->__get("salario")."<hr>";

    $x = new Funcionario();
    echo "Teste funcionário X: </br>";
    $x-> __set("nome","Juan");
    $x-> __set("telefone","(13) 99633-6273");
    $x-> __set("numFilhos","0");
    $x-> __set("cargo","Analista de Sistemas");
    $x-> __set("salario","25.500,00");

    echo "Funcionario X: </br>";
    echo $x-> __get("nome") . " possui " . $x -> __get("numFilhos") . " filhos</br>";
    echo "Telefone: " . $x-> __get("telefone") . ", seu cargo é " . $x->__get("cargo") . " e recebe R$" . $x->__get("salario");

    $m = new Funcionario();
    $m-> __set("nome","Robinho");
    $m-> __set("sobrenome","Jr");
    $m-> __set("musica","trap");
    $m-> __set("esporte","futebol");
    echo "<hr>";
    echo "Teste funcionário M: </br>";
    echo $m-> __get("nome") . " " . $m-> __get("sobrenome") . " ama " . $m-> __get("musica") . " e joga " . $m-> __get("esporte");
?>