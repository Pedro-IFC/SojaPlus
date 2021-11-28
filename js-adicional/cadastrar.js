window.onload = function(){
    var btn = document.querySelector("#submit");
    btn.onclick=function(event){
        event.preventDefault()

        var loading = document.querySelector("#loading");

        var nome = document.querySelector("#nome").value;
        var sobrenome = document.querySelector("#sobrenome").value;
        var dataNasc = document.querySelector("#dataNasc").value;
        var cpf = document.querySelector("#cpf").value;
        var cnpj = document.querySelector("#cnpj").value;
        var genero = document.querySelector("#sexo").value;
        var telefone = document.querySelector("#telefone").value;
        var email = document.querySelector("#email").value;
        var senha = document.querySelector("#senha").value;
        var confSenha = document.querySelector("#confSenha").value;

        var verif = true;
        
        if(nome=='') {
            document.querySelector("#nomeHelp").innerHTML = "Preencha o campo Nome!";
            verif=false;
        }else{
            if(nome.length > 40) {
                document.querySelector("#nomeHelp").innerHTML = "Nome longo demais";  
                verif=false;                
            }else{
                document.querySelector("#nomeHelp").innerHTML = "";                     
            }
        }
        
        if(sobrenome=='') {
            document.querySelector("#sobrenomeHelp").innerHTML = "Preencha o campo sobrenome!";
            verif=false;
        }else{
            if(sobrenome.length > 50) {
                document.querySelector("#sobrenomeHelp").innerHTML = "Sobrenome longo demais";  
                verif=false;                
            }else{
                document.querySelector("#sobrenomeHelp").innerHTML = "";                     
            }
        }
        
        if(dataNasc=='') {
            document.querySelector("#dataNascHelp").innerHTML = "Preencha o campo data de nascimento!";
            verif=false;
        }else{
            document.querySelector("#dataNascHelp").innerHTML = "";

            var dif=Date.parse(new Date)-Date.parse(dataNasc);  // diferença em milisegundos da data atual e a data de nascimento do usuário
            var dezoitoAnosMili=567648000000;                   //18 anos em milisegundos
            
            if(dif < dezoitoAnosMili) {
                document.querySelector("#dataNascHelp").innerHTML = "O usuário não é maior de dezoito";
                verif=false;
            }else{
                document.querySelector("#dataNascHelp").innerHTML = "";
            }
        }
        
        if(genero!="M" && genero!="F") {
            document.querySelector("#sexoHelp").innerHTML = "Preencha o campo de gênero!";
            verif=false;
        }else{
            document.querySelector("#sexoHelp").innerHTML = "";
        }
        
        if(telefone=='') {
            document.querySelector("#telefoneHelp").innerHTML = "Preencha o campo de telefone!";
            verif=false;
        }else{
            if(telefone.length > 11) {
                document.querySelector("#telefoneHelp").innerHTML = "Número de telefone inválido";  
                verif=false;                
            }else{
                document.querySelector("#telefoneHelp").innerHTML = "";                     
            }
        }
        
        if(cpf=='') {
            document.querySelector("#cpfHelp").innerHTML = "Preencha o campo de CPF!";
            verif=false;
        }else{
            if(cpf.length > 14) {
                document.querySelector("#cpfHelp").innerHTML = "CPF inválido";  
                verif=false;                
            }else{
                document.querySelector("#cpfHelp").innerHTML = "";                     
            }
        }
        
        if(cnpj=='') {
            document.querySelector("#cnpjHelp").innerHTML = "Preencha o campo de CNPJ!";
            verif=false;
        }else{
            if(cnpj.length > 14) {
                document.querySelector("#cnpjHelp").innerHTML = "CNPJ inválido";  
                verif=false;                
            }else{
                document.querySelector("#cnpjHelp").innerHTML = "";                     
            }
        }

        if(email=='') {
            document.querySelector("#emailHelp").innerHTML = "Preencha o campo Email!";
            verif=false;
        }else{
            if(email.indexOf("@") == -1) {
                document.querySelector("#emailHelp").innerHTML = "E-mail inválido";  
                verif=false;                
            }else{
                if(email.length > 80) {
                    document.querySelector("#emailHelp").innerHTML = "E-mail longo demais";  
                    verif=false;                
                }else{
                    document.querySelector("#emailHelp").innerHTML = "";                     
                }                     
            }
        }

        if(senha=='') {
            document.querySelector("#senhaHelp").innerHTML = "Preencha o campo Senha!";
            verif=false;
        }else{
            if(senha.length < 6) {
                document.querySelector("#senhaHelp").innerHTML = "A senha deve ter no mínimo 6 dígitos";  
                verif=false;                
            }else{
                if(senha.length > 50) {
                    document.querySelector("#senhaHelp").innerHTML = "Senha longa demais";  
                    verif=false;                
                }else{
                    document.querySelector("#senhaHelp").innerHTML = "";                     
                }                     
            }
        }

        if (confSenha=='') {
            document.querySelector("#confSenhaHelp").innerHTML = "Preencha o campo Confirmar Senha!";
            verif=false;
        }else{
            document.querySelector("#confSenhaHelp").innerHTML = "";
        }
        
        if(senha!=confSenha){
            document.querySelector("#confSenhaHelp").innerHTML = "Senhas não coincidem";
            verif=false;
        }

        if(verif){
            document.querySelector("#nomeHelp").innerHTML = "";
            document.querySelector("#sobrenomeHelp").innerHTML = "";
            document.querySelector("#dataNascHelp").innerHTML = "";
            document.querySelector("#sexoHelp").innerHTML = "";
            document.querySelector("#telefoneHelp").innerHTML = "";
            document.querySelector("#cpfHelp").innerHTML = "";
            document.querySelector("#emailHelp").innerHTML = "";
            document.querySelector("#senhaHelp").innerHTML = "";
            document.querySelector("#confSenhaHelp").innerHTML = "";
            var parametros = '?nome='+nome+'&sobrenome='+sobrenome+'&dataNasc='+dataNasc+"&cpf="+cpf+"&cnpj="+cnpj+"&genero="+genero+"&telefone="+telefone+"&email="+email+"&senha="+senha;
            xhttpGet('actions/acaoCad',function() {
                beforeSend(function(){
                    loading.style.color="grey";
                    loading.innerHTML="Carregando";
                });
                sucess(function(){
                    var request = xhttp.responseText;
                    if (request=='sucess') {
                        window.open('index.php', '_self');
                    }else{
                        loading.style.color="red";
                        loading.innerHTML = request;
                    }
                })
            }, parametros);
        }
    }
}