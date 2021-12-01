<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    
    $email = filter_input(INPUT_GET, 'email');
    $senha = md5(filter_input(INPUT_GET, 'senha'));

    $sql = "SELECT count(*) FROM USUARIO WHERE email = '$email'";
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    $linha = $consulta->fetch(PDO::FETCH_BOTH);

    if ($linha['count(*)']==0) {
        echo 'email';
    } else {
        $sql = "SELECT id FROM USUARIO WHERE email = '$email' AND senha = '$senha'";
        $consulta = $pdo->query($sql);
        $linha = $consulta->fetch(PDO::FETCH_BOTH);
        if (isset($linha['id'])) {
            session_start();
            $_SESSION['idSojaPlusUser'] = $linha['id'];

            $stmt = $pdo->prepare('DELETE FROM EXCLUIR WHERE idUsuario = :idUsuario ;');
            $stmt->bindParam(":idUsuario", $_SESSION['idSojaPlusUser'], PDO::PARAM_STR);
            $stmt->execute();

            echo '1';
        } else {
            echo 'senha';
        }
    }
?>