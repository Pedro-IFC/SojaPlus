<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php
    session_start();
    if (!isset($_SESSION['idSojaPlusUser'])) {
        header('location: index.php');
    }
    ?>
    <meta charset="UTF-8">
    <title>Cadastro Lavoura</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="../img/SojaPlus.png">
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


    </script>


    <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');
        body{
            background-image: url("../img/soja-fundo.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Open Sans";
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
            font-family: "Open Sans";
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
                                <h3>CADASTRO DE LAVOURA</h3>
                            </div>
                            <div class="card-content">
                        <div class="col s6">
                            <div class="form-field, input-field white-text">
                            <label for="hectares" class="form-label" >Hectares</label>
                            <input type="number" name="hectares" id="hectares" class="form-control white-text" aria-describedby="hectaresHelp" required min="1">
                            <div class="form-text text-danger" id="hectaresHelp"></div>
                        </div>

                        <div class="form-field input-field">
                            <div class="input-field col s6">
                              <select id="cidade">
                                <option value="1">Agrolândia</option>
                                <option value="2">Agronômica</option>
                                <option value="3">Atalanta</option>
                                <option value="4">Aurora</option>
                                <option value="5">Braço do Trombudo</option>
                                <option value="6">Chapadão do Lageado</option>
                                <option value="7">Dona Emma</option>
                                <option value="8">Ibirama</option>
                                <option value="9">Imbuia</option>
                                <option value="10">José Boiteux</option>
                                <option value="11">Laurentino</option>
                                <option value="12">Lontras</option>
                                <option value="13">Mirim Doce</option>
                                <option value="14">Petrolândia</option>
                                <option value="15">Pouso Redondo</option>
                                <option value="16">Presidente</option>
                                <option value="17">Presidente Nereu</option>
                                <option value="18">Rio do Campo</option>
                                <option value="19">Rio do Oeste</option>
                                <option value="20">Rio do Sul</option>
                                <option value="21">Salete</option>
                                <option value="22">Santa Terezinha</option>
                                <option value="23">Taió</option>
                                <option value="24">Trombudo Central</option>
                                <option value="25">Vidal Ramos</option>
                                <option value="26">Vitor Meireles</option>
                                <option value="27">Witmarsum</option>
                              </select>
                              <label>Escolha a cidade</label>
                            <div class="form-text text-danger" id="cidadeHelp"></div>
                        </div>
                    </div>
                    </div>

                    <div class="col s6">
                        <div class="form-field, , input-field">
                            <label for="dataPlantio" class="form-label">Data de Plantio</label>
                            <input type="date" placeholder="" name="dataPlantio" id="dataPlantio" class="form-control white-text" aria-describedby="dataNascHelp" required>
                            <div class="form-text text-danger" id="dataPlantioHelp"></div>
                        </div>
                    </div>

                    
                    <div class="form-field">
                        <button class="btn-large waves-effect  light-green darken-1" style="width:50%;" id="submit">Cadastrar</button>
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
<script src="../js-adicional/cadastrarLavoura.js"></script>
 <footer class="page-footer light-green darken-4" style="position:absolute;
            bottom:0;
            width:100%;">
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