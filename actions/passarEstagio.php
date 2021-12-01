<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    session_start();
    
    $idLavoura = filter_input(INPUT_GET, 'idLavoura');
    $id=$_SESSION['idSojaPlusUser'];
    $estagio= filter_input(INPUT_GET, 'prox');

    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare("UPDATE SOJA SET estagio = '$estagio' WHERE idLavoura = '$idLavoura' ");
    $stmt->execute();

    $dados="Passagem para o estágio ".$estagio;

    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO HISTORICO(idLavoura, dados) VALUES(:idLavoura, :dados)');
    $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_INT);
    $stmt->bindParam(':dados', $dados, PDO::PARAM_STR);
    $stmt->execute();

    $_SESSION['msg']="Avançando para próxima estágio da soja";
    header("location: ../Lavoura/index.php");
?>