<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    
    $idLavoura = filter_input(INPUT_GET, 'idLavoura');

    $sql = "SELECT count(*) FROM HISTORICO WHERE idLavoura = '$idLavoura'";
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    $linha = $consulta->fetch(PDO::FETCH_BOTH);

    if ($linha['count(*)']==0) {
        header("location:../Lavoura/index.php");
    } else {
        $sql = "SELECT * FROM HISTORICO WHERE idLavoura = '$idLavoura' ORDER BY `DATA` ";
        $consulta = $pdo->query($sql);
        while($linha = $consulta->fetch(PDO::FETCH_BOTH)){
            echo $linha['data']." - ".$linha['dados']."<br><br>";
            $data=$linha['data'];
            if ($linha['dados']=="Documento de análise do solo cadastrado") {
                $sqlS = "SELECT * FROM DOCANALISE WHERE idLavoura = '$idLavoura' AND `DATA` = '$data'";
                $consultaS = $pdo->query($sqlS);
                $subLinha=$consultaS->fetch(PDO::FETCH_BOTH);
                echo "<blockquote>P: ".$subLinha['P']." mg/dm³<br>";
                echo "K: ".$subLinha['K']." mg/dm³<br>";
                echo "Mg: ".$subLinha['Mg']." mg/dm³<br>";
                echo "Ca: ".$subLinha['Ca']." mg/dm³</blockquote><br><br>";
            }elseif($linha['dados']=="Correção cadastrada"){
                $sqlS = "SELECT * FROM CORRECAO WHERE idLavoura = '$idLavoura' AND `DATA` = '$data'";
                $consultaS = $pdo->query($sqlS);
                $subLinha=$consultaS->fetch(PDO::FETCH_BOTH);
                echo "<blockquote>".$subLinha['retorno']."</blockquote><br><br>";
            }elseif($linha['dados']==""){

            }
        }
        
    }
?>