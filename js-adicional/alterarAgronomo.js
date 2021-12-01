window.onload=function(){
	var nome = document.querySelector("#nome");
	var sobrenome = document.querySelector("#sobrenome");
	var cnpj = document.querySelector("#cnpj");
	var telefone = document.querySelector("#telefone");
	var email = document.querySelector("#email");
	var genero1 = document.querySelector("#genero1");
	var genero2 = document.querySelector("#genero2");

	var btnEx= document.querySelector("#excluir");

	btnEx.onclick=function(){
		var parameters="";
		xhttpGet('../actions/excluirUsuario',function() {
		    beforeSend(function(){
		        loading.style.color="grey";
		        loading.innerHTML="Carregando";
		    });
		    sucess(function(){
		        var request = xhttp.responseText;
		        if (request=="sucess") {
		        	window.open("../index.php", "_self");
		        	loading.style.color="grey";
		            loading.innerHTML = "";
		        }else{
		            loading.style.color="red";
		            loading.innerHTML = request;
		        }
		    })
		}, parameters);
	}

	genero2.onchange = function(){
		var parameters="?campo=genero&value="+genero2.value;
		xhttpGet('../actions/alterarDados',function() {
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

	genero1.onchange = function(){
		var parameters="?campo=genero&value="+genero1.value;
		console.log("foi");

		xhttpGet('../actions/alterarDados',function() {
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

	nome.onchange = function(){
		var parameters="?campo="+nome.id+"&value="+nome.value;
		xhttpGet('../actions/alterarDados',function() {
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

	sobrenome.onchange = function(){
		var parameters="?campo="+sobrenome.id+"&value="+sobrenome.value;
		xhttpGet('../actions/alterarDados',function() {
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
	
	cnpj.onchange = function(){
		var parameters="?campo="+cnpj.id+"&value="+cnpj.value;
		xhttpGet('../actions/alterarDados',function() {
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

	telefone.onchange = function(){
		var parameters="?campo="+telefone.id+"&value="+telefone.value;
		xhttpGet('../actions/alterarDados',function() {
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

	email.onchange = function(){
		var parameters="?campo="+email.id+"&value="+email.value;
		xhttpGet('../actions/alterarDados',function() {
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

	
