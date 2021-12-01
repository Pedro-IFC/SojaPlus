<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once '../menu2.html';
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    session_start();
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
    <meta charset="UTF-8">
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
            color: white;
            margin-bottom: 0px;
            padding-bottom: 0px;
            border-bottom:0px;
        }
        a{
            color: white;
        }
        input{
            color: white;
        }
        form{
            color: white;
        }
        #o1{
            font-size: 18px;
        }
        .card{
            background-color: rgba(0,0,0,0.8);
            color: white;
            margin-right: 12px;
            margin-left: 12px;
        }
        #cad{
            background-color: rgba(0,0,0,0.8);
            margin-right: 200px;
            margin-left: 200px;
        }
        #login{
            object-position: left;
        }
        #texto{
            /*margin-top: 20px;
            margin-right: 20px;*/
            background-color: rgb(51,105,27);
            font-size: 30px;
            font-family: "Crimson";
        }
        .footer{
            position:absolute;
            bottom:0;
            width:100%;
        }

    </style>
    <meta charset="UTF-8">
    <title>Principal</title>

</head>
<body>
<div class="row" >
<div id="login" class="col s12" align="center">
    <div id="forms" class="col s12">
        <form action="" method="post" id="cad">
            <div class="row">
                <div>
                    <div class="card">
                        <div class="card-action   light-green darken-1 white-text">
                                <h3>DADOS DO AGRICULTOR</h3>
                            </div>
                            <div class="card-content">
                                <div class="col s6">
                                        <div class="form-field, input-field white-text">
                                            <label for="nome" >Nome</label>
                                            <input type="text" placeholder= "" name="nome" id="nome" class="form-control white-text" aria-describedby="nomeHelp" required value="<?php echo $linha['nome']?>">
                                        </div>
                                        <div class="form-field, input-field white-text">
                                            <label for="sobrenome">Sobrenome</label>
        	                                <input type="text" placeholder= "" name="sobrenome" id="sobrenome" class="form-control white-text" aria-describedby="sobrenomeHelp" required value="<?php echo $linha['sobrenome']?>">
        	                            </div>
                                </div>

                                <div class="col s6">
                                        <div class="form-field, input-field white-text">
                                            <label for="genero" class="form-label">Sexo</label><br>
                                            
                                            <p>
                                                <label>
                                                    <input name="genero" type="radio" id="genero1" value="M" <?php if($linha['genero']=="M") echo "checked"; ?>>
                                                    <span>Masculino</span>
                                                </label>
                                            </p>

                                            <p>
                                                <label>
                                                    <input name="genero" type="radio" id="genero2" value="F" <?php if($linha['genero']=="F") echo "checked"; ?>>
                                                    <span>Feminino</span>
                                                </label>
                                            </p>
                                        </div>
                                    <div class="form-field, input-field white-text">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input type="email" placeholder= "" name="email" id="email" class="form-control white-text" aria-describedby="emailHelp" required value="<?php echo $linha['email']?>">
                                     </div>
                                 </div>

                                 <div class="col s6">
                                     <div class="form-field, input-field white-text">
                                            <label for="telefone" class="form-label">Telefone</label>
                                            <input type="tel" placeholder= "" name="telefone" id="telefone" class="form-control white-text" aria-describedby="telefoneHelp" required value="<?php echo $linha['telefone']?>">
                                    </div>
                                    <div class="form-field, input-field white-text">
                                            <input type="text" placeholder= "" name="cnpj" id="cnpj" class="form-control white-text" aria-describedby="emailHelp" required value="<?php echo $linha['CNPJ']?>">
                                            <label for="cnpj" class="form-label">CNPJ</label>
                                    </div>
                                </div>

                                 <div class="col s6">
                                    <a class="btn-large waves-effect  light-green darken-1" style="width:50%;" id="excluir">Excluir</a>
                                    <div class="form-text text-center" id="loading"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
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
<script src="../js-adicional/xhttp.js"></script>
<script src="../js-adicional/alterarAgronomo.js" defer></script>
</body>
</html>