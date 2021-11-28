window.onload = function(){
    var btn = document.querySelector("#submit");
    btn.onclick = function(event){
        event.preventDefault();
        var email = document.querySelector('#email').value;
        var senha = document.querySelector('#senha').value;
        var verif=true;
        if(email=='') {
            document.querySelector("#emailHelp").innerHTML = "Preencha o campo Email!";
            verif=false;
        }else{
            document.querySelector("#emailHelp").innerHTML = "";
            verif=true;
        }

        if(senha=='') {
            document.querySelector("#senhaHelp").innerHTML = "Preencha o campo Senha!";
            verif=false;
        }else{
            document.querySelector("#senhaHelp").innerHTML = "";
            verif=true;
        }

        if(verif){
            document.querySelector("#emailHelp").innerHTML = "";
            document.querySelector("#senhaHelp").innerHTML = "";
            var dados = '?email='+email+'&senha='+senha;
            xhttpGet('actions/acaoLogin',function() {
                beforeSend(function(){
                    loading.innerHTML="Carregando";
                }
            ); sucess(function(){
                    var request = xhttp.responseText;
                    if (request==1) {
                        window.open('index.php', '_self');
                    }else if (request=='senha') {
                       document.querySelector("#senhaHelp").innerHTML="Sua senha não está cadastrado";
                    }else if (request=="email"){
                       document.querySelector("#emailHelp").innerHTML="Seu e-mail não está cadastrado";
                    }
                    loading.innerHTML="";
                })
            }, dados);
        }
    }
}