<?php
session_start();
if(!isset($_SESSION['dept'])){
    echo '<script>parent.location.replace("../signout.php")</script>';
}else{
    if($_SESSION['dept']!=='admin'){
        echo '<script>parent.location.replace("../signout.php")</script>';
    }
}

if(isset($_POST['a_get'])){
	include '../../conns/mll/conn/conn.php';
	
	$a_query = "SELECT * FROM `a_index` WHERE `id` = 7 ORDER BY `id` DESC LIMIT 1";
	$a = $conn->query($a_query);
	if($a){
		$a_row = mysqli_fetch_assoc($a);
		echo $a_row['article'];
		//echo $a_query;
		//echo '<img src="data:image/jpeg;base64,' . base64_encode($a_row['title_pic']) . '" />';
	}
	
}


?>