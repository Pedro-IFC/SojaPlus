<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title></title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<style type="text/css">
  #historico{
    margin-top: 20px;
    border-radius: 35px;    
    background-color: #C0C0C0;
  }
  #marged{
    margin-top: 40px;
    margin-left: 60px;
    margin-bottom: 40px;
  }
</style>
<body>
  <div id="index-banner" class="parallax-container">
    <?php
      require_once '../menu2.html';
      ?>
       <?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    session_start();
    if (isset($_SESSION['msg'])) {
        ?>
            <script type="text/javascript" defer>
                alert("<?php echo $_SESSION['msg']; ?>");
            </script>
        <?php
        unset($_SESSION['msg']);
    }
    
    if (!isset($_SESSION['idSojaPlusUser'])) {
        header('location: ../login.php'); 
    } else {
        $id = $_SESSION['idSojaPlusUser'];
        $sql = "SELECT * FROM usuario WHERE id = '$id'";
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $linha = $consulta->fetch(PDO::FETCH_BOTH);

        //desfazendo a conversão de caracteres especiais de padrão C
        foreach($linha as $key => $value){
            $linha[$key]=stripcslashes($value);
        }


        $identifier = $linha['genero']=="M"? "o" : "a";


        $sobrenome = explode(" ", $linha['sobrenome']);
        $sobrenomeF="";
        foreach($sobrenome as $key => $value){
            $sobrenomeF =$sobrenomeF." ".ucfirst($sobrenome[$key]);
        }
    }
    ?>
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 style="font-size: 90px;"class="header center"><?php echo "Bem vind".$identifier." ".ucfirst($linha['nome']); ?></h1>
        <div class="row center">
          <h5 class="header col s12 light">Monitore seu histórico de lavoura</h5>
        </div>
        <br><br>
      </div>
    </div>
    <div class="parallax"><img src="../ceuAzul.jpg" alt="Unsplashed background img 1"></div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->

        <div class="col s12 m6">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="large material-icons">spa</i></h2>
           <h5 class="center"><a href="cadLavoura.php"><font color="#006400">Histórico de lavoura [<?php echo $_GET['idLavoura']; ?>]</font></a></h5>
          </div>
        </div>

    </div>
  </div>
</div>

  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          
        </div>
      </div>
    </div>
    <div class="parallax"><img src="../img/soja-fundo.jpg" alt="Unsplashed background img 2"></div>
  </div>
        <div id="historico" class="centered container">
            <br>
            <div id="marged">
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
                                while($subLinha=$consultaS->fetch(PDO::FETCH_BOTH)){
                                  echo "<blockquote>".$subLinha['retorno']."</blockquote><br><br>";
                                }
                            }elseif($linha['dados']=="Adicionados produtos à lavoura"){
                                $sqlS = "SELECT * FROM PRODUTOSQUIMICOS WHERE idLavoura = '$idLavoura' AND `DATA` = '$data'";
                                $consultaS = $pdo->query($sqlS);
                                echo "<blockquote>";
                                while($subLinha=$consultaS->fetch(PDO::FETCH_BOTH)){
                                  echo $subLinha['subs'].": ".$subLinha['quant']." mg/dm³<br>";
                                }
                                echo "</blockquote><br><br>";
                            }
                        }
                        
                    }
                ?>
            </div>
            <br>
        </div><br>
        <div class="center">
            <button class="btn purple darken-2" onclick='imprimirElemento(document.querySelector("#historico"))'>Imprimir</button>
        </div><br><br>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js-adicional/imprimir.js"></script>

<footer class="page-footer light-green darken-4" >
          <div class="container">
          <div class="footer-copyright">
            <div class="container" align="center">
            © 2021 Copyright SojaPlus
            <a class="grey-text text-lighten-4 right" href="#!"></a>
            </div>
          </div>
  </footer>
  </body>
</html>