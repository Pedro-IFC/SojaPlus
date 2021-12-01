<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    session_start();

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
            $campo = addcslashes(filter_input(INPUT_GET, 'campo'), "\0..\37");
            $value = addcslashes(filter_input(INPUT_GET, 'value'), "\0..\37");
            
            if($campo=="cidade"){
                $campo='idCidade';
            }

            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE LAVOURA SET $campo ='$value' WHERE id = '$idLavoura';");
            $stmt->execute();

            echo "sucess";       
        }else{
            echo "Não há uma lavoura cadastrada com este Id para este usuário";
        }
    }
?>