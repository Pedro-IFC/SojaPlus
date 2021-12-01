<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php
    session_start();
    if (isset($_SESSION['idSojaPlusUser'])) {
        header('location:index.php');
    }
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Cadastro</title>

      <style type="text/css">
        body{
            background-image: url("img/soja-fundo.jpg");
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
</head>
<body>
<br><br>
<div class="row" >
<div id="login" class="col s12" align="center">
    <div id="forms" class="col s12">
        <form action="" method="post" id="cad">
            <div class="row">
                <div>
                    <div class="card">
                        <div class="card-action   light-green darken-1 white-text">
                                <h3>CADASTRO</h3>
                            </div>
                            <div class="card-content">
                        <div class="col s6">
                            <div class="form-field, input-field white-text">
                            <label for="nome" class="form-label" >Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control white-text" aria-describedby="nomeHelp" required>
                            <div class="form-text text-danger" id="nomeHelp"></div>
                        </div>

                        <div class="form-field, , input-field">
                            <label for="sobrenome" class="form-label">Sobrenome</label>
                            <input type="text" name="sobrenome" id="sobrenome" class="form-control white-text" aria-describedby="sobrenomeHelp" required>
                            <div class="form-text text-danger" id="sobrenomeHelp"></div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="form-field, , input-field">
                            <label for="dataNasc" class="form-label">Data de Nascimento</label>
                            <input type="date"  placeholder= "" name="dataNasc" id="dataNasc" class="form-control white-text" aria-describedby="dataNascHelp" required>
                            <div class="form-text text-danger" id="dataNascHelp"></div>
                        </div>

                        <div class="form-field, , input-field">
                            <label for="sexo" class="form-label">Sexo</label><br>
                              <p>
                                <label>
                                <input name="group1" type="radio" name="sexo" id="sexo" value="M" checked />
                                <span>Masculino</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                <input name="group1" type="radio" name="sexo" id="sexo" value="F"/>
                                <span>Feminino</span>
                                </label>
                            </p>
                            <div class="form-text text-danger" id="sexoHelp"></div>
                        </div>
                    </div>

                    <div class="col s6">
                        <div class="form-field, , input-field">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control white-text" aria-describedby="emailHelp" required>
                            <div class="form-text text-danger" id="emailHelp"></div>
                        </div>

                        <div class="form-field, , input-field">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" name="telefone" id="telefone" class="form-control white-text" aria-describedby="telefoneHelp" required>
                            <div class="form-text text-danger" id="telefoneHelp"></div>
                        </div>
                    </div>

                    <div class="col s6">
                       <div class="form-field, , input-field">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control white-text" aria-describedby="emailHelp" required>
                            <div class="form-text text-danger" id="cpfHelp"></div>
                        </div>

                        <div class="form-field, , input-field">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" name="cnpj" id="cnpj" class="form-control white-text" aria-describedby="emailHelp" required>
                            <div class="form-text text-danger" id="cnpjHelp"></div>
                        </div>
                    </div>

                    <div class="col s6">
                       <div class="form-field, , input-field">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" name="senha" id="senha" class="form-control white-text" aria-describedby="senhaHelp" required min="6">
                            <div class="form-text text-danger" id="senhaHelp"></div>
                        </div>
                
                        <div class="form-field, , input-field">
                            <label for="confSenha" class="form-label">Confirmação de Senha</label>
                            <input type="password" name="senhaConfirm" id="confSenha" class="form-control white-text" aria-describedby="confSenhaHelp" required min="6">
                            <div class="form-text text-danger" id="confSenhaHelp"></div>
                    </div>
                </div>

                <div class="col s6">
                        <div class="form-field">
                            Já possui uma conta?<a href="login.php">Logar-se</a>
                        </div>
                    <div class="form-field">
                           <button class="btn-large waves-effect  light-green darken-1" style="width:50%;" id="submit">Cadastrar-se</button>
                        <div class="form-text text-center" id="loading"></div>
                    </div>
                </div>
                <div class="form-field, , input-field"></div>
                        </div>
                      </div>
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
</div>
</form>
        <footer class="page-footer light-green darken-4">
          <div class="container">
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!"></a>
            </div>
          </div>
        </footer>
<script src="js-adicional/xhttp.js"></script>
<script src="js-adicional/cadastrar.js"></script>
</body>
</html>