<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    if (isset($_SESSION['msg'])) {
        ?>
            <script type="text/javascript" defer>
                alert("<?php echo $_SESSION['msg']; ?>");
            </script>
        <?php
        unset($_SESSION['msg']);
    }
    
    if (isset($_SESSION['idSojaPlusUser'])) {
        header('location:index.php');
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Login de Usuário</title>
    <link rel="stylesheet" type="text/css" href="css-adicional/css.css">

    <style type="text/css">
        body{
            background-image: url("img/soja-fundo1.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: "Crimson";
            color: white;
            display: flex;
            font-size: 80.31%;

        }
        .footer{
            position:absolute;
            bottom:0;
            width:100%;
        }
        a{
            color: white;
        }
        input{
            color: white;
            display: flex;
            width: 100%;

        }
        #o1{
            font-size: 1.31%;
        }
         .card{
            size: 100%;
            margin-top: 12%;
            margin-left: 2.6%;
            background-color: rgba(0,0,0,0.8);
            color: white;
        }
        #login{
            object-position: left;
        }
        #texto{
            margin-top: 2.6%;
            margin-right: 2.6%;
            background-color: rgb(51,105,27);
            font-size: 3.9%;
            font-family: "Crimson";
        }
        #forms{
            padding-right: 25.62%;
            padding-left: 25.62%;
        }
    </style>
</head>
<body>
    <br><br><br>
    <div class="row">
        <div id="login" class="col s12" align="center">
            <div id="forms" class="col s12">
            <form action="" method="post">
                <div class="row">
                    <div>
                        <div class="card">
                            <div class="card-action   light-green darken-1 white-text">
                                <h3><img src="img/SojaPlus.png" width="10%"></h3>
                            </div>
                            <div class="card-content">
                                <div class="form-field, input-field">
                                    <label for="username">E-mail</label>
                                    <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" required>
                                <div class="form-text text-danger" id="emailHelp"></div>
                            </div>
                            <div class="form-field, , input-field">
                                <label for="password">Senha</label>
                                <input type="password" name="senha" id="senha" class="form-control" aria-describedby="senhaHelp" required>
                            <div class="form-text text-danger" id="senhaHelp"></div>
                    </div>
                    <div class="form-field">
                        
                        <div class="form-text text-center" id="loading"></div>
                        
                        <button class="btn-large waves-effect  light-green darken-1" style="width:20%;" id="submit">Logar</button>
                        <input type='text' hidden class="form-text text-center" id="request" value="" disable>

                        <div class="col s6">
                            Não possui uma conta?
                            <a href="cad.php">Cadastrar-se</a>
                        </div>
                        <div class="col s6">
                            Esqueceu a Senha?
                            <a href="#">Recuperar Senha</a>
                        </div>
                        <div class="form-field">   
                            <br>
                        </div>
                    </div>
                </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</div>
</div>
</form>
    <footer class="page-footer light-green darken-4" style="position:absolute;
            bottom:0;
            width:100%;">
          <div class="container">
          <div class="footer-copyright">
            <div class="container">
            © 2021 Copyright SojaPlus
            <a class="grey-text text-lighten-4 right" href="#!"></a>
            </div>
          </div>
        </footer>
</body>
<?php /*include('links-script.html');*/?>
<script src="js-adicional/xhttp.js"></script>
<script src="js-adicional/logar.js"></script>
</html>