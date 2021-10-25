document.write('<script src="../js2/lol.js" type="text/javascript"></script>');

function qsel(q){
	return document.querySelector(q);
}

var a_pic = '';
var a_pic_url = '';

document.querySelector("#submit2").addEventListener('mousedown', (event) => {
	if(article_content.getContents().length > 20){
		document.getElementById('a_content').value = article_content.getContents();
		//alert(document.getElementById('a_content').value);
		document.querySelector("#form").submit();
	}else{
		alert('please type a long enough article content')
	}

})

document.querySelector('#a_pic').addEventListener('change', (event) => {
  const fileList = event.target.files;
  file = fileList[0];
  a_pic = file;
  a_pic_url = URL.createObjectURL(file);
  
  //blob to b64
  var reader = new FileReader();
  reader.onloadend = function() {
      var base64data = reader.result; 
      base64data = encodeURI(base64data);
      //console.log(base64data);
      document.getElementById('base64').value = base64data
  }
  reader.readAsDataURL(a_pic); 


});

function article_sub(){
	if(typeof localStorage.er_id !== 'undefined' & localStorage.err_id!==''){
		alert(localStorage.er_id)
		gid(localStorage.er_id).style.border = "1px solid black";		
		gid(er_id).autoFocus;
		
	}
	
	function article_get(){return article_content.getContents()}
	
	var article = article_get();
	if(article.length < 12 ){
		article = '';
	}
	var a_title= qsel('#a_title').value;
	var title_color = qsel('#title_color').value;
	var a_submit = qsel('#a_submit').value;
	
	
	function checknsubmit(){
		var masscheck = {a_title:a_title, a_pic:a_pic,suneditor_edit:article};
		var cert = 'ok';
		
		Object.keys(masscheck).find(function(key) {
			  //console.log(key, masscheck[key]);
			  if(masscheck[key] === ''){
				  //alert(key)
					gid(key).style.border= "1px solid red"
					localStorage.err_id = key;
					cert = 'please fill highlighted field';
					//alert(masscheck[key])
					
			  }
			  return masscheck[key]===''
		});
			 //if(typeof localStorage.er_id !== 'undefined' & localStorage.err_id !=='')
				  
		  function articlesave(){

			  var uid = 'admin';
			  form_array = '&a_title=' + a_title +
			  '&a_pic=' + a_pic +
			  '&uid=' + uid +
			  '&a_pic_url=' + a_pic_url +
			  '&article=' + article +
			  '&a_submit=' + a_submit + 
			  '&title_color=' + title_color;
	
			  send_data = form_array;
			  
			  //alert (send_data)
	
			  ajax_data_red('app/editor.php', 'modal-body', send_data)
	
		  }
		  if(cert === 'ok'){
			  articlesave();
		  }
		  
	  
			
	}
	checknsubmit();
	//qsel('#secondcheck').innerHTML = '<img src="' + a_pic_url + '">' + a_pic + a_pic_url + a_title + article + title_color;

	
	
  
}

function a_get(){
	function gid(getId){
		return document.getElementById(getId);
	}

	function ajax_data(php_file, getId, send_data){
		//gid(getId).innerHTML = "loading";
		var xhttpReq = new XMLHttpRequest();
		xhttpReq.open("POST", php_file, true); xhttpReq.withCredentials = true;
		xhttpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttpReq.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//uurl = URL.createObjectURL(xhttpReq.responseText)
				p_file =  xhttpReq.responseText;
				gid(getId).innerHTML = p_file;
				document.querySelector(".se-wrapper-wysiwyg").innerHTML = p_file;
				console.log(xhttpReq.responseText)
			}
		};
		xhttpReq.send(send_data);
	}
	
	form_array = '&a_get=a_get';
	
	send_data = form_array
	
	if(form_array !== ''){
		ajax_data('edit.php', 'a_get', send_data)
	}
	
}

a_get();

//document.querySelector('#a_get').addEventListener('load', a_get())

function a_get2(){
	function article_get(){return article_content.getContents()}
	gid('a_get').innerHTML=article_get();
}



