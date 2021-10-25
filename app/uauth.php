<?php
session_start();
if(!isset($_SESSION['dept'])){
    echo '<script>parent.location.replace("../signout.php")</script>';
}else{
    if($_SESSION['dept']!=='admin'){
        echo '<script>parent.location.replace("../signout.php")</script>';
    }
}
if(isset($_POST['signin'])){
	
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
			    echo $fname . '!@#$' . $email . '!@#$' . $dept . '!@#$<div id = "access"><b>' . $email . '</b><a  href="user.php">my profile</a><a  href="signout.php">sign out</a></div>';
			    $_SESSION['email']= $email;
			    $_SESSION['dept']= $dept;
			    $_SESSION['id']= $id;

			}
			if($dept == 'admin'){
			    echo $fname . '!@#$' . $email . '!@#$' . $dept . '!@#$<div id = "access"><b>' . $email . '</b><a  href="editor.html">admin</a><a  href="user.php">my profile</a><a  href="signout.php">sign out</a></div>';
			    $_SESSION['email']= $email;
			    $_SESSION['dept']= $dept;
			    $_SESSION['id']= $id;
			    
			}
			
		}
	}
}



if(isset($_POST['uauth'])){
    if(isset($_SESSION['email']) && isset($_SESSION['dept'])){
        $email = $_SESSION['email'];
        $dept= $_SESSION['dept'];
        
        if($email == '' ){
            echo '<b style= color:red;font-size:10px;">blank submit</b>';
        }else{
            if($dept == 'reader'){
                echo 'abcde<div id = "access"><b>' . $email . '</b><a  href="user.php">my profile</a><a  href="signout.php">sign out</a></div>';
                
            }
            if($dept == 'admin'){
                echo 'abcde<div id = "access"><b>' . $email . '</b><a  href="editor.html">admin</a><a  href="user.php">my profile</a><a  href="signout.php">sign out</a></div>';
                
            }
            
        }
    }	
}

?>