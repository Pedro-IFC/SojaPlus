<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    if (!isset($_SESSION['idSojaPlusUser'])) {
        header("location: ../index.php");
    }else{
        $id=$_SESSION['idSojaPlusUser'];
        $idLavoura=$linha['id'];

        $sqlS = "SELECT * FROM LAVOURA WHERE id='$idLavoura' AND idUsuario= '$id';";
        $pdo = Conexao::getInstance();
        $consultaS = $pdo->query($sqlS);
        $linhaS = $consultaS->fetch(PDO::FETCH_BOTH);
        
        if ($linhaS!="") {

            $sqlS2 = "SELECT count(*) FROM SENSORES WHERE idLavoura='$idLavoura';";
            $pdo = Conexao::getInstance();
            $consultaS2 = $pdo->query($sqlS2);
            $linhaS2 = $consultaS2->fetch(PDO::FETCH_BOTH);
            
            echo $linhaS2['count(*)'];
        }else{
            echo "Não há uma lavoura cadastrada com este Id para este usuário<br>";
        }
    }
?>