<style type="">
    .lavoura{
        padding: 0%;
        margin-left: 8%;
        margin-right: 8%;
        width:86%;
    }
    tr{
         width: 99%;
    }
    th{
    font-family: 'Julius Sans One', sans-serif;
    background-color: rgba(255,255,255,0.2);
    font-size: 12px;
    color:black;
    border-top:solid 1px #006400;
    border-bottom:solid 1px #006400;
    text-align: center;

}
tr, td{
    color: black;
    font-family: 'Julius Sans One', sans-serif;
    font-size:12px;
    white-space:nowrap;
    border-bottom:solid 1px #006400;
    text-align: center;
}
td{
    border-left:solid 1px #006400;
    border-right: solid 1px #006400;
}
</style>
<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    
    $id = $_SESSION['idSojaPlusUser'];

    echo "<h4 style='font-size: 35px;'class='header center'>Suas lavouras</h4>";
    $sql = "SELECT * FROM LAVOURA WHERE idUsuario = '$id';";
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    while($linha = $consulta->fetch(PDO::FETCH_BOTH)){
        echo '<div class="lavoura" align= "center">
        <table class="centered">
        <thead>
        <tr>
        <th>ID</th>
        <th>Hec</th>
        <th>Data plantio</th>
        <th>N° sensores</th>
        <th>Cidade</th>
        <th>Correção</th>
        <th>Estágio</th>
        <th>Avançar estágio</th>
        <th>Excluir</th>
        <th>Histórico</th>
        <th>Análise de solo</th>

        </tr>';
        foreach($linha as $key => $value){
            $linha[$key]=stripcslashes($value);
        }
        echo "
        <tr>
        <td>".$linha['id']."</td>
        <td>".$linha['hectares']."</td>
        <td>".$linha['dataPlantio']."</td>
        <td>";
        include '../actions/sensores.php';
        echo"</td><td>";
      
        $idCidade=$linha['idCidade'];
        $sql2 = "SELECT nome FROM CIDADE WHERE id = '$idCidade';";
        $pdo2 = Conexao::getInstance();
        $consulta2 = $pdo2->query($sql2);
        $linha2 = $consulta2->fetch(PDO::FETCH_BOTH);
        
        echo '<img src="../img/alto-vale/'.$linha2['nome'].'.png" height="100px">';

        echo "</td><td>";

        $sqlC = "SELECT * FROM CORRECAO WHERE idLavoura = '".$linha['id']."' ORDER BY id DESC;";
        $pdoC = Conexao::getInstance();
        $consultaC = $pdoC->query($sqlC);
        $linhaC=$consultaC->fetch(PDO::FETCH_BOTH);
        if ($linhaC!="") {
            echo '<center>'.$linhaC['retorno'].'<br>Correção proposta na data '.$linhaC['data'].'</center><br>';
        }else{
            echo 'Cadastre seu documento de análise do solo e espere pacientimente';
        }

        echo "</td>";

        echo "<td>";

        $idLavoura=$linha['id'];
        $sql3 = "SELECT estagio FROM SOJA WHERE idLavoura = '$idLavoura';";
        $pdo3 = Conexao::getInstance();
        $consulta3 = $pdo3->query($sql3);
        $linha3 = $consulta3->fetch(PDO::FETCH_BOTH);
        if ($linha3!="") {
            echo '<img src="../img/Estágios da Soja/'.$linha3['estagio'].'.png" height="75px"><br>';
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

            echo "</td>";

            echo "<td>";
            echo '<a href="../actions/passarEstagio.php?idLavoura='.$idLavoura.'&prox='.$proxEstagio.'"><font color="#000000">Avançar estágio</font></a>';
            echo "</td>";

            echo "<td>";
            echo '<a href="../actions/excluir.php?idLavoura='.$idLavoura.'"><font color="#000000">Excluir</font></a>';
            echo "</td>";

            echo "<td>";
            echo '<a href="../actions/historico.php?idLavoura='.$idLavoura.'"><font color="#000000">Emitir</font></a>';
            echo "</td>";

            echo "<td>";
            echo '<a href="../docAnalise/index.php?idLavoura='.$idLavoura.'"><font color="#000000">Adicionar</font></a>';
            echo "</td>";

            $sqlD = "SELECT * FROM DOCANALISE WHERE idLavoura = '".$linha['id']."';";
            $pdoD = Conexao::getInstance();
            $consultaD = $pdo->query($sqlD);
            $linhaD=$consultaD->fetch(PDO::FETCH_BOTH);

            if ($linhaD!="") {
                echo '</tr></table><br><a href="../produto/index.php?idLavoura='.$idLavoura.'" class="btn purple darken-2">Adicionar Produto</a><br><br>';
            }
        
            echo "</tr></table>";
            echo '</div></div>';
        }
    }
    echo "<br><br>";
?>