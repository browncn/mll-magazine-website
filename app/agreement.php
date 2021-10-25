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
	include '../../conns/mll/conn/conn.php';
	$aid = 1;
	$a_get = "SELECT * FROM `legal` WHERE `id` = $aid";
	$a_req = $conn->query($a_get);
	$a_row= mysqli_fetch_assoc($a_req);
	$article = $a_row['agreement'];

	


?>
<h1>Edit Agreement</h1>
<form id="form" action = "agreement.php" method="post" enctype="multipart/form-data">
<textarea class= "form-control" id="a_content" rows="10" cols="100" name="a_content" required></textarea>
<input class= "form-control" type = "text" name= "aid" id= "aid" value= "<?php if(isset($aid)){echo $aid;} ?>" hidden="hidden" required>
<button type="submit" value = "submit" name = "submit2" id="submit2" onclick="return false">submit</button>
</form>

<div id='a_get' class="sun-editor-editable">

<?php 

if(isset($_POST['aid'])){
	include '../../conns/mll/conn/conn.php';
	$aid = $_POST['aid'];
	$article = mysqli_real_escape_string($conn, $_POST['a_content']);
	
	$query = "UPDATE `legal` SET `agreement` = '$article' WHERE `id` = $aid";
	
	$conn->query($query);
	 //echo $query;
	
	
    echo '<script>location.assign("agreement.php");</script>';
	
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
<script src="../js2/agreement.js"></script>
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


