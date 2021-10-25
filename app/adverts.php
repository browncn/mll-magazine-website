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
<h2>Add / Edit Homescreen ad</h2>
<form action = "adverts.php" method="post" enctype="multipart/form-data">
<label for= "home_ad"><b>advert image</b></label>
<input class= "form-control" type = "file" name= "home_ad" id= "home_ad" required>
<input class= "form-control" type= "text" name= "a_descr" placeholder= "advert description">
<input class= "form-control" type= "text" name= "a_link" placeholder= "advert link">
<!-- <label for= "a_date">advert deactivation date</label> -->
<input class= "form-control" type= "date" name= "a_date" hidden="hidden" >
<textarea name="base64" id="base64" style=";" hidden="hidden"  required></textarea>
<button class= "btn btn-secondary" type="submit" name = "submit" id="submit">update homescreen ad</button>
</form>


<h2>Add Side ad</h2>
<form action = "adverts.php" method="post" enctype="multipart/form-data">
<label for= "side_ad"><b>advert image</b></label>
<input class= "form-control" type = "file" name= "side_ad" id= "side_ad" required>
<input class= "form-control" type= "text" name= "a_descr" value= "" placeholder= "advert description">
<input class= "form-control" type= "text" name= "a_link" value= "" placeholder= "advert link">
<!-- <label for= "a_date">advert deactivation date</label> -->
<input class= "form-control" type= "date" name= "a_date" hidden="hidden" >
<textarea name="base642" id="base642" style=";" hidden="hidden"  required></textarea>
<button class= "btn btn-secondary" type="submit" value = "submit2" name = "submit2" id="submit2">add side ad</button>
</form>

<h2>available ads</h2>

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

$first= "SELECT * FROM `adverts` ORDER BY `id` ASC LIMIT 1";
$refirst= $conn->query($first);
$rofirst= mysqli_fetch_assoc($refirst);
    echo'<div class= "row">
<div style= "margin:5px; width:20%;">
	<img src= "' . $rofirst['a_pic'] . '" width=100%>
</div>
<div>
	<div><b>' . $rofirst['a_descr'] . '</b></div>
	<div>
        <span><b>link: </b><a href="' . $rofirst['a_link'] . '" target="blank">' . $rofirst['a_link'] . '</a><br>
        <span><b>date: </b>' . $rofirst['date'] . '<br>
        <span><b>status: </b>' . $rofirst['status'] . '<a href="adverts.php?adid=' . $rofirst['id'] . '">change</a>' . '<br>
        
    </div>
</div>
</div>';
    
   
$ad= "SELECT * FROM `adverts` ORDER BY `id` DESC";
$read= $conn->query($ad);
while ($road= mysqli_fetch_assoc($read)){
    if((int)$road['id'] !== 1){
        echo'<div class= "row">
<div style= "margin:5px; width:20%;">
	<img src= "' . $road['a_pic'] . '" width=100%>
</div>
<div>
	<div><b>' . $road['a_descr'] . '</b></div>
	<div>
        <span><b>link: </b><a href="' . $road['a_link'] . '" target="blank">' . $road['a_link'] . '</a><br>
        <span><b>date: </b>' . $road['date'] . '<br>
        <span><b>status: </b>' . $road['status'] . '<a href="adverts.php?adid=' . $road['id'] . '">change</a>' . '<br>
        <a href="adverts.php?adidd=' . $road['id'] . '">delete</a>
    </div>
</div>
</div>';
    }
}

if(isset($_GET['adid'])){
    $adid= $_GET['adid'];
    $gadid= "SELECT * FROM `adverts` WHERE `id`= $adid";
    $regadid= $conn->query($gadid);
    $rogadid= mysqli_fetch_assoc($regadid);
    $active= $rogadid['status'];
    if($active=='active'){
        $active= 'inactive';
    }else{
        $active= 'active';
    }
    $aq= "UPDATE `adverts` SET `status`='$active' WHERE `id`= $adid";
    $conn->query($aq);
    echo '<script>window.location.href= "adverts.php"</script>';
}
if(isset($_GET['adidd'])){
    $adidd= $_GET['adidd'];
    $q= "DELETE FROM `adverts` WHERE `id`= $adidd";
    $conn->query($q);
    echo '<script>window.location.href= "adverts.php"</script>';
}

?>

<div class= "row">
<div>
	<img src= "">
</div>
<div>
	<div></div>
	<div></div>
</div>
</div>

<?php 

if(isset($_POST['submit'])){
    include '../../conns/mll/conn/conn.php';
    ini_set('memory_limit', '1024M');
    
    $a_pic=  mysqli_real_escape_string($conn, $_POST['base64']);
    $a_link=  mysqli_real_escape_string($conn, $_POST['a_link']);
    $a_descr=  mysqli_real_escape_string($conn, $_POST['a_descr']);
    $a_date=  mysqli_real_escape_string($conn, $_POST['a_date']);
    
    $query= "UPDATE `adverts` SET `a_pic`= '$a_pic',
                                  `a_link`= '$a_link',
                                  `a_descr`= '$a_descr',
                                  `exp_date`= '$a_date',
                                `date`= NOW(),
                               `status`= 'active' WHERE `id`=1";
    $conn->query($query);
    echo '<script>alert("update successful")</script>';
    
}

if(isset($_POST['submit2'])){
    include '../../conns/mll/conn/conn.php';
    ini_set('memory_limit', '1024M');
    
    $a_pic=  mysqli_real_escape_string($conn, $_POST['base642']);
    $a_link=  mysqli_real_escape_string($conn, $_POST['a_link']);
    $a_descr=  mysqli_real_escape_string($conn, $_POST['a_descr']);
    $a_date=  mysqli_real_escape_string($conn, $_POST['a_date']);
    
    $query= "INSERT INTO `adverts` (`a_pic`, `a_link`, `a_descr`, `exp_date`, `date`, `status`)
                        VALUES('$a_pic', '$a_link', '$a_descr', '$a_date', NOW(), 'active')";
    
    $conn->query($query);
    echo '<script>alert("successfully added")</script>';
}

?>



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
<script src="../js2/adverts.js"></script>

</body>
</html>
