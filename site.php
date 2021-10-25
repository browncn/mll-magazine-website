<html>
<head>
	<title>pingaroo</title>
</head>
<body>
<p id="demo"></p>
<iframe name="leframe" style="width:300px; background:grey;"></iframe>
<?php

include '../conns/mll/conn/conn.php';

$lq= "SELECT * FROM `a_index` ORDER BY `id` DESC";
$relq= $conn->query($lq);

$xml= '<?xml version="1.0" encoding="UTF-8"?>

<urlset

      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"

      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"

      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9

            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<!-- created by kenjix3c -->

';
$count= 5;
$ping= array();
while ($rolq=mysqli_fetch_assoc($relq)){
    $aid= $rolq['id'];
    $atitle= $rolq['title'];
    $atitle= str_replace(' ', '-', $atitle);
    $date= date('Y-m-d');
    $time = date('H:i:s+00:00');
    $btw= 'T';
    $url= 'https://www.mylegallifestyle.com/article.php?aid=' . $aid . '&atitle=' . $atitle;
    array_push($ping, $url);
    
    
    
    $xml = $xml .  '
        <url>
  <loc>https://www.mylegallifestyle.com/article.php?aid=' . $aid . '&amp;atitle=' . $atitle . '</loc>
  <lastmod>' . $date . $btw . $time . '</lastmod>
  <priority>1.00</priority>
</url>
';
    
}

    $xml = $xml . '</urlset>';
    //echo $xml;
    $file= fopen('site.xml', 'w');
    fwrite($file, $xml);
    fclose($file);
    echo '  sitemap update done <br>';
    
    ?>
    <script>
count= new Date();
count.setSeconds(count.getSeconds() + 10);
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

var worker = new Worker('../js2/worker.js');
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

<?php 
    function urlExists($url=NULL)
    {
        if($url == NULL) return false;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpcode>=200 && $httpcode<300){
            echo 'true';
            return true;
        } else {
            echo 'false';
            return false;
        }
    }  
    while($count > 0){
        foreach($ping as $x){
            //echo '<script>window.frames["leframe"].location = "' . $x . '"</script>';
            //echo '<script>window.location.href = "' . $x . '", "_blank";</script>';
            /*$a= "<a href='" . $x . "'>.</a>";
            echo "<script>let a= document.createElement('a');
            a.target= '_blank';
            a.href='" . $x . "';
            a.click();</script>";*/
            echo '<iframe src="https://www.google.com" height="10%" width="10%" ></iframe>';
        }
        $count--;
    }
    
    ?>
    
    <!-- Display the countdown timer in an element -->
<!-- <p id="demo"></p>

<script>
// Set the date we're counting down to
var countDownDate = new Date("Jun 5, 2022 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script> -->

    </body>
</html>
    