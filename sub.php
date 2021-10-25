<!DOCTYPE html>
<html>

<?php 
session_start() ;
include 'head.php'; 

if(isset($_POST['done']))
    {
        $done= $_POST['done'];
        if($done== 'successful'){
            
                    $email= $_SESSION['email'];
                    $sid= (int)$_SESSION['sid'];
                    $amount= (int)$_SESSION['amount'];
                    $sub= "SELECT * FROM `subs` WHERE `id`= $sid";
                    $resub= $conn->query($sub);
                    if(mysqli_num_rows($resub)!==0){
                        $rosub= mysqli_fetch_assoc($resub);
                        $sid= $rosub['id'];
                        $samount= (int)$rosub['iamount'];
                        $sprice= (int)$rosub['iprice'];
                    }
                    $i= "SELECT * FROM `users` WHERE `email`= '$email'";
                    $rei= $conn->query($i);
                    if(mysqli_num_rows($rei)!==0){
                        $roi= mysqli_fetch_assoc($rei);
                        $u_id= (int)$roi['id'];
                        $rem_sub= (int)$roi['rem_sub'];
                        $rem_sub= $rem_sub + $samount;
                        $sins= "INSERT INTO `sub_history` (`uid`, `sub_date`, `sub_amount`, `sub_price`)
                        VALUES ($u_id, NOW(), $samount, $sprice)";
                        $conn->query($sins);
                        $iup= "UPDATE `users` SET `sub_date`= NOW(), `rem_sub`= $rem_sub WHERE `id` = $u_id";
                        $conn->query($iup);
                        require '../conns/mll/PHPMailer/src/mailconfig.php';
                        
                        $mail->AddAddress($_SESSION['email']);
                        $mail->Subject = "NEW SUBSCRIPTION ADDED";
                        $mail->Body = "Thank you for subscribing. If you have an issue, enquiry or want to report false subscription purchase, please reach out to us <a href='mylegallifestyle.com/contact.php'>here</a>.<br><b>number of issues:</b>" . $samount . "<br><b>total paid: </b>" . $sprice * $samount ;
                        
                        $mail->send();
                        $_SESSION['amount']= '';
                        $_SESSION['sid']= '';
                         
                        echo '<script>alert("Payment successful")</script>';
                    }
        }else{
            echo '<script>alert("payment failed")</script>';
        }
    }
?>
    <!-- Start: Team Boxed -->
    <div class="team-boxed">
        <div class="container">
            <!-- Start: Intro -->
            <div class="intro">
                <h2 class="text-center">Subscription Plans</h2>
                <p class="text-center" style="margin-bottom: 20px;">select the amount of magazine issues you would like to subscribe for...</p>
            </div><!-- End: Intro -->
            <!-- Start: Pricing Table - 1 -->
            <section class="bg-light py-5">
                <h2 class="text-center mb-5" style="padding: 0;">Pricing Table</h2>
                <div class="container">
                    <div class="row">
                    <?php 
                    if(isset($_SESSION['email'])){
                        $email= $_SESSION['email'];
                    }else{$email='';} 
                    
                    $sub= "SELECT * FROM `subs` ORDER BY `iamount` ASC";
                    $resub= $conn->query($sub);
                    while($rosub= mysqli_fetch_assoc($resub)){
                        $sid= $rosub['id'];
                        $samount= (int)$rosub['iamount'];
                        $sprice= (int)$rosub['iprice'];
                        if($samount == 1){
                            $issue= 'issue';
                        }else{
                            $issue= 'issues';
                        }
                        
                        echo '<div class="col-md-6 col-lg-4 text-center">
                            <div class="card mb-4">
                                <div class="bg-white card-header">
                                    <h4 class="text-primary">' . $samount . ' ' . $issue . '</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="d-flex d-sm-flex d-md-flex justify-content-center justify-content-sm-center justify-content-md-center card-title"><small class="text-muted">N' . $samount * $sprice . '</small></h1>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">&nbsp;N' . $sprice . ' / issue</li>
                                        <li class="mb-2">&nbsp;</li>
                                    </ul>';
                                    echo '<form action= "sub.php" method="post">';
                        echo '<input name= "amount" type="hidden" value=' . $samount * $sprice . '>';
                        echo '<input name= "email" type="hidden" value=' . $email . '>';
                        echo '<input name= "sid" type="hidden" value=' . $sid . '>
                        <!-- Start: Button - 1 --><input type= "submit" class="btn btn-primary mt-2" role="button" value="Subscribe" name= "subscribe" ><!-- End: Button - 1 -->
                                </div>
                            </div>
                        </div>';
                        echo '</form>';
                    }
                    
                    if(isset($_SESSION['email'])){
                        if($_SESSION['email'] == ''){
                            echo '<script>alert("please login first")</script>';
                        }else{
                             if(isset($_POST['subscribe']) &&  isset($_POST['sid']) && isset($_POST['amount'])){
                                 $_SESSION['sid']= $_POST['sid'];
                                 $_SESSION['email']= $_POST['email'];
                                 $_SESSION['amount']= $_POST['amount'];
                                 
                                 echo '<script>window.location.href="pay.php"</script>';
                            }
                        }
                    }else{
                        echo '<script>alert("please register first")</script>';
                    }
                    
                    ?>
                    
                    <?php 

?>

<?php 
    
?>
                        
                    </div>
                </div>
            </section><!-- End: Pricing Table - 1 -->
        </div>
    </div><!-- End: Team Boxed -->
    <!-- Start: Footer Dark -->
    <?php include 'footer.php'; ?>
    <script src="assets/js/jquery.min.js?h=89312d34339dcd686309fe284b3f226f"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=03ab36d1dde930b7d44a712f19075641"></script>
    <script src="assets/js/bs-init.js?h=969dc54771a359915bb04ad880861614"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script src="assets/js/sidebar-with-button.js?h=1b8952d8cba47110081772478660f37b"></script>
    <script src= "js2/index2.js"></script>
    
  
  
</body>

</html>