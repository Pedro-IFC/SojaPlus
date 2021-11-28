<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    session_start();
    if (isset($_SESSION['msg'])) {
        ?>
            <script type="text/javascript">
                alert("<?php echo $_SESSION['msg']; ?>");
            </script>
        <?php
        unset($_SESSION['msg']);
    }
    
    if (!isset($_SESSION['idSojaPlusUser'])) {
        header('location: ../login.php'); 
    } else {
        $id = $_SESSION['id'];
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
    <meta charset="UTF-8">
    <title>Principal</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Cadastro</title>

      <style type="text/css">
        body{
            background-image: url("../img/soja-fundo.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Crimson";
            color: black;
            margin-bottom: 0px;
            padding-bottom: 0px;
            border-bottom:0px;
        }
        .footer{
            position:absolute;
            bottom:0;
            width:100%;
        }
        h1, h5, .icon-block{
            color: black;
        }
        .lavoura{
            background-color: rgba(255, 255, 255);
            border-radius: 30px;
            width: 60%;
            align-items: center;
        }
        .horizontal{
            align-self: center;
            align-text: center;
            align-content: center;
            text-align: center;
        }
    </style>
</head>
<body>
  <?php  require_once '../menu2.html'?>
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
        <div class="col s12 m12">
          <div class="icon-block">
            <div class="circulo">
            <h2 class="center light-blue-text"><i class="large material-icons">spa</i></h2>
            <h5 class="center"><center>
            <h5><a href="cadLavoura.php">Cadastrar Lavoura</a></h5>
            </center></h5>
          </div>
          </div>
        </div>
      </div>
    </div>
    <br><br>
  </div>

<?php include_once "../actions/includeLavouras.php"; ?>

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