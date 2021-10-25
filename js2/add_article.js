document.write('<script src="../js2/lol.js" type="text/javascript"></script>');

function qsel(q){
	return document.querySelector(q);
}
function gid(getId){
	return document.getElementById(getId);
}

var a_pic = '';
var a_pic_url = '';

document.querySelector("#submit").addEventListener('mousedown', (event) => {
	if(article_content.getContents().length > 20){
		document.getElementById('a_content').value = article_content.getContents();
		//alert(document.getElementById('a_content').value);
		document.querySelector("#form").submit();
	}else{
		alert('please type a long enough article content')
	}

})

document.querySelector('#a_pic').addEventListener('change', (event) => {
	modal_lock('<p>now loading. please wait</p>', 'rgba(0,0,255,0.4)')
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
	  
	  modal_info('<p>upload successful</p>', 'rgba(0,0,255,0.4)')
	});

//Get the modal
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

function modal_info (info, header_rgba){
	document.querySelector('#modal-body').innerHTML = info;
	document.querySelector('#cancel').style.display="block";
	document.querySelector('#modal-header').style.background= "rgba(0,0,255,0.4)";
	conf();
}
function modal_lock (info, header_rgba){
	document.querySelector('#modal-body').innerHTML = info;
	document.querySelector('#modal-header').style.background= "rgba(0,255,0,0.7)";
	conf();
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

//a_get();



