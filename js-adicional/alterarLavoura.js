window.onload=function(){
	var hectares = document.querySelector("#hectares");
	var cidade = document.querySelector("#cidade");
	
	var ParametrosUrl = new URLSearchParams(window.location.search);
	var idLavoura = ParametrosUrl.get('idLavoura');


	hectares.onchange = function(){
		var parameters="?campo="+hectares.id+"&value="+hectares.value+"&idLavoura="+idLavoura;
		xhttpGet('../actions/alterarDadosLavoura',function() {
		    beforeSend(function(){
		        loading.style.color="grey";
		        loading.innerHTML="Carregando";
		    });
		    sucess(function(){
		        var request = xhttp.responseText;
		        if (request=="sucess") {
		        	alert("Alterado com sucesso");
		        	
		        	loading.style.color="grey";
		            loading.innerHTML = "";
		        }else{
		            loading.style.color="red";
		            loading.innerHTML = request;
		        }
		    })
		}, parameters);
	}
	
	cidade.onchange = function(){
		var parameters="?campo="+hectares.id+"&value="+hectares.value+"&idLavoura="+idLavoura;
		xhttpGet('../actions/alterarDadosLavoura',function() {
		    beforeSend(function(){
		        loading.style.color="grey";
		        loading.innerHTML="Carregando";
		    });
		    sucess(function(){
		        var request = xhttp.responseText;
		        if (request=="sucess") {
		        	alert("Alterado com sucesso");
		        	
		        	loading.style.color="grey";
		            loading.innerHTML = "";
		        }else{
		            loading.style.color="red";
		            loading.innerHTML = request;
		        }
		    })
		}, parameters);
	}
}

	
