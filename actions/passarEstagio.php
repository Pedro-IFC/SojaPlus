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

    $_SESSION['msg']="Avançando para próxima estágio da soja";
    header("location: ../Lavoura/index.php");
?>