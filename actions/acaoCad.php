<?php
    session_start();
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    $nome = addcslashes(filter_input(INPUT_GET, 'nome'), "\0..\37");
    $sobrenome = addcslashes(filter_input(INPUT_GET, 'sobrenome'), "\0..\37");
    $dataNasc = addcslashes(filter_input(INPUT_GET, 'dataNasc'), "\0..\37");
    $cpf = addcslashes(filter_input(INPUT_GET, 'cpf'), "\0..\37");
    $cnpj = addcslashes(filter_input(INPUT_GET, 'cnpj'), "\0..\37");
    $genero = addcslashes(filter_input(INPUT_GET, 'genero'), "\0..\37");
    $telefone = addcslashes(filter_input(INPUT_GET, 'telefone'), "\0..\37");
    $email = addcslashes(filter_input(INPUT_GET, 'email'), "\0..\37");
    $senha = md5(addcslashes(filter_input(INPUT_GET, 'senha'), "\0..\37"));


    $sql = "SELECT count(*) FROM USUARIO WHERE email = '$email';";
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    $linha = $consulta->fetch(PDO::FETCH_BOTH);
    if ($linha['count(*)']>0) {
        echo 'E-mail já foi cadastrado no sistema!';
    } else {
        $sql = "SELECT count(*) FROM USUARIO WHERE telefone = '$telefone';";
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $linha = $consulta->fetch(PDO::FETCH_BOTH);
        if ($linha['count(*)']>0) {
            echo "Telefone já foi cadastrado no sistema!";
        }else{
            $sql = "SELECT count(*) FROM USUARIO WHERE CPF = '$cpf';";
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query($sql);
            $linha = $consulta->fetch(PDO::FETCH_BOTH);
            if ($linha['count(*)']>0) {
                echo "CPF já foi cadastrado no sistema!";
            }else{
                $sql = "SELECT count(*) FROM USUARIO WHERE CNPJ = '$cnpj';";
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query($sql);
                $linha = $consulta->fetch(PDO::FETCH_BOTH);
                if ($linha['count(*)']>0) {
                    echo "CNPJ já foi cadastrado no sistema!";
                }else{
                    $pdo = Conexao::getInstance();
                    $stmt = $pdo->prepare('INSERT INTO USUARIO(nome, sobrenome, dataNasc, email, CPF, telefone, senha, genero, CNPJ) VALUES(:nome, :sobrenome, :dataNasc, :email, :cpf, :telefone, :senha, :genero, :cnpj)');
                    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
                    $stmt->bindParam(':sobrenome', $sobrenome, PDO::PARAM_STR);
                    $stmt->bindParam(':dataNasc', $dataNasc, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
                    $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
                    $stmt->bindParam(':genero', $genero, PDO::PARAM_STR);
                    $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
                    $stmt->execute();

                    $sql = "SELECT id FROM USUARIO WHERE email = '$email' OR telefone = '$telefone';";
                    $pdo = Conexao::getInstance();
                    $consulta = $pdo->query($sql);
                    $linha = $consulta->fetch(PDO::FETCH_BOTH);
                    $_SESSION['idSojaPlusUser'] = $linha['id'];

                    echo "sucess"; 
                }
            }  
        }
    }
?>