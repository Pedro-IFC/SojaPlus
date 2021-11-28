window.onload = function(){
    var btn = document.querySelector("#submit");
    btn.onclick=function(event){
        event.preventDefault()

        var loading = document.querySelector("#loading");

        var hectares = document.querySelector("#hectares").value;
        var cidade = document.querySelector("#cidade").value;
        var dataPlantio = document.querySelector("#dataPlantio").value;

        var verif = true;
        
        if(hectares=='') {
            document.querySelector("#hectaresHelp").innerHTML = "Preencha o campo Hectares!";
            verif=false;
        }else{
            document.querySelector("#hectaresHelp").innerHTML = ""; 
        }
        
        if(cidade==0) {
            document.querySelector("#cidadeHelp").innerHTML = "Preencha o campo Cidade!";
            verif=false;
        }else{
            document.querySelector("#cidadeHelp").innerHTML = ""; 
        }
        
        if(dataPlantio=='') {
            document.querySelector("#dataPlantioHelp").innerHTML = "Preencha o campo data de nascimento!";
            verif=false;
        }else{
            document.querySelector("#dataPlantioHelp").innerHTML = "";

            var dif=Date.parse(dataPlantio)-Date.parse(new Date); // diferença em milisegundos da data atual e a data de nascimento do usuário
            var trintaD=2592000000;                   //18 anos em milisegundos
            
            if(dif < trintaD) {
                document.querySelector("#dataPlantioHelp").innerHTML = "É preciso ter 30 dias de antecedencia para cadastrar a lavoura";
                verif=false;
            }else{
                document.querySelector("#dataPlantioHelp").innerHTML = "";
            }
        }

        if(verif){
            document.querySelector("#dataPlantio").innerHTML = "";
            document.querySelector("#cidadeHelp").innerHTML = "";
            document.querySelector("#hectaresHelp").innerHTML = "";

            var parametros = '?cidade='+cidade+'&hectares='+hectares+'&dataPlantio='+dataPlantio;
            xhttpGet('../actions/cadLavouras',function() {
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