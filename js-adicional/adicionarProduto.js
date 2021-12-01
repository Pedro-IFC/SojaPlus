window.onload=function(){
	var btn = document.querySelector("#submit");
    btn.onclick=function(event){
        event.preventDefault()

        var loading = document.querySelector("#loading");

        var quant = document.querySelector("#quant").value;

        var verif = true;
        
        if(quant==0) {
            document.querySelector("#quantHelp").innerHTML = "Preencha o campo quantidade!";
            verif=false;
        }else{
            document.querySelector("#quantHelp").innerHTML = ""; 
        }

        if(verif){
            document.querySelector("#quantHelp").innerHTML = "";

            var parametros = '?quant='+quant
            xhttpGet('../actions/adicionarProduto',function() {
                beforeSend(function(){
                    loading.style.color="grey";
                    loading.innerHTML="Carregando";
                });
                sucess(function(){
                    var request = xhttp.responseText;
                    if (request=='sucess') {
                        window.open('../Lavoura/index.php', '_self');
                    }else{
                        loading.style.color="red";
                        loading.innerHTML = request;
                    }
                })
            }, parametros);
        }
    }
}