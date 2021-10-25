<h3>Add category</h3>
<form action = "subs.php" method= "post">

<input type= "text" name = "iamount" placeholder="amount of magazines"autofocus>
<input type= "text" name = "iprice" placeholder="price per mag" autofocus>
<input type= "submit" name= "add" value= "add">

</form>

<br><br>
<h3>Edit, delete and reorder existing subs</h3>
<form action="subs.php" method="post">

<table>

<tr>
<th>category</th><th>order number</th><th>total amount</th>
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

$query = "SELECT * FROM `subs`";

$res = $conn->query($query);
$cat=1;
$ord=1;

while($row = mysqli_fetch_assoc($res)){
	echo '<tr><td><input type="text" name="' . $row['id'] . '" value="' . $row['id'] . '"hidden="hidden"><input type= "text" name="cat' . $cat . '"value="' . $row['iamount'] . '"></td><td><input type= "text" name="ord' . $ord . '"value="' . $row['iprice'] . '"></td><td>' . $row['iamount']*$row['iprice'] . '</td><td><a href="subs.php?cat_del=' . $row['id'] . '">delete</a></tr>';
	if($cat == $cat){$cat++;}
	if($ord == $ord){$ord++;}
}

?>
<tr><td><input type= "submit" name="edit" value="edit"></td></tr>
</table>

</form>

<?php 

if(isset($_POST['add'])){
	include '../../conns/mll/conn/conn.php';
	
	$category = mysqli_real_escape_string($conn, $_POST['iamount']);
	$order = mysqli_real_escape_string($conn, $_POST['iprice']);

	$ins = "INSERT INTO `subs` (`iamount`, `iprice`)
							VALUES ('$category', $order)";
	$conn->query($ins);
	echo '<script>location.assign("subs.php");</script>';
}

if(isset($_POST['edit'])){
	include '../../conns/mll/conn/conn.php';
	
	array_pop($_POST);
	$cat_array = array_chunk($_POST, 3);
	foreach ($cat_array as $x){
		$x[1] = mysqli_real_escape_string($conn, $x[1]);
		$edit = "UPDATE `subs` SET `iamount` = '$x[1]',
										`iprice` = $x[2]
										WHERE `id` = $x[0]";
		$conn->query($edit);
		echo '<script>location.assign("subs.php");</script>';
	}
}

if(isset($_GET['cat_del'])){
	$cat_del = $_GET['cat_del'];
	$del = "DELETE FROM `subs` WHERE `id` = $cat_del";
	$conn->query($del);
	
	echo '<script>location.assign("subs.php");</script>';
}
