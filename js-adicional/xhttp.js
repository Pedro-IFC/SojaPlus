var xhttp=new XMLHttpRequest();

function xhttpGet(url, callback,parameters=''){
	xhttp.onreadystatechange= callback;
	xhttp.open('GET', url+'.php'+parameters,true);
	xhttp.send();
}

function xhttpPost(url, callback, parameters){
	xhttp.onreadystatechange= callback();
	xhttp.open('POST', url+'.php',true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send(parameters);	
}

function beforeSend(callback){
	if (xhttp.readyState<4){
		callback();
	}
}

function sucess(callback){
	if (xhttp.readyState==4 && xhttp.status == 200) {
		callback();
	}
}