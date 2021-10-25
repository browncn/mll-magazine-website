<!DOCTYPE html>
<html>
<?php if(!isset($_GET['uid'])){
    include 'head.php';
}else{
    session_start();
    include '../conns/mll/conn/conn.php';
    echo '
<link media = all  rel = stylesheet href="assets/bootstrap/css/bootstrap.min.css">
<link href="css2/css.css" rel="stylesheet">';
}?>
<?php 
if(isset($_GET['uid'])){
    $uid= $_GET['uid'];
    if(isset($_SESSION['email']) && $_SESSION['dept']=='admin'){
        $email= $_SESSION['email'];
        $q= "SELECT * FROM `users` WHERE `email`= '$email' AND `dept`= 'admin'";
        $qres= $conn->query($q);
        if(mysqli_num_rows($qres)==1){
            $q= "SELECT * FROM `users` WHERE `id`= $uid";
            $qres= $conn->query($q);
            if(mysqli_num_rows($qres)==1){
                $qrow= mysqli_fetch_assoc($qres);
                $uid= $qrow['id'];
                $fname= $qrow['fname'];
                $lname= $qrow['lname'];
                $email= $qrow['email'];
                $pass= $qrow['pass'];
                $dept= $qrow['dept'];
                $sub= $qrow['sub'];
                $reg_date= $qrow['reg_date'];
                $sub_date= $qrow['sub_date'];
                $rem_sub= $qrow['rem_sub'];
            }
        }
    }else{
        echo 'illegal access. reported';
        $q= "SELECT * FROM `users` WHERE `email`= '$email'";
        $qres= $conn->query($q);
        if(mysqli_num_rows($qres)==1){
            $qrow= mysqli_fetch_assoc($qres);
            $uid= $qrow['id'];
            $fname= $qrow['fname'];
            $lname= $qrow['lname'];
            $email= $qrow['email'];
            $user_info= $uid . ' ' . $fname . ' ' . $lname . ' ' . $email;
            $info= 'tried another user data edit';
            $rep= "INSERT INTO `rep` (`user_info`, `info`)VALUES('$user_info', '$info')";
            $conn->query($rep);
        }
    }
    
}elseif(isset($_SESSION['id'])){
        $uid= $_SESSION['id'];
        $q= "SELECT * FROM `users` WHERE `id`= $uid";
        $qres= $conn->query($q);
        if(mysqli_num_rows($qres)==1){
            $qrow= mysqli_fetch_assoc($qres);
            $uid= $qrow['id'];
            $fname= $qrow['fname'];
            $lname= $qrow['lname'];
            $email= $qrow['email'];
            $pass= $qrow['pass'];
            $dept= $qrow['dept'];
            $sub= $qrow['sub'];
            $reg_date= $qrow['reg_date'];
            $sub_date= $qrow['sub_date'];
            $rem_sub= $qrow['rem_sub'];
        }
}else{
    echo "please sign in to access this page. ip logged";
}

