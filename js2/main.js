
	
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
		gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					gid(getId).innerHTML = xhttpReq.responseText;
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
	
	
	
	function userget(){
		send_data = '&u=u';
		ajax_data_get('app/userprofile.php', ulist, send_data);
		//gid('check').innerHTML = xel;
		dlist = xel.split('_');
		gid('fname').value = dlist[0];
		gid('lname').value = dlist[1];
		gid('pass').value = dlist[4];
		gid('email').value = dlist[2];
		gid('phone').value = dlist[3];
		gid('gender').value = dlist[5];
		
		gid('state').value = dlist[6];
		gid('addr').value = dlist[7];
	}
	
	//gid('check').addEventListener('load', userget());
	
	function del(){
		send_data = '&del=del';
		ajax_data_red('app/userprofile.php', 'check', send_data);
	}
	
	function checknsave(){
		error = false;
		
		fname = gid('fname').value;
		lname = gid('lname').value;
		email = gid('email').value;
		phone = gid('phone').value;
		pass = gid('pass').value;
		gender = gid('gender').value;
		state = gid('state').value;
		addr = gid('addr').value;
		
		
		
		
		if(error == false){
			send_data = 
				'&checknsave=lol' + 
				'&fname='  + fname +  
				'&lname='  + lname +  
				'&email='  + email +  
				'&phone='  + phone +  
				'&pass='  + pass +  
				'&gender='  + gender +  
				'&state='  + state +  
				'&addr='  + addr;
			
			ajax_data_red('app/userprofile.php', 'modal-body', send_data);
		}
	}
	
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
	
		
	