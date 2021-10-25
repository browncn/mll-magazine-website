
	
	function gid(getId){
		return document.getElementById(getId);
	}
	function gclass(getClass){
		return document.getElementsByClassName(getClass);
	}
	function gname(getName){
		return document.getElementsByName(getName);
	}
	function gtag(getTag){
		return document.getElementsByTagName(getTag);
	}
	function qid(selector){
		return document.querySelector(selector);
	}
	
	err_id = '';
	
	
	function ajax_data(php_file, getId, send_data){
		gid(getId).innerHTML = "authenticating, please wait...";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					gid(getId).innerHTML = xhttpReq.responseText;
					if(xhttpReq.responseText.includes('signin')){
						gid('signin').onmousedown=signin;
					}
			}
		};
		xhttpReq.send(send_data);
	}
	function ajax_data_append(php_file, getId, send_data){
		//gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					gid(getId).innerHTML += xhttpReq.responseText;
			}
		};
		xhttpReq.send(send_data);
	}
	
	
	function ajax_data_get(php_file, variable, send_data){
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, false);
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					variable = xhttpReq.responseText;
					xel = variable;
			}else{
				gid('modal-body').innerHTML = "<p>Internet not available or unstable. Please enable innternet connection and try again</p> ";
				gid('cancel').style.display="block";
				gid('modal-header').style.background="rgba(255,0,0,0.5)";
				conf();
			}
			
		};
		xhttpReq.send(send_data);
		//gid('check').innerHTML = 'lo' + variable;
		//return variable
	}
	
	function ajax_data2(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, false);
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(xhttpReq.responseText.includes('.sub')){
					er_id2 = xhttpReq.responseText;
					er_id2 = er_id2.replace('.sub','');
					if( err_id !== ''){
						return false						
					}else{
						gid('sub').classList.remove('bg-secondary');
						gid('sub').disabled = false;
						gid(getId).innerHTML = er_id2;
					}
				}else{
					gid('sub').classList.add('bg-secondary');
					gid('sub').disabled = true;	
				}
			}else{
				gid('modal-body').innerHTML = "<p>Internet not available. Please enable innternet connection and try again</p> ";
				gid('cancel').style.display="block";
				gid('modal-header').style.background="rgba(255,0,0,0.5)";
				conf();
			}
		};
		xhttpReq.send(send_data);
	}
	
	function ajax_data_red(php_file, getId, send_data){
		gid(getId).innerHTML = "loading";
		gid('cancel').style.display="none";
		gid('modal-header').style.background="rgba(0,255,0,0.5)";
		conf();
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if(xhttpReq.responseText.includes('.html')){
					gid(getId).innerHTML = 'loading...';					
					red_url = xhttpReq.responseText;
					//gid(getId).innerHTML = red_url;
					window.location.href=red_url;
				}else if(xhttpReq.responseText.includes('divid')){
					er_id = xhttpReq.responseText;
					er_id = er_id.replace('divid','');
					gid(er_id).style.border = "1px solid red"; 
					gid(getId).innerHTML = "<p>please fill the highlighted field correctly</p> ";
					gid('cancel').style.display="block";
					conf();
				}else{
					gid(getId).innerHTML = xhttpReq.responseText;
				}
			}else{
				gid('modal-body').innerHTML = "<p>Internet not available. Please enable innternet connection and try again</p> ";
				gid('cancel').style.display="block";
				gid('modal-header').style.background="rgba(255,0,0,0.5)";
				conf();
			}
		};
		xhttpReq.send(send_data);
	}

	
	// atm main
	
	
	xel = '';
	ulist = '';
	dlist = '';
	
	
	
	function idwrite(id, post, value){
		send_data = '&' + post + '=' + value;
		ajax_data('https://www.mylegallifestyle.com/app/index2.php', id, send_data);
	}
	function idappend(id, post, value){
		send_data = '&' + post + '=' + value;
		ajax_data_append('https://www.mylegallifestyle.com/app/index2.php', id, send_data);
	}
	
	function signin(){
		var email = gid('email').value;
		var pass = gid('pass').value;
		if(email == '' || pass == ''){
			gid('error').innerHTML= 'please fill for correctly';
		}else{
			send_data = '&email=' + email + 
						'&pass=' + pass;
			gid('login').onload=ajax_data('https://www.mylegallifestyle.com/app/index2.php', 'login', send_data);
		}		
	}
	gid('login').onload=ajax_data('https://www.mylegallifestyle.com/app/index2.php', 'login', '');
	
	/*
	gid('navi').onload=idappend('navi', 'navi', 'navi');
	gid('caru').onload=idwrite('caru', 'caru', 'caru');
	gid('justin').onload=idwrite('justin', 'justin', 'justin');
	setTimeout(function(){
			gid('sidemag').onload=idappend('sidemag', 'sidemag', 'sidemag');
	}, 3000)
	gid('box-2').onload=idwrite('box-2', 'midad', 'midad');
	gid('topcat').onload=idwrite('topcat', 'topcat', 'topcat');
	gid('catlist').onload=idwrite('catlist', 'catlist', 'catlist');
	gid('mllissue').onload=idwrite('mllissue', 'mllissue', 'mllissue');
	gid('footer').onload=idwrite('footer', 'footer', 'footer');
	*/
	

	
	// Get the modal
	var modal = document.getElementById("myModal");

	// open the modal
	function conf() {
	  modal.style.display = "block";
	}

	// close the modal
	gid('cancel').onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	/*window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
	*/
	
		
	