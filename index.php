<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        body{
            font-family: "Crimson";
            color: white;
            text-align: center;

        }
        .footer{
            position:absolute;
            bottom:0;
            width:100%;
        }
        .icon-block, h2, h5, h1{
            color: black;
        }
    </style>
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
    <meta charset="UTF-8">
    <title>Principal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <body>
  <?php  require_once 'menu.html'?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center"><?php echo "Bem vind".$identifier." ".ucfirst($linha['nome']); ?></h1>
      <br><br>

    </div>
  </div>

  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m6">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="large material-icons">account_circle</i></h2>
            <h5 class="center">
                <div>
                    <center>
                    <h5><a href="./Agricultor/index.php">Área do agricultor</a></h5>
                </center></h5>

            <p class="light">Acesse a área do agricultor e atualize seus dados</p>
          </div>
        </div>


        <div class="col s12 m6">
          <div class="icon-block">
            <div class="circulo">
            <h2 class="center light-blue-text"><i class="large material-icons">spa</i></h2>
            <h5 class="center"><center>
            <h5><a href="./Lavoura/index.php">Área da Soja</a></h5>
            </center></h5>

            <p class="light">Acesse a área da soja e monitore o desenvolvimento da sua lavoura</p>
          </div>
          </div>
        </div>
      </div>

    </div>
    <br><br>
  </div>

 <footer class="page-footer light-green darken-4">
          <div class="container">
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!"></a>
            </div>
          </div>
        </footer>
</body>
</html>