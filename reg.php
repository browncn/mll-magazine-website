<!DOCTYPE html>
<html>
<?php include 'head.php';?>
    <!-- Start: Login Form Clean -->
    <div class="login-clean">
        <form method="post" action= "reg.php">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
            <div class="form-group"><input class="form-control" type="password" name="pass1" placeholder="Password" required></div>
            <div class="form-group"><input class="form-control" type="password" name="pass2" placeholder="Re-enter password" required></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background: rgba(139,122,12,0.9);">Sign Up</button></div><a class="forgot" href="forgot.html">Forgot your email or password?</a>
            <?php 
            
            if(isset($_POST['email'])){
                $email= $_POST['email'];
                $pass1= $_POST['pass1'];
                $pass2= $_POST['pass2'];
                
                if($pass1 !== $pass2){
                    echo '<div style="color:red;text-align: center;">password mismatch</div>';
                }else{
                    $echeck= "SELECT * FROM `users` WHERE `email`= '$email'";
                    $recheck= $conn->query($echeck);
                    if(mysqli_num_rows($recheck)!==0){
                        echo '<div style="color:red;text-align: center;">user exists. <a href="forgot.php">forgot password?</a></div>';
                    }else{
                        require '../conns/mll/PHPMailer/src/mailconfig.php';
                        $email2= mysqli_real_escape_string($conn, $email);
                        $pass12= mysqli_real_escape_string($conn, $pass1);
                        $eins= "INSERT INTO `users` (`email`, `pass`, `dept`, `reg_date`) VALUES ('$email2', '$pass12', 'reader', NOW())";
                        $conn->query($eins);
                        
                        $login= "SELECT * FROM `users` WHERE `email`= '$email2' AND `pass`= '$pass12'";
                        $relogin= $conn->query($login);
                        $rologin= mysqli_fetch_assoc($relogin);
                        
                        echo '<script>alert("now you can sign in")</script>';
                        
                        $mail->AddAddress($email);
                        $mail->Subject = "NEW REGISTRATION";
                        $mail->Body = "Thank you for registering to <b>My Legal Lifestyle</b> magazine. We hope you enjoy your experience with us.";
                        
                        $mail->send();
                        
                        echo '<script>localStorage.email=' . $rologin['email'] . ';</script>';
                        echo '<script>localStorage.pass=' . $rologin['pass'] . '; </script>';
                        echo '<script>window.location.href="index.php"</script>';
                    }
                }
            }
            
            ?>
        </form>
    </div><!-- End: Login Form Clean -->
    <!-- Start: Footer Dark -->
   <?php include 'footer.php'?>
    <script src="assets/js/jquery.min.js?h=89312d34339dcd686309fe284b3f226f"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=03ab36d1dde930b7d44a712f19075641"></script>
    <script src="assets/js/bs-init.js?h=969dc54771a359915bb04ad880861614"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script src="assets/js/sidebar-with-button.js?h=1b8952d8cba47110081772478660f37b"></script>
    <script src= "js2/index2.js"></script>
</body>

</html>