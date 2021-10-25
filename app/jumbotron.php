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
include '../../conns/mll/conn/conn.php';
$j_array= array();
$j = "SELECT * FROM `jumbotron`";
$rej= $conn->query($j);
while($roj= mysqli_fetch_assoc($rej)){
    array_push($j_array, $roj['j_id']);
}

?>

<h1>Edit Banner Headlines</h1>
<form action = "jumbotron.php" method="post" enctype="multipart/form-data">

<?php 

foreach($j_array as $x=> $y){
    echo '<label for= "j_id_new">specify an article id to add it to the banner ( or leave blank to keep previous)</label>';
    echo '<input class= "form-control" type = "number" name= "' . $x++ . '" id= "j_id_new" placeholder = "add id" value= "' . $y . '" required><br>';
    
    $get = "SELECT * FROM `a_index` WHERE `id` = $y ORDER BY `id` DESC";
    
    $re_get = $conn->query($get);
    while($ro_get=mysqli_fetch_assoc($re_get)){
        echo '<div class="row artdiv"><div class="imgdiv" style= "margin:10px;"><img src="' . $ro_get['title_pic'] . '" width=100% height=100px/>
			</div><div class="infodiv">' . 
			'<h2><a href= "e_article.php?aid=' . $ro_get['id'] . '" style= "color:' . $ro_get['color'] . ';">' . substr($ro_get['title'], 0, 20) . '...' . '</a></h2>' . 
			'' . $ro_get['id'] . ' - ' . $ro_get['category'] . '</a><br>' . 
			'' . $ro_get['author'] . '</a><br>' . 
			'</div></div>';
    }


}

?>

<button type="submit" value = "submit" name = "submit" id="submit">submit</button>
</form>

<div id='a_get' class="sun-editor-editable">


<?php 

if(isset($_POST['submit'])){
	array_pop($_POST);
	foreach($_POST as $x=>$y){
	    $p= (int)$x;
	    $p++;
	    $query= "UPDATE `jumbotron` SET `j_id` = $y WHERE `id` = $p";
	    $conn->query($query);
	    $query;
	}
	
	echo '<script>location.assign("jumbotron.php");</script>';
	
	
	
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