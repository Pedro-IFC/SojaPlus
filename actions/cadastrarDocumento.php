<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    session_start();

    if (!isset($_SESSION['idSojaPlusUser'])) {
        header("location: ../index.php");
    }else{
        $id=$_SESSION['idSojaPlusUser'];
        $idLavoura=$_SESSION['idLavoura'];

        $quant=addcslashes(filter_input(INPUT_GET, 'quant'), "\0..\37");
        $P=explode(',',$quant)[0];
        $K=explode(',',$quant)[1];
        $Ca=explode(',',$quant)[2];
        $Mg =explode(',',$quant)[3];

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO docanalise(idLavoura, P, K, Ca, Mg) VALUES(:idLavoura, :P, :K, :Ca, :Mg)');
        $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_STR);
        $stmt->bindParam(':P', $P, PDO::PARAM_STR);
        $stmt->bindParam(':K', $K, PDO::PARAM_STR);
        $stmt->bindParam(':Ca', $Ca, PDO::PARAM_STR);
        $stmt->bindParam(':Mg', $Mg, PDO::PARAM_STR);
        $stmt->execute();

        
        $dados="Documento de análise do solo cadastrado";

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO HISTORICO(idLavoura, dados) VALUES(:idLavoura, :dados)');
        $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_INT);
        $stmt->bindParam(':dados', $dados, PDO::PARAM_STR);
        $stmt->execute();

		echo "sucess";       
        unset($_SESSION['idLavoura']);	
    }
?>
