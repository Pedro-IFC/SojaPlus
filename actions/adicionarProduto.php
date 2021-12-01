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
        $stmt = $pdo->prepare('INSERT INTO PRODUTOSQUIMICOS(idLavoura, subs, quant) VALUES(:idLavoura, :sub, :p)');
        $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_INT);
        $stmt->bindParam(':p', $P, PDO::PARAM_INT);
        $sub="P";
        $stmt->bindParam(':sub', $sub, PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $pdo->prepare('INSERT INTO PRODUTOSQUIMICOS(idLavoura, subs, quant) VALUES(:idLavoura, :sub, :k)');
        $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_INT);
        $stmt->bindParam(':k', $K, PDO::PARAM_INT);
        $sub="K";
        $stmt->bindParam(':sub', $sub, PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $pdo->prepare('INSERT INTO PRODUTOSQUIMICOS(idLavoura, subs, quant) VALUES(:idLavoura, :sub, :ca)');
        $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_INT);
        $stmt->bindParam(':ca', $Ca, PDO::PARAM_INT);
        $sub="Ca";
        $stmt->bindParam(':sub', $sub, PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $pdo->prepare('INSERT INTO PRODUTOSQUIMICOS(idLavoura, subs, quant) VALUES(:idLavoura, :sub, :Mg)');
        $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_INT);
        $stmt->bindParam(':Mg', $Mg, PDO::PARAM_INT);
        $sub="Mg";
        $stmt->bindParam(':sub', $sub, PDO::PARAM_STR);
        $stmt->execute();

        $sql = "SELECT * FROM docanalise WHERE idLavoura = '$idLavoura' ORDER BY id DESC LIMIT 1";
        $consulta = $pdo->query($sql);
        $linha=$consulta->fetch(PDO::FETCH_BOTH);
        $p=$linha['P']+$P;
        $k=$linha['K']+$K;
        $Mg=$linha['Mg']+$Ca;
        $Ca=$linha['Ca']+$Mg;
        $idD=$linha['id'];

        $stmt = $pdo->prepare("UPDATE DOCANALISE SET P ='$p', K ='$k', Mg ='$Mg', Ca ='$Ca' WHERE id = '$idD';");
        $stmt->execute();

        $dados="Adicionados produtos à lavoura";

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO HISTORICO(idLavoura, dados) VALUES(:idLavoura, :dados)');
        $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_INT);
        $stmt->bindParam(':dados', $dados, PDO::PARAM_STR);
        $stmt->execute();

		echo "sucess";       
        unset($_SESSION['idLavoura']);	
    }
?>
