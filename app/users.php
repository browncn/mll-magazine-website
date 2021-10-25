
<link media = all  rel = stylesheet href="../assets/bootstrap/css/bootstrap.min.css">
<link href="../css2/css.css" rel="stylesheet">


<div class= "m-auto" style= "padding:10px;">

<table>
	<tr>
		<th>Email</th>
		<th>First Name</th>
		<th>Last Name </th>
	</tr>

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

$users= "SELECT * FROM `users` ORDER BY `id` DESC";
$reusers= $conn->query($users);
while($rousers= mysqli_fetch_assoc($reusers)){
     echo '<tr><td class="px-2"><a href="../user.php?uid=' . $rousers['id'] . '">' . $rousers['email'] . '</a></td><td class="px-2"><a href="../user.php?uid=' . $rousers['id'] . '">' . $rousers['fname'] . '</a></td><td class="px-2"><a href="../user.php?uid=' . $rousers['id'] . '">' . $rousers['lname'] . '</a></td><td><small><a class="btn btn-danger btn-sm" href="users.php?uid=' . $rousers['id'] . '">delete</a></small></td></tr>';
}

?>

</table>

</div>

<?php 
if(isset($_GET['uid'])){
    $uid= $_GET['UID'];
    $dquery= "DELETE FROM `users` WHERE `id`= $uid";
    $conn->query($dquery);
    echo '<script>location.replace="users.php"</script>';
}


?>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
