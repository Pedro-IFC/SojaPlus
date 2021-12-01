<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    $sql = "SELECT * FROM EXCLUIR";
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    
    while($linha = $consulta->fetch(PDO::FETCH_BOTH)){
        $id=$linha['idUsuario'];

        $sql = "SELECT * FROM LAVOURA WHERE idUsuario= '$id';";
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $linha2 = $consulta->fetch(PDO::FETCH_BOTH);
        
        if ($linha2!="") {
            $idLavoura=$linha2['id'];
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
        }

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE FROM USUARIO WHERE id= :id ;');
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE FROM EXCLUIR WHERE id= :idE ;');
        $stmt->bindParam(":idE", $linha['id'], PDO::PARAM_STR);
        $stmt->execute();
    }
?>