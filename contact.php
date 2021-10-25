<!DOCTYPE html>
<html>

<?php include 'head.php';

$query = "SELECT * FROM `contact`";

$res = $conn->query($query);
$ro= mysqli_fetch_assoc($res);

$addr= $ro['addr'];
$state= $ro['state'];
$city= $ro['city'];
$country= $ro['country'];
$tel= $ro['tel'];
$email= $ro['email'];
?>
    <div>
        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8 col-lg-9 col-xl-8" style="font-size: 18px;padding: 30px;margin: 10px;">
                    <div class="intro" style="margin-bottom: 30px;">
                        <h2 class="text-left text-body" style="margin-bottom: 10px;">CONTACT US</h2>
                    </div>
                    <div class="text">
                        <h4 style="color: inherit;">Address</h4>
                        <p> <?php echo $addr . ',';?></p>
                        <p> <?php echo $city . ', ' . $state . ',';?></p>
                        <p> <?php echo $country . '.';?></p>
                    </div>
                    <div class="text" style="margin-bottom: 20px;">
                        <h4 style="color: inherit;">Email</h4><a href="mailto:dreamddiamondsconcept@gmail.com"><?php echo $email;?><br></a>
                    </div>
                    <div class="text">
                        <h4 style="color: inherit;">Mobile</h4><a href="tel:<?php echo $tel;?>"><p> <?php echo $tel;?></p><br></a>
                    </div>
                    <br><br>
                    <form method="post">
                        <h2 class="text-center">Or Reach Out&nbsp;</h2>
                        <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name"></div>
                        <div class="form-group"><input class="form-control is-invalid" type="email" name="email" placeholder="Email"><small class="form-text text-danger">Please enter a correct email address.</small></div>
                        <div class="form-group"><textarea class="form-control" name="message" placeholder="Message" rows="14"></textarea></div>
                        <div class="form-group"><button class="btn btn-primary" type="submit">send </button></div>
                    </form>
                    <?php 
                    if(isset($_POST['email'])){
                        $email= $_POST['email'];
                        $name= $_POST['name'];
                        $message= $_POST['message'];
                        
                        require ',,/PHPMailer/src/mailconfig.php';
                        
                        
                        $mail->Subject = "MESSAGE SENT THROUGH WEBSITE CONTACT FORM";
                        $mail->Body = $name . '<br><br>' . $email . '<br><br>' . $message;
                        
                        $mail->send();
                        
                        echo '<script>alert("mail sent successfully")</script>';
                    }
                    
                    ?>
                </div>
                <div class="col-md-4 col-lg-3 offset-xl-0" style="background-color: #000000;padding: 0;">
                   <?php include 'side_ad.php';?>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php';?>
    <script src="assets/js/jquery.min.js?h=89312d34339dcd686309fe284b3f226f"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=03ab36d1dde930b7d44a712f19075641"></script>
    <script src="assets/js/bs-init.js?h=969dc54771a359915bb04ad880861614"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script src="assets/js/sidebar-with-button.js?h=1b8952d8cba47110081772478660f37b"></script>
    <script src= "js2/index2.js"></script>
</body>

</html>