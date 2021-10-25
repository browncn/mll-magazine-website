
	
	function gid(getId){
		return document.getElementById(getId);
	}
	function gclass(getClass){
		return document.getElementsByClassName(getClass);
	}
	function gname(getName){
		return document.getElementsByName(getName);
	}
	function qsel(q){
		return document.querySelector(q);
	}


	function ajax_data(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(xhttpReq.responseText.includes('abcde')){
					user_urls = xhttpReq.responseText;
					user_urls = user_urls.replace('abcde','');
					gid('login').innerHTML = user_urls;
					
				}else if(xhttpReq.responseText.includes('!@#$')){
					xel = xhttpReq.responseText;
					dlist = xel.split('!@#$');
					sessionStorage.fname = dlist[0];
					sessionStorage.email = dlist[1];
					sessionStorage.dept = dlist[2];
					gid('login').innerHTML=dlist[3];		
				}else{
					gid(getId).innerHTML = xhttpReq.responseText;
				}
			}
		};
		xhttpReq.send(send_data);
	}
	
	function ajax_data_red(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(xhttpReq.responseText.includes('.html')){
					gid(getId).innerHTML = '';
					red_url = xhttpReq.responseText;
					window.location.href=red_url;
				}else if(xhttpReq.responseText.includes('divid')){
					er_id = xhttpReq.responseText;
					er_id = er_id.replace('divid','');
					gid(er_id).style.border = "1px solid red"; 
					gid(getId).innerHTML = "please fill the highlighted field correctly ";
				}else{			
					gid(getId).innerHTML = xhttpReq.responseText;
				}
			}
		};
		xhttpReq.send(send_data);
	}

	
	// atm main
	
	//keep
	//document.querySelector('#error').addEventListener('load', lolipop);

	function auth(){		
		if(sessionStorage.email !== undefined && sessionStorage.fname !== undefined && sessionStorage.dept !== undefined){
			send_data = '&email=' + sessionStorage.email + '&fname=' + sessionStorage.fname + '&dept=' + sessionStorage.dept + '&uauth=lol';
			ajax_data('app/uauth.php', 'error', send_data)
		}
	}
	auth();
	if(typeof localStorage.email !== undefined){
		gid('email').value = localStorage.email;
	}
	if(typeof localStorage.pass !== undefined){
		gid('pass').value = localStorage.pass;
	}
	
	
	//signin
	
	function signin(){
		var masscheck = new Array();
		
		email = gid('email').value;
		pass = gid('pass').value;
		signin = gid('signin').value;
		keep = gid('formCheck-1').checked;
		
		
		if(typeof localStorage.er_id !== 'undefined' && localStorage.er_id !== ''){
			//alert(localStorage.er_id)
			gid(localStorage.er_id).style.border = "none";
			gid(localStorage.er_id).style.border = "1px solid #c0c0c0";
			gid(localStorage.er_id).autoFocus;
			localStorage.er_id = '';
		}
		
		var masscheck = {email:email, pass:pass};
		var cert = 'ok';
		
		Object.keys(masscheck).find(function(key) {
			  //console.log(key, masscheck[key]);
			  if(masscheck[key] === ''){
				  //alert(key)
					gid(key).style.border= "1px solid red"
					localStorage.er_id = key;
					gid('error').innerHTML = 'please fill highlighted field';
					//alert(masscheck[key])
					
			  }
			  return masscheck[key]===''
		});
		
		
		
		if(keep == true){
			localStorage.email = email;
			localStorage.pass = pass;
		}
		
		sessionStorage.email = email;
		
		
		
		if(localStorage.er_id == '' || localStorage.er_id == undefined){
			form_array =
				'&email=' + email +
				'&pass=' + pass +
				'&signin=' + signin;
				
			send_data = form_array;

			ajax_data('app/uauth.php', 'error', send_data)
		}
		
		
	}
	gid("signin").addEventListener("mousedown", signin);
	
	
	