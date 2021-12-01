<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

	session_start();

	$id = $_SESSION['idSojaPlusUser'];
	$keyReturn = $_GET['key'];

	$sql = "SELECT * FROM USUARIO WHERE id = '$id';";
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    $linha = $consulta->fetch(PDO::FETCH_BOTH);
    foreach($linha as $key => $value){
        $linha[$key]=stripcslashes($value);
    }
    
    $linha['key']=$keyReturn;

    echo json_encode($linha);
?>