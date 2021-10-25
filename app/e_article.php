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
<?php 
session_start();
if(!isset($_SESSION['dept'])){
    echo '<script>parent.location.replace("../signout.php")</script>';
}else{
    if($_SESSION['dept']!=='admin'){
        echo '<script>parent.location.replace("../signout.php")</script>';
    }
}
if(isset($_GET['aid'])){
	include '../../conns/mll/conn/conn.php';
	$aid = $_GET['aid'];
	$a_get = "SELECT * FROM `a_index` WHERE `id` = $aid";
	$a_req = $conn->query($a_get);
	$a_row= mysqli_fetch_assoc($a_req);
	$a_pic = $a_row['title_pic'];
	$a_pre = $a_row['a_pre'];
	$a_title = $a_row['title'];
	$title_color = $a_row['color'];
	$article = $a_row['article'];
	$cat_id = $a_row['cat_id'];
	$category = $a_row['category'];
	$uid = $a_row['author'];
	
}

?>
<h1>Edit article</h1>
<form id="form" action = "e_article.php" method="post" enctype="multipart/form-data">
<input class= "form-control" type = "text" name = "a_title" id= "a_title" placeholder= "article title" value="<?php if(isset($a_title)){echo $a_title;}?>" autofocus required>
<input class= "form-control" type = "text" name= "title_color" id= "title_color" placeholder = "title color"  value="<?php if(isset($title_color)){echo $title_color;}?>" required>
<select class= "form-control" name= "cat_id" id= "cat_id"  required>
<option  value="<?php if(isset($cat_id)){echo $cat_id;}?>" > <?php if(isset($category)){echo $category;}?> </option>

<?php 
include '../../conns/mll/conn/conn.php';
$sel = "SELECT * FROM `categories` ORDER BY `category` ASC";
echo $sel;
$re= $conn->query($sel);
while($ro= mysqli_fetch_assoc($re)){
	echo '<option value="' . $ro['id'] . '">' . $ro['category'] . '</option>';
}

?>

</select>
<input class= "form-control" type = "file" name= "a_pic" id= "a_pic" accept= "image/*" >
<textarea class= "form-control" id="a_pre" rows="2" cols="100" name="a_pre" required><?php if(isset($a_pre)){echo $a_pre;}else{echo 'article prelude';}?></textarea>
<textarea class= "form-control" id="a_content" rows="10" cols="100" name="a_content" required></textarea>
<textarea name="base64" id="base64" style=";" hidden="hidden" required><?php if(isset($a_pic)){echo $a_pic;}?></textarea>
<input class= "form-control" type = "text" name= "aid" id= "aid" value= "<?php if(isset($aid)){echo $aid;} ?>" hidden="hidden" required>
<button type="submit" value = "submit" name = "submit2" id="submit2" onclick="return false">submit</button>
</form>

<div id='a_get' class="sun-editor-editable">

<?php 

/*
if(isset($_POST['submit2'])){
	echo 'apic is <img src="' . $_POST['base64'] . '"/>';
	echo $_POST['a_content'];
	var_dump($_POST);
}
*/

if(isset($_POST['aid'])){
	include '../../conns/mll/conn/conn.php';
	/*if ( 0 < $_FILES['file']['error'] ) {
	 echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	 }
	 else {
	 //move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
	 }*/
	$aid = $_POST['aid'];
	$a_pic = mysqli_real_escape_string($conn, $_POST['base64']);
	$a_title = mysqli_real_escape_string($conn, $_POST['a_title']);
	$title_color = mysqli_real_escape_string($conn, $_POST['title_color']);
	$article = mysqli_real_escape_string($conn, $_POST['a_content']);
	$a_pre = mysqli_real_escape_string($conn, $_POST['a_pre']);
	$cat_id = $_POST['cat_id'];
	$cc="SELECT * FROM `categories` WHERE `id` = $cat_id";
	$rc=$conn->query($cc);
	$roc = mysqli_fetch_assoc($rc);
	$category = mysqli_real_escape_string($conn, $roc['category']);
	//$article = $_POST['article'];
	$uid = 'admin';
	$uid = mysqli_real_escape_string($conn, $uid);
	
	
	$query = "UPDATE `a_index` SET `title` = '$a_title',
	`author` = '$uid',
	`title_pic` = '$a_pic',
	`color` = '$title_color',
	`article` = '$article', 
	`a_pre` = '$a_pre', 
	`cat_id` = '$cat_id',
	`category` = '$category' WHERE `id` = $aid";
	
	$conn->query($query);
	 //echo $query;
	
	
    echo '<script>location.assign("a_index.php");</script>';
	
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
<script src="../js2/e_article.js"></script>
<script>

document.querySelector(".se-wrapper-wysiwyg").innerHTML = <?php if(isset($article)){echo json_encode($article);}else{echo "";}?>

document.querySelector('.se-placeholder').style.display='none';

</script>

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