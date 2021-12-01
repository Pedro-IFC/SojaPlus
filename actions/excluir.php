<?php
    session_start();
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    
    if (!isset($_SESSION['idSojaPlusUser'])) {
    	header("location: ../index.php");
    }else{
    	
    	$id=$_SESSION['idSojaPlusUser'];
    	$idLavoura=addcslashes(filter_input(INPUT_GET, 'idLavoura'), "\0..\37");

    	$sql = "SELECT * FROM LAVOURA WHERE id='$idLavoura' AND idUsuario= '$id';";
    	$pdo = Conexao::getInstance();
    	$consulta = $pdo->query($sql);
    	$linha = $consulta->fetch(PDO::FETCH_BOTH);
    	
    	if ($linha!="") {
    		$pdo = Conexao::getInstance();
    		$stmt = $pdo->prepare('DELETE FROM SOJA WHERE idLavoura = :idLavoura ;');
    		$stmt->bindParam(":idLavoura", $idLavoura, PDO::PARAM_STR);
    		$stmt->execute();

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('DELETE FROM SENSORES WHERE idLavoura = :idLavoura;');
            $stmt->bindParam(":idLavoura", $idLavoura, PDO::PARAM_STR);
            $stmt->execute();
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('DELETE FROM HISTORICO WHERE idLavoura = :idLavoura;');
            $stmt->bindParam(":idLavoura", $idLavoura, PDO::PARAM_STR);
            $stmt->execute();
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('DELETE FROM PRODUTOSQUIMICOS WHERE idLavoura = :idLavoura;');
            $stmt->bindParam(":idLavoura", $idLavoura, PDO::PARAM_STR);
            $stmt->execute();
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('DELETE FROM CORRECAO WHERE idLavoura = :idLavoura;');
            $stmt->bindParam(":idLavoura", $idLavoura, PDO::PARAM_STR);
            $stmt->execute();
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('DELETE FROM DOCANALISE WHERE idLavoura = :idLavoura;');
            $stmt->bindParam(":idLavoura", $idLavoura, PDO::PARAM_STR);
            $stmt->execute();
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('DELETE FROM SENSORESHISTORICO WHERE idLavoura = :idLavoura;');
            $stmt->bindParam(":idLavoura", $idLavoura, PDO::PARAM_STR);
            $stmt->execute();

    		$pdo = Conexao::getInstance();
    		$stmt = $pdo->prepare('DELETE FROM LAVOURA WHERE id= :idLavoura ;');
    		$stmt->bindParam(":idLavoura", $idLavoura, PDO::PARAM_STR);
    		$stmt->execute();

    		$_SESSION['msg']="Excluido com sucesso";
    		header("location: ../Lavoura/index.php");
    	}else{
    		$_SESSION['msg']="Não existe uma lavoura cadastrada com este Id para este usuário";
    		header("location: ../Lavoura/index.php");
    	}
    }
?>