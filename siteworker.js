a= 1;	
onmessage = function(){
		countdown= setInterval(function(){
	
		postMessage(a);
		a++;
		
}, 1000);
		/*if(a == 30){
			clearInterval(countdown);
		}*/
		}