
<link media = all  rel = stylesheet href="../assets/bootstrap/css/bootstrap.min.css">
<link href="../css2/css.css" rel="stylesheet">


<div class= "row" style= "padding:5px;">

<?php
session_start();
if(!isset($_SESSION['dept'])){
    echo '<script>parent.location.replace("../signout.php")</script>';
}else{
    if($_SESSION['dept']!=='admin'){
        echo '<script>parent.location.replace("../signout.php")</script>';
    }
}

include '../../conns/mll/conn/conn.php';

$get = "SELECT * FROM `catalogue`";

$re_get = $conn->query($get);
while($ro_get=mysqli_fetch_assoc($re_get)){
	echo '<div style= "margin:20px;"><img src="' . $ro_get['i_pic'] . '" width=200px/><br>' . 
			'<a href= "e_issue.php?iid=' . $ro_get['id'] . '">' . $ro_get['date'] . '</a><br>' . 
			'<a href= "catalogue.php?idel=' . $ro_get['id'] . '">delete</a></div>';
}

if(isset($_GET['idel'])){
	$idel = $_GET['idel'];
	$del = "DELETE FROM `catalogue` WHERE `id` = $idel";
	$conn->query($del);
	
	echo '<script>location.assign("catalogue.php");</script>';
	
}

?>

</div>


<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
