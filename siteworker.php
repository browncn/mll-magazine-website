<html>
<head><title>siteworker</title></head>
<body>
<div>
<p id="demo"></p>
</div>

<div id= "frame" style=""></div>
<iframe src="" height="10%" width="10%" ></iframe>

<?php 

$file= fopen('site.txt', 'r');
$links = fread($file, 999999);
$alinks = explode('%%%', $links);
//print_r($alinks);
//echo $links;
fclose($file);
$amount = 20;
foreach ($alinks as $x=>$y){
    if($amount !== 0){
        echo '<iframe src="' . $y . '" height="10%" width="10%" ></iframe>';
        $amount--;
    }
    
}

?>

    <script>
count= new Date();
count.setSeconds(count.getSeconds() + 60);
cd= 20;
var ncount;
if(!sessionStorage.count){
    sessionStorage.count = 1;
    ncount = sessionStorage.count;
    ncount = parseInt(ncount);
}else{
	ncount = sessionStorage.count;
    ncount = parseFloat(ncount);
    ncount = ncount + 1;
	sessionStorage.count= ncount;
}

var worker = new Worker('siteworker.js');
worker.postMessage('lol');
worker.onmessage = function(evt){
	//alert(evt.data);
	time= new Date();
	distance= count - time;
	  // Time calculations for days, hours, minutes and seconds
	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	  // Display the result in the element with id="demo"
	  
	document.querySelector('#demo').innerHTML= days + "d " + hours + "h "
	  + minutes + "m " + seconds + "s ";
	document.querySelector('#demo').innerHTML+= '<br>' + ncount;
	// If the count down is finished, write some text
	  if (distance < 0) {
	    //window.location.reload(true);
	    //window.location.href = window.location.href;
	   window.location = self.location; 
	  }
}

worker.onerror = function(evt){
	alert(evt.data);
}

</script>

<script>
/*

linku = "site.txt";
linkus = '';

fetch(linku)
.then(response => response.text())
.then(text => linkus = text)

countdown= setTimeout(function(){	
	linkus= linkus.split('%%%');
	linkus.forEach(ali)
}, 2000);

function ali(item, index, arr) {
	if(cd !== 0){
	  	//arr[index] = item;
	  	//alert(item);
	  	document.querySelector('#frame').innerHTML +=  '<iframe src="' + item + '" height="10%" width="10%" ></iframe>';
		cd--;}
	else{
	}

	}


*/
		

</script>

</body>
</html>