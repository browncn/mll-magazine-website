<html>
<head>
	<link media = all  rel = stylesheet href="../assets/bootstrap/css/bootstrap.min.css">
	<link href="../suneditor/css/suneditor.min.css" rel="stylesheet">
	
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
<p>Add article</p>
<form action = "editor.php" method="post" enctype="multipart/form-data">
<input class= "form-control" type = "text" name = "a_title" id= "a_title" placeholder= "article title" autofocus required>
<input class= "form-control" type = "text" name= "title_color" id= "title_color" placeholder = "title color" required>
<input class= "form-control" type = "file" name= "a_pic" id= "a_pic" accept= "image/*" required>
<textarea class= "form-control" id="a_content" rows="10" cols="100" name="a_content" required></textarea>
<textarea name="base64" id="base64" style=";" hidden="hidden" required></textarea>
<button type="submit" value = "submit" name = "submit2" id="submit2">submit</button>
</form>

<div id='a_get' class="sun-editor-editable">


<?php 
session_start();
if(!isset($_SESSION['dept'])){
    echo '<script>parent.location.replace("../signout.php")</script>';
}else{
    if($_SESSION['dept']!=='admin'){
        echo '<script>parent.location.replace("../signout.php")</script>';
    }
}

/*
if(isset($_POST['submit2'])){
	echo 'apic is <img src="' . $_POST['base64'] . '"/>';
	echo $_POST['a_content'];
	var_dump($_POST);
}
*/

if(isset($_POST['submit2'])){
	include '../../conns/mll/conn/conn.php';
	/*if ( 0 < $_FILES['file']['error'] ) {
	 echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	 }
	 else {
	 //move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
	 }*/
	$a_pic = mysqli_real_escape_string($conn, $_POST['base64']);
	$a_title = mysqli_real_escape_string($conn, $_POST['a_title']);
	$title_color = mysqli_real_escape_string($conn, $_POST['title_color']);
	$article = mysqli_real_escape_string($conn, $_POST['a_content']);
	//$article = $_POST['article'];
	$uid = 'admin';
	$uid = mysqli_real_escape_string($conn, $uid);
	
	$query = "INSERT INTO `a_index` (`title`, `timestamp`, `author`, `title_pic`, `color`, `article`)
	VALUES('$a_title', NOW(), '$uid', '$a_pic', '$title_color', '$article')";
	
	$success = $conn->query($query);
	if($success){
		$gquery = "SELECT * FROM `a_index` ORDER BY `id` DESC LIMIT 1";
		$ires = $conn->query($gquery);
		$irow = mysqli_fetch_assoc($ires);
		$title = $irow['title'];
		$t_pic = $irow['title_pic'];
		$article = $irow['article'];
		$color = $irow['color'];
		echo 'article saved successfully<br>';
		echo '<div style="width:100px;"><img src="' . $t_pic . '" /></div>';
		echo '<h1 style="color:' . $color . ';">' . $title . '</h1>';
		echo $article;
		//var_dump($_POST);
	}
	//echo $query;
	//print_r($_POST);
	
}

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
<script src="../suneditor/js/suneditor.min.js"></script>
<script src="../suneditor/js/codemirror.min.js"></script>
<script src="../suneditor/js/htmlmixed.js"></script>
<script src="../suneditor/js/xml.js"></script>
<script src="../suneditor/js/css.js"></script>
<script src="../suneditor/js/katex.min.js"></script>
<script src="../js2/suneditor_client_side.js"></script>
<script src="../js2/editor.js"></script>

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