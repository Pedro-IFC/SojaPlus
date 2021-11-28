<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    
    $id = $_SESSION['idSojaPlusUser'];

    $sql = "SELECT * FROM LAVOURA WHERE idUsuario = '$id';";
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    while($linha = $consulta->fetch(PDO::FETCH_BOTH)){
        foreach($linha as $key => $value){
            $linha[$key]=stripcslashes($value);
        }
        echo '<center><div class="lavoura"><br>';
        echo "{Código:".$linha['id']."; Hectares: ".$linha['hectares']."; Data de Plantio: ".$linha['dataPlantio']."} ";
        include_once '../actions/sensores.php';
        echo "<br>";
        
        $idCidade=$linha['idCidade'];
        $sql2 = "SELECT nome FROM CIDADE WHERE id = '$idCidade';";
        $pdo2 = Conexao::getInstance();
        $consulta2 = $pdo2->query($sql2);
        $linha2 = $consulta2->fetch(PDO::FETCH_BOTH);
        
        echo '<img src="../img/alto-vale/'.$linha2['nome'].'.png" height="100px"><br><br>';

        $sqlC = "SELECT * FROM CORRECAO WHERE idLavoura = '".$linha['id']."' ORDER BY id DESC;";
        $pdoC = Conexao::getInstance();
        $consultaC = $pdoC->query($sqlC);
        $linhaC=$consultaC->fetch(PDO::FETCH_BOTH);
        echo '<center>Proposta de correção do solo '.$linhaC['retorno'].'</center><br>';

        $idLavoura=$linha['id'];
        $sql3 = "SELECT estagio FROM SOJA WHERE idLavoura = '$idLavoura';";
        $pdo3 = Conexao::getInstance();
        $consulta3 = $pdo3->query($sql3);
        $linha3 = $consulta3->fetch(PDO::FETCH_BOTH);
        if ($linha3!="") {
            echo '<img src="../img/Estágios da Soja/'.$linha3['estagio'].'.png" height="50px"><br>';
            switch ($linha3['estagio']) {
                case 'V0':
                    $proxEstagio="V1";
                break;
                case 'V1':
                    $proxEstagio="V2";
                break;
                case 'V2':
                    $proxEstagio="V3";
                break;
                case 'V3':
                    $proxEstagio="V4";
                break;
                case 'V4':
                    $proxEstagio="V5";
                break;
                case 'V5':
                    $proxEstagio="V6";
                break;
                case 'V6':
                    $proxEstagio="R1";
                break;
                case 'R1':
                    $proxEstagio="R2";
                break;
                case 'R2':
                    $proxEstagio="R3";
                break;
                case 'R3':
                    $proxEstagio="R4";
                break;
                case 'R4':
                    $proxEstagio="R5";
                break;
                case 'R5':
                    $proxEstagio="R5-1";
                break;
                case 'R5-1':
                    $proxEstagio="R5-3";
                break;
                case 'R5-3':
                    $proxEstagio="R5-5";
                break;
                case 'R5-5':
                    $proxEstagio="R6";
                break;
                case 'R6':
                    $proxEstagio="R7";
                break;
                case 'R7':
                    $proxEstagio="F";
                break;
            }
            echo '<a href="../actions/passar-stagio.php?idLavoura='.$idLavoura.'&prox='.$proxEstagio.'">Passar estágio[de '.$linha3['estagio'].' para '.$proxEstagio.']</a>  -  ';
            echo '<a href="alterar.php?idLavoura='.$idLavoura.'">Alterar Lavoura</a>  -  ';
            echo '<a href="../actions/excluir.php?idLavoura='.$idLavoura.'">Excluir Lavoura</a>  -  ';
            echo '<a href="../docAnalise/index.php?idLavoura='.$idLavoura.'">Adicionar docAnalise</a>  -  ';
            echo '<a href="../docAnalise/index.php?idLavoura='.$idLavoura.'">Adicionar Produto</a><br><hr>';
            echo "<br><br>";
            echo '</div></center><br><br>';
        }
    }
    
?>