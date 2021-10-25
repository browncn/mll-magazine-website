<html>
<head>
	<link media = all  rel = stylesheet href="../assets/bootstrap/css/bootstrap.min.css">
	
	<link href="../css2/css.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

<link rel = "shortcut icon" type = "image/png" href = "">
	
	<title>MLL-article</title>
</head>

<body>
<?php 
session_start();
if(!isset($_SESSION['dept'])){
    echo '<script>parent.location.replace("../signout.php")</script>';
}else{
    if($_SESSION['dept']!=='admin'){
        echo '<script>parent.location.replace("../signout.php")</script>';
    }
}
if(isset($_GET['iid'])){
	include '../../conns/mll/conn/conn.php';
	$iid = $_GET['iid'];
	$i_get = "SELECT * FROM `catalogue` WHERE `id` = $iid";
	$i_req = $conn->query($i_get);
	$i_row= mysqli_fetch_assoc($i_req);
	$i_date = $i_row['date'];
	$i_title = $i_row['i_title'];
	$i_color = $i_row['i_color'];
	$i_descr = $i_row['i_descr'];
	$i_descr2 = $i_row['i_descr2'];
	
}

?>

<h1>Edit magazine issue</h1>
<form action = "e_issue.php" method="post" enctype="multipart/form-data">
<input class= "form-control" type = "text" name= "i_date" id= "i_date" placeholder = "issue release date" value= "<?php if(isset($i_date)){echo $i_date;} ?>" required>
<input class= "form-control" type = "text" name= "i_title" id= "i_title" placeholder = "issue title"  value= "<?php if(isset($i_title)){echo $i_title;} ?>" required>
<input class= "form-control" type = "text" name= "i_color" id= "i_color" placeholder = "issue color code"  value= "<?php if(isset($i_color)){echo $i_color;} ?>" required>
<label for= "i_pic">add magazine thumbnail (select new thumbnail or leave blank to keep previous)</label>
<input class= "form-control" type = "file" name= "i_pic" id= "i_pic" >
<label for= "issue">add magazine (select new magazine or leave blank to keep previous)</label>
<input class= "form-control" type = "file" name= "issue" id= "issue" accept= "document/pdf" >
<textarea class= "form-control" id="i_descr" cols = "50" rows="10" cols="100" name="i_descr" required><?php if($i_descr !==''){echo $i_descr;}else{echo 'description 1';} ?></textarea>
<textarea class= "form-control" id="i_descr2" cols = "50" rows="10" cols="100" name="i_descr2" required><?php if($i_descr2 !==''){echo $i_descr2;}else{echo 'description 2';}?></textarea>
<textarea name="base64" id="base64" style=";" hidden="hidden"  ></textarea>
<textarea name="base64_issue" id="base64_issue" style=";" hidden="hidden" ></textarea>
<input class= "form-control" type = "text" name= "iid" id= "iid" value= "<?php if(isset($iid)){echo $iid;} ?>" hidden="hidden" required>
<button type="submit" value = "submit" name = "submit" id="submit">submit</button>
</form>

<div id='a_get' class="sun-editor-editable">


<?php 

if(isset($_POST['submit'])){
	include '../../conns/mll/conn/conn.php';
	ini_set('memory_limit', '1024M');
	
	$i_pic = mysqli_real_escape_string($conn, $_POST['base64']);
	$issue = mysqli_real_escape_string($conn, $_POST['base64_issue']);
	$i_descr = mysqli_real_escape_string($conn, $_POST['i_descr']);
	$i_descr2 = mysqli_real_escape_string($conn, $_POST['i_descr2']);
	$i_color = mysqli_real_escape_string($conn, $_POST['i_color']);
	$i_title = mysqli_real_escape_string($conn, $_POST['i_title']);
	$i_date = mysqli_real_escape_string($conn, $_POST['i_date']);
	$iid=$_POST['iid'];
	//$article = $_POST['article'];
	
	if($issue == '' && $i_pic == ''){
		$query = "UPDATE `catalogue` SET
		`date` = '$i_date',
		`i_color` = '$i_color',
		`i_title` = '$i_title',
        `i_descr2` = '$i_descr2',
		`i_descr` = '$i_descr'
		WHERE `id` = $iid";
	}
	if($issue == '' && $i_pic !== ''){
		$query = "UPDATE `catalogue` SET `i_pic` = '$i_pic',
		`date` = '$i_date',
		`i_color` = '$i_color',
		`i_title` = '$i_title',
        `i_descr2` = '$i_descr2',
		`i_descr` = '$i_descr'
		WHERE `id` = $iid";
	}
	if($issue !== '' && $i_pic == ''){
		$query = "UPDATE `catalogue` SET 
		`date` = '$i_date',
		`i_color` = '$i_color',
		`i_title` = '$i_title',
        `i_descr2` = '$i_descr2',
		`i_descr` = '$i_descr',
		`issue` = '$issue'
		WHERE `id` = $iid";
	}
	if($issue !== '' && $i_pic !== ''){
		$query = "UPDATE `catalogue` SET `i_pic` = '$i_pic',
		`date` = '$i_date',
		`i_color` = '$i_color',
		`i_title` = '$i_title',
        `i_descr2` = '$i_descr2',
		`i_descr` = '$i_descr',
		`issue` = '$issue'
		WHERE `id` = $iid";
	}
	
	$conn->query($query);
	
	echo '<script>location.assign("catalogue.php");</script>';
	//echo $query;
	
	
}
/*
include '../../conns/mll/conn/conn.php';

$q = "SELECT * FROM `catalogue` WHERE `id` = 3";
$r = $conn->query($q);
$ro = mysqli_fetch_assoc($r);
file_put_contents('file.pdf', file_get_contents($ro['issue']));
//echo '<a href="' . $ro['issue'] . '" target="blank" download="' . $ro['date'] . '">hello</a>'
//echo '<a href="file.pdf" target="blank" download>hello</a>'
*/
?>

</div>

<!-- The Modal -->
			<div id="myModal" class="modal">
			  <!-- Modal content -->			
				<div class="modal-content">
				  <div class="modal-header" id = "modal-header">
				    <h2>Information!</h2>
				    <span class="close" id = 'cancel'> &times; </span>
				  </div>
				  <div class="modal-body" id = "modal-body">
				  </div>
				  <div class="modal-footer">
				  </div>
				</div>
			</div>


<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../js2/add_issue.js"></script>

<script>


</script>

<script>




</script>
</body>
</html>


<?php




if(isset($_POST['a_get'])){
	include '../../conns/mll/conn/conn.php';
	
	$a_query = "SELECT * FROM `a_index` WHERE `id` = 21 ORDER BY `id` DESC LIMIT 1";
	$a = $conn->query($a_query);
	if($a){
		$a_row = mysqli_fetch_assoc($a);
		echo $a_row['article'];
		//echo $a_query;
		//echo '<img src="data:image/jpeg;base64,' . base64_encode($a_row['title_pic']) . '" />';
	}
		
}


?>