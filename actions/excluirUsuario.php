<?php
    session_start();
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    
    if (!isset($_SESSION['idSojaPlusUser'])) {
    	header("location: ../index.php");
    }else{
    	$id=$_SESSION['idSojaPlusUser'];
        $pdo = Conexao::getInstance();
    	
        $stmt = $pdo->prepare('INSERT INTO EXCLUIR(idUsuario) VALUES(:id)');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        unset($_SESSION['idSojaPlusUser']);
        $_SESSION['msg']="O usuário será excluido após 15 dias de inatividade";
        echo 'sucess';
    }
?>