<link media = all  rel = stylesheet href="../assets/bootstrap/css/bootstrap.min.css">
<link href="../css2/css.css" rel="stylesheet">


<br><br>
<h3>Contact Details</h3>
<form action="contact.php" method="post">
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

$query = "SELECT * FROM `contact`";

$res = $conn->query($query);
$ro= mysqli_fetch_assoc($res);

$addr= $ro['addr'];
$state= $ro['state'];
$city= $ro['city'];
$country= $ro['country'];
$tel= $ro['tel'];
$email= $ro['email'];

?>

<input class= "form-control" type= "text" name= "addr" placeholder= "address" value="<?php echo $addr;?>">
<input class= "form-control" type= "text" name= "city"  placeholder= "city" value="<?php echo $city;?>">
<input class= "form-control" type= "text" name= "state"  placeholder= "state" value="<?php echo $state;?>">
<input class= "form-control" type= "text" name= "country" placeholder= "country"  value="<?php echo $country;?>">
<input class= "form-control" type= "number" name= "tel"  placeholder= "phone number" value="<?php echo $tel;?>">
<input class= "form-control" type= "email" name= "email"  placeholder= "email" value="<?php echo $email;?>">
<button class= "form-control btn btn-secondary" role= "submit" name= "add">edit</button>

</form>

<?php 

if(isset($_POST['add'])){
	include '../../conns/mll/conn/conn.php';
	
	$addr= mysqli_real_escape_string($conn, $_POST['addr']);
	$state= mysqli_real_escape_string($conn, $_POST['state']);
	$city= mysqli_real_escape_string($conn, $_POST['city']);
	$country= mysqli_real_escape_string($conn, $_POST['country']);
	$tel= mysqli_real_escape_string($conn, $_POST['tel']);
	$email= mysqli_real_escape_string($conn, $_POST['email']);
	
	$query= "UPDATE `contact` SET `addr`= '$addr',
                                    `state`= '$state',
                                `city`= '$city',
                                `country`= '$country',
                                `tel`= '$tel',
                                `email`= '$email' WHERE `id` = 1";
	$conn->query($query);
	
	echo '<script>location.assign("contact.php");</script>';
}
?>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
