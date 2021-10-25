document.write('<script src="../js2/lol.js" type="text/javascript"></script>');

function qsel(q){
	return document.querySelector(q);
}
function gid(getId){
	return document.getElementById(getId);
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




