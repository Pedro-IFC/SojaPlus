<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    session_start();
    
    if (!isset($_SESSION['idSojaPlusUser'])) {
        header('location: ../login.php'); 
    } else {
        $id = $_SESSION['id'];
        $idLavoura=addcslashes(filter_input(INPUT_GET, 'idLavoura'), "\0..\37");


        $sql = "SELECT * FROM LAVOURA WHERE id = '$idLavoura' AND idUsuario='$id'";
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        $linha = $consulta->fetch(PDO::FETCH_BOTH);

        //desfazendo a conversão de caracteres especiais de padrão C
        foreach($linha as $key => $value){
            $linha[$key]=stripcslashes($value);
        }    
    }
    ?>
    <meta charset="UTF-8">
    <title>Principal</title>

</head>
<body>
    <h1>Alterar Lavoura</h1>
    <div>
    	<center>
            <h2><a href="index.php">Voltar a navegação na página principal</a></h2>
        </center>
        <br>
        	<label for="hectares" class="form-label" >Hectares</label>
        	<input type="text" name="hectares" id="hectares" class="form-control white-text" aria-describedby="hectaresHelp" required value="<?php echo $linha['hectares']?>">
        	<br>

        	

            <div class="form-field, , input-field">
                  <select id="cidade">
                    <option value="1" <?php if($linha['idCidade']=="1"){echo "selected";} ?>>Agrolândia</option>
                    <option value="2" <?php if($linha['idCidade']=="2"){echo "selected";} ?>>Agronômica</option>
                    <option value="3" <?php if($linha['idCidade']=="3"){echo "selected";} ?>>Atalanta</option>
                    <option value="4" <?php if($linha['idCidade']=="4"){echo "selected";} ?>>Aurora</option>
                    <option value="5" <?php if($linha['idCidade']=="5"){echo "selected";} ?>>Braço do Trombudo</option>
                    <option value="6" <?php if($linha['idCidade']=="6"){echo "selected";} ?>>Chapadão do Lageado</option>
                    <option value="7" <?php if($linha['idCidade']=="7"){echo "selected";} ?>>Dona Emma</option>
                    <option value="8" <?php if($linha['idCidade']=="8"){echo "selected";} ?>>Ibirama</option>
                    <option value="9" <?php if($linha['idCidade']=="9"){echo "selected";} ?>>Imbuia</option>
                    <option value="10" <?php if($linha['idCidade']=="10"){echo "selected";} ?>>José Boiteux</option>
                    <option value="11" <?php if($linha['idCidade']=="11"){echo "selected";} ?>>Laurentino</option>
                    <option value="12" <?php if($linha['idCidade']=="12"){echo "selected";} ?>>Lontras</option>
                    <option value="13" <?php if($linha['idCidade']=="13"){echo "selected";} ?>>Mirim Doce</option>
                    <option value="14" <?php if($linha['idCidade']=="14"){echo "selected";} ?>>Petrolândia</option>
                    <option value="15" <?php if($linha['idCidade']=="15"){echo "selected";} ?>>Pouso Redondo</option>
                    <option value="16" <?php if($linha['idCidade']=="16"){echo "selected";} ?>>Presidente</option>
                    <option value="17" <?php if($linha['idCidade']=="17"){echo "selected";} ?>>Presidente Nereu</option>
                    <option value="18" <?php if($linha['idCidade']=="18"){echo "selected";} ?>>Rio do Campo</option>
                    <option value="19" <?php if($linha['idCidade']=="19"){echo "selected";} ?>>Rio do Oeste</option>
                    <option value="20" <?php if($linha['idCidade']=="20"){echo "selected";} ?>>Rio do Sul</option>
                    <option value="21" <?php if($linha['idCidade']=="21"){echo "selected";} ?>>Salete</option>
                    <option value="22" <?php if($linha['idCidade']=="22"){echo "selected";} ?>>Santa Terezinha</option>
                    <option value="23" <?php if($linha['idCidade']=="23"){echo "selected";} ?>>Taió</option>
                    <option value="24" <?php if($linha['idCidade']=="24"){echo "selected";} ?>>Trombudo Central</option>
                    <option value="25" <?php if($linha['idCidade']=="25"){echo "selected";} ?>>Vidal Ramos</option>
                    <option value="26" <?php if($linha['idCidade']=="26"){echo "selected";} ?>>Vitor Meireles</option>
                    <option value="27" <?php if($linha['idCidade']=="27"){echo "selected";} ?>>Witmarsum</option>
                  </select>
                <div class="form-text text-danger" id="cidadeHelp"></div>
            </div>            
            <div class="form-text text-center" id="loading"></div>
    </div>
<script src="../js-adicional/xhttp.js"></script>
<script src="../js-adicional/alterarLavoura.js" defer></script>
</body>
</html>