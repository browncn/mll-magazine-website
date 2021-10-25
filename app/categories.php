<h3>Add category</h3>
<form action = "categories.php" method= "post">

<input type= "text" name = "new_cat" autofocus>
<input type= "submit" name= "add" value= "add">

</form>

<br><br>
<h3>Edit, delete and reorder existing categories</h3>
<form action="categories.php" method="post">

<table>

<tr>
<th>category</th><th>order number</th>
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

$query = "SELECT * FROM `categories` ORDER BY `cat_order` ASC";

$res = $conn->query($query);
$cat=1;
$ord=1;

while($row = mysqli_fetch_assoc($res)){
	echo '<tr><td><input type="text" name="' . $row['id'] . '" value="' . $row['id'] . '"hidden="hidden"><input type= "text" name="cat' . $cat . '"value="' . $row['category'] . '"></td><td><input type= "text" name="ord' . $ord . '"value="' . $row['cat_order'] . '"></td><td><a href="categories.php?cat_del=' . $row['id'] . '">delete</a></tr>';
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
	
	$category = mysqli_real_escape_string($conn, $_POST['new_cat']);
	$order = 0;
	$query = "SELECT * FROM `categories` ORDER BY `cat_order` DESC LIMIT 1";
	
	$res= $conn->query($query);
	if(mysqli_num_rows($res)!==0){
		$row= mysqli_fetch_assoc($res);
		$order=$row['cat_order'] +1;
	}
	
	$ins = "INSERT INTO `categories` (`category`, `cat_order`)
							VALUES ('$category', $order)";
	$conn->query($ins);
	echo '<script>location.assign("categories.php");</script>';
}

if(isset($_POST['edit'])){
	include '../../conns/mll/conn/conn.php';
	
	array_pop($_POST);
	$cat_array = array_chunk($_POST, 3);
	foreach ($cat_array as $x){
		$x[1] = mysqli_real_escape_string($conn, $x[1]);
		$edit = "UPDATE `categories` SET `category` = '$x[1]',
										`cat_order` = $x[2]
										WHERE `id` = $x[0]";
		$conn->query($edit);
		echo '<script>location.assign("categories.php");</script>';
	}
}

if(isset($_GET['cat_del'])){
	$cat_del = $_GET['cat_del'];
	$del = "DELETE FROM `categories` WHERE `id` = $cat_del";
	$conn->query($del);
	$a_chk = "SELECT * FROM `articles` WHERE `cat_id` = $cat_del";
	$re_chk = $conn->query($a_chk);
	if(mysqli_num_rows($re_chk) !==0){
		$ro_chk = mysqli_fetch_assoc($re_chk);
		$d_upd = "UPDATE `articles` SET `cat_id` = 0,
		`category` = ''
		WHERE `cat_id` = $cat_del";
		$conn->query($d_upd);
	}
	
	echo '<script>location.assign("categories.php");</script>';
}
