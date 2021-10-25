document.write('<script src="../js2/lol.js" type="text/javascript"></script>');

function qsel(q){
	return document.querySelector(q);
}
function gid(getId){
	return document.getElementById(getId);
}

var home_ad = '';
var home_ad_url = '';
var side_ad = '';
var side_ad_url = '';


document.querySelector('#home_ad').addEventListener('change', (event) => {
	modal_lock('<p>now loading. please wait</p>', 'rgba(0,0,255,0.4)')
	  const fileList = event.target.files;
	  file = fileList[0];
	  home_ad = file;
	  home_ad_url = URL.createObjectURL(file);
	  
	  //blob to b64
	  var reader = new FileReader();
	  reader.onloadend = function() {
	      var base64data = reader.result; 
	      base64data = encodeURI(base64data);
	      //console.log(base64data);
	      document.getElementById('base64').value = base64data
	  }
	  reader.readAsDataURL(home_ad); 
	  
	  modal_info('<p>upload successful</p>', 'rgba(0,0,255,0.4)')
	});

//side_ad

document.querySelector('#side_ad').addEventListener('change', (event) => {
	modal_lock('<p>now loading. please wait</p>')
	  const fileList = event.target.files;
	  file = fileList[0];
	  side_ad = file;
	  side_ad_url = URL.createObjectURL(file);
	  
	  //blob to b64
	  var reader = new FileReader();
	  reader.onloadend = function() {
	      var base64data = reader.result; 
	      base64data = encodeURI(base64data);
	      //console.log(base64data);
	      document.getElementById('base642').value = base64data
	  }
	  reader.readAsDataURL(side_ad); 
	  
	  modal_info('<p>upload successful</p>')
	});

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






