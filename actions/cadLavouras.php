<?php
    session_start();
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    $id=$_SESSION['idSojaPlusUser'];
    $hectares = addcslashes(filter_input(INPUT_GET, 'hectares'), "\0..\37");
    $dataPlantio = addcslashes(filter_input(INPUT_GET, 'dataPlantio'), "\0..\37");
    $cidade = addcslashes(filter_input(INPUT_GET, 'cidade'), "\0..\37");


    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO LAVOURA(idUsuario, idCidade, hectares, dataPlantio) VALUES(:idUsuario, :idCidade, :hectares, :dataPlantio)');
    $stmt->bindParam(':idUsuario', $id, PDO::PARAM_INT);
    $stmt->bindParam(':hectares', $hectares, PDO::PARAM_INT);
    $stmt->bindParam(':dataPlantio', $dataPlantio, PDO::PARAM_STR);
    $stmt->bindParam(':idCidade', $cidade, PDO::PARAM_STR);
    $stmt->execute();

    $sql = "SELECT id FROM LAVOURA WHERE idUsuario = '$id' AND idCidade = '$cidade' AND hectares='$hectares' AND dataPlantio='$dataPlantio';";
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    $linha = $consulta->fetch(PDO::FETCH_BOTH);
    $idLavoura= $linha['id'];

    $estagio="V0";
    
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO SOJA(idLavoura, estagio) VALUES(:idLavoura, :estagio)');
    $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_INT);
    $stmt->bindParam(':estagio', $estagio, PDO::PARAM_STR);
    $stmt->execute();
    
    $dados="Lavoura foi cadastrada";

    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO HISTORICO(idLavoura, dados) VALUES(:idLavoura, :dados)');
    $stmt->bindParam(':idLavoura', $idLavoura, PDO::PARAM_INT);
    $stmt->bindParam(':dados', $dados, PDO::PARAM_STR);
    $stmt->execute();

    echo "sucess"; 
?>