<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title></title>
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <div id="index-banner" class="parallax-container">
    <?php
      require_once 'menu.html';
      ?>
    <?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    session_start();
    if (!isset($_SESSION['idSojaPlusUser'])) {
        header('location:login.php'); 
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

        //identificando a forma pela qual o usuário será chamado
        $identifier= $linha['genero']=="M"? "o" : "a";
    }
    ?>
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 style="font-size: 90px;" class="header center teal-text text-darken-4">SOJA PLUS</h1>
        <div class="row center">
          <h5 class="header col s12 light">Sistema de análise e correção de solo para lavouras de soja</h5>
        </div>
        <br><br>
      </div>
    </div>
    <div class="parallax"><img src="ceuAzul.jpg" alt="Unsplashed background img 1"></div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m6">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="large material-icons">account_circle</i></h2>
            <h5 align="center"><a href="./Agricultor/index.php"><font color="#006400">Área do agricultor</font></a></h5>
          </div>
        </div>

        <div class="col s12 m6">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="large material-icons">spa</i></h2>
           <h5 class="center"><a href="./Lavoura/index.php"><font color="#006400">Área da soja</font></a></h5>
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
    <div class="parallax"><img src="img/soja-fundo.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send brown-text"></i></h3>
          <h4>Entre em contato</h4>
          <p class="center-align light">Para mais informações, ligue (47) 9 9106-0276</p>
        </div>
      </div>

    </div>
  </div>


  <footer class="page-footer light-green darken-4">
          <div class="container">
          <div class="footer-copyright">
            <div class="container" align="center">
            © 2021 Copyright SojaPlus
            <a class="grey-text text-lighten-4 right" href="#!"></a>
            </div>
          </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