$uri= $_SERVER['REQUEST_URI'];
?>
        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8 col-lg-9 col-xl-8" style="font-size: 18px;padding: 30px;margin: 10px;">
                <div id='lolli'></div>
                <script>
                document.querySelector('#lolli').innerHTML= ''
                </script>
                <form action= "<?php echo $uri;?>" method= "post">
                <div class= "row w-100 m-auto">
                <input class= "form-control w-50" name= "fname" type= "text" placeholder= "first name" value= "<?php if(isset($fname)){echo $fname;}?>" required>
                <input class= "form-control w-50" name= "lname" type= "text" placeholder= "last name" value= "<?php if(isset($lname)){echo $lname;}?>" required>
                </div>
                <input class= "form-control" name= "email" type= "email" placeholder= "email" value= "<?php if(isset($email)){echo $email;}?>" required>
                <input class= "form-control" name= "pass" type= "password" placeholder= "password" value= "<?php if(isset($pass)){echo $pass;}?>" required>
                <?php if(isset($_GET['uid'])){echo '
                <label for= "dept"><small>department: </small></label>
                <select class= "form-control" name= "dept">
                <option value= "' . $dept . '">' . $dept . '</option>
                <option value= "reader">reader</option>
                <option value= "admin">admin</option> 
                </select>';}
                ?>
                <input class= "form-control" name= "uid" type= "number" placeholder= "password" value= "<?php if(isset($uid)){echo $uid;}?>" hidden="hidden" required>
                <input class= "form-control btn btn-warning" name= "update" value= "update" type= "submit">
                </form>
                <?php 
                if(isset($_POST['update'])){
                    $uid= $_POST['uid'];
                    if(isset($_POST['dept'])){
                        $dept= $_POST['dept'];
                    }else{
                        $dept= $_SESSION['dept'];
                    }
                    
                    $fname= mysqli_real_escape_string($conn, $_POST['fname']);
                    $lname= mysqli_real_escape_string($conn, $_POST['lname']);
                    $email= mysqli_real_escape_string($conn, $_POST['email']);
                    $pass= mysqli_real_escape_string($conn, $_POST['pass']);
                    
                    $upd= "UPDATE `users` SET `fname` = '$fname',
                                              `lname` = '$lname',
                                               `email` = '$email',
                                                `dept` = '$dept',
                                                `pass` = '$pass'
                                                 WHERE `id`= $uid";
                    
                    $conn->query($upd);
                    if($uid == $_SESSION['id'] && $_SESSION['email'] !== $email){
                        echo"<script>alert('please sign in again')</script>";
                        echo '<script>window.open("signout.php", "_blank")</script>';
                    }
                    if($uid == $_SESSION['id'] && $_SESSION['dept'] !== $dept){
                        echo"<script>alert('please sign in again')</script>";
                        echo '<script>window.open("signout.php", "_blank")</script>';
                    }
                    echo '<script>window.location.assign("' . $uri . '")</script>';
                }
              
              
              ?>
              <br>
              <div class= "row w-100 m-auto" style= "background : #f3f3f3; padding : 10px; border-radius: 5px;">
              <div class= "w-50"> <h6>current subscriptions: </h6> <?php echo $rem_sub;?></div>
              <div class= "ml-auto"> <?php if(!isset($_GET['uid'])){echo '<a href= "sub.php" class= "form-control btn btn-danger" role= "button">subscribe</a>';}?> </div>
              </div>
              <br><br>
              <div class= "m-auto" style="background : #efefef; padding: 10px; border-radius: 5px;">
              	<h4>Subscription History</h4>
              	<table>
              	<?php 
              	$subs= "SELECT * FROM `sub_history` WHERE `uid`= $uid ORDER BY `id` DESC";
              	$resubs= $conn->query($subs);
              	if(mysqli_num_rows($resubs)>0){
              	    while($rosubs= mysqli_fetch_assoc($resubs)){
              	        echo '<tr><td>' . date('Y F, l.', strtotime($rosubs['sub_date'])) . '</td><td>' . '&nbsp' . $rosubs['sub_amount'] , ' issues </td></tr>'; 
              	    }
              	}else{
              	    echo '<tr><td><i>no subscriptions yet</i></td></tr>';
              	}
              	
              	
              	?>
              	</table>
              	
              </div>     
              </div>           
                <div class="col-md-4 col-lg-3 offset-xl-0" style="background-color: #000000;padding: 0;">
                    <?php if(!isset($_GET['uid'])){
                        include 'side_ad.php';
                    }?>
                </div>
        </div>
    </div>
    <?php if(!isset($_GET['uid'])){
        include 'footer.php';
    }?>
    <script src="assets/js/jquery.min.js?h=89312d34339dcd686309fe284b3f226f"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=0168f7c1e0d08faa2f4b13f4a1dc8c98"></script>
    <script src="assets/js/bs-init.js?h=a24a748d1ebf2b30dec97d2c79b26872"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script src="assets/js/sidebar-with-button.js?h=1b8952d8cba47110081772478660f37b"></script>
</body>

</html>