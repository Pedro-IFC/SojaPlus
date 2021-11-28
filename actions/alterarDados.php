<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    session_start();

    $id=$_SESSION['idSojaPlusUser'];

    $campo = addcslashes(filter_input(INPUT_GET, 'campo'), "\0..\37");
    $value = addcslashes(filter_input(INPUT_GET, 'value'), "\0..\37");
    
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare("UPDATE USUARIO SET $campo ='$value' WHERE id = '$id';");
    $stmt->execute();

    echo "sucess";
?>