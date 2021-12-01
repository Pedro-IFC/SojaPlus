<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php
    session_start();
    if (!isset($_SESSION['idSojaPlusUser'])) {
        header('location: index.php');
    }
    $_SESSION['idLavoura']=$_GET['idLavoura'];
    ?>
    <meta charset="UTF-8">
    <title>Cadastro de Produto</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/SojaPlus.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

     <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems, options);
        });

        $(document).ready(function(){
        $('select').formSelect();
        });

        var instance = M.FormSelect.getInstance(elem);
        <?php 
            if(isset($_GET['idLavoura'])){ 
                $_SESSION['ídLavoura']=$_GET['idLavoura'];
            }else{ 
                header("Location: ../Lavoura/index.php");
            }
        ?>
    </script>


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
            margin-right: 200px;
            margin-left: 200px;
        }
        #cad{
            background-color: rgba(0,0,0,0.8);
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
</head>
<body>
    <?php  require_once '../menu2.html'?>
    <br><br>
     <div class="row" >
        <div id="login" class="col s12" align="center">
            <div id="forms" class="col s12">
            <form action="" method="post">
                <div class="row">
                    <div>
                        <div class="card">
                            <div class="card-action light-green darken-1 white-text">
                                <h3>Adicionar Produto</h3>
                            </div>
                            <div class="card-content">
                        <div class="col s6">
                            <div class="form-field, input-field white-text">
                            <label for="quant" class="form-label" >Quantidade por elemento(mg/dm³)(P,K,Ca,Mg)</label>
                            <input type="text" name="quant" id="quant" class="form-control white-text" aria-describedby="hectaresHelp" required min="1">
                            <div class="form-text text-danger" id="quantHelp"></div>
                        </div>

                        <div class="form-field input-field">
                            <div class="input-field col s6">
                                      
                        </div>
                    </div>
                    </div>
                    
                    <div class="form-field">
                        <button class="btn-large waves-effect  light-green darken-1" style="width:50%;" id="submit">Adicionar</button>
                        <div class="form-text text-center" id="loading"></div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<script src="../js-adicional/xhttp.js"></script>
<script src="../js-adicional/adicionarProduto.js"></script>
 <footer class="page-footer light-green darken-4" style="position:absolute;
            bottom:0;
            width:100%;">
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