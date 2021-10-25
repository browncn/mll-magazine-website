
<html>
<head>
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css?h=c2c6f5cbd9b95ae9dbac66a21e67d465">
<link href="../css2/css.css" rel="stylesheet">

</head>
<body style= "height: auto;">

<?php
session_start();

if(isset($_POST['email'])){
	
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	
	if($email == '' || $pass == ''){
		echo '<b style= color:red;font-size:10px;">login details blank</b>';
	}else{
		include '../../conns/mll/conn/conn.php';
		
		$query = "SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$pass'";		
		$ret = $conn->query($query);
		if(mysqli_num_rows($ret)==0){
			echo '<b style= color:red;font-size:10px;">invalid username or password</b>';
		}else{
			$rot = mysqli_fetch_assoc($ret);
			$dept = $rot['dept'];
			$fname = $rot['fname'];
			$id= $rot['id'];
			if($dept == 'reader'){
			    $_SESSION['email']= $email;
			    $_SESSION['dept']= $dept;
			    $_SESSION['id']= $id;

			}
			if($dept == 'admin'){
			    $_SESSION['email']= $email;
			    $_SESSION['dept']= $dept;
			    $_SESSION['id']= $id;
			    
			}
			
		}
	}
}

    if(isset($_SESSION['email']) && isset($_SESSION['dept'])){
        $email = $_SESSION['email'];
        $dept= $_SESSION['dept'];
        
        if($email == '' ){
            echo '<b style= color:red;font-size:10px;">blank submit</b>';
        }else{
            if($dept == 'reader'){
                echo '<div id = "access"><b>' . $email . '</b><a  href="../user.php" target= "_parent">my profile</a><a  href="../signout.php" target= "_parent">sign out</a></div>';
            }
            if($dept == 'admin'){
                echo '<div id = "access"><b>' . $email . '</b><a  href="../editor.html" target= "_parent">admin</a><a  href="../user.php" target= "_parent">my profile</a><a  href="../signout.php" target= "_parent">sign out</a></div>';
                
            }
        }
    }else{
        echo '<form class="form-inline d-md-flex justify-content-md-end" method="post" style="margin-top: 20px;">
                        <div class="form-group"><input class="form-control" type="email" id="email" name="email" placeholder="Your Email" style=""><input class="form-control" type="password" id="pass" name="pass" placeholder="Password" style="">
                            <button class="btn text-white" id="signin" type="submit" style="background-color: #957e03;margin-right: 5px;">sign in</button>
                            <a class="btn" role="button" href="reg.php" style="background: #c8ced7;color: rgba(139,122,12,0.9);margin-right: 5px;">register</a><a class="btn" role="button" href="forgot.html" style="margin: auto;background: white;color: rgba(139,122,12,0.9);">forgot password</a>
                        </div>
                    </form>
                    ';
    }


?>

</body>
</html>
