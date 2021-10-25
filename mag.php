<!DOCTYPE html>
<html>
<?php 
include 'head.php'; 

if(isset($_GET['m'])){
    $m= $_GET['m'];
    $mq= "SELECT * FROM `catalogue` WHERE `id` = $m";
    $remq= $conn->query($mq);
    $romq= mysqli_fetch_assoc($remq);
    
    
}

?>
    <div>
        <div class="container">
            <div style="background: url(&quot;assets/img/MLL2.png?h=5fc1621f1fe37057f68c0fc43dc9ce70&quot;) no-repeat;background-size: cover;width: 100%;height: 100%;opacity: 0.03;position: absolute;filter: grayscale(99%);"></div>
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8 col-lg-9" style="font-size: 18px;">
                    <div class="row" style="margin-bottom: 100px;">
                        <div class="col-md-12">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center" style="background: #efefef;height: 150px;">
                                <div class="intro">
                                    <h2 class="text-center" style="font-family: 'IM Fell Great Primer SC', serif;margin-+bottom: 0;"><?php echo date('F Y', strtotime($romq['date']));?> edition</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 100px;">
                        <div class="col-md-6"><img data-aos="fade-right" data-aos-duration="2000" data-aos-delay="100" src="<?php echo $romq['i_pic'];?>" style="width: 100%;box-shadow: 10px 10px 20px 7px #c8ced7;"></div>
                        <div class="col-md-6 col-xl-5" data-aos="fade" data-aos-duration="1000">
                            <div class="intro">
                                <p class="text-left"><span class="by" style="font-family: 'IM Fell Great Primer SC', serif;color: #957e03;">my legal lifestyle</span> </p>
                                <h4 class="text-left" style="color: inherit;"><?php echo $romq['i_title'];?></h4>
                                <p class="text-left"><span class="by" style="font-family: Almendra, serif;color: #d2113a;"><?php echo date('F Y', strtotime($romq['date']));?> Edition</span> </p>
                            </div>
                            <div class="text">
                                <p class="text-left" style="font-size: 15px;padding-right: 50px;"><?php echo $romq['i_descr'];?><br><br></p>
                                <p class="text-left" style="font-size: 17px;padding-right: 50px;font-family: Roboto, sans-serif;"><?php echo $romq['i_descr2'];?><br><br></p>
                            </div>
                            <form action= "mag.php?m=<?php echo $m;?>" method= POST>
                            <button role="button" type= "submit" name= "gmag" class="btn" data-aos="slide-left" data-aos-duration="3000" data-aos-once="true" style="width: 70%;background: rgba(139,122,12,0.9);color: #ffffff;box-shadow: 10px 10px 20px 7px #c8ced7;font-family: 'IM Fell Great Primer SC', serif;">request for this issue</button>
                            </form>
                            <?php 
                           if(isset($_POST['gmag'])){
                               if(isset($_SESSION['email'])){
                                   $email= $_SESSION['email'];
                                   $email2= $email;
                                   $scheck= "SELECT * FROM `users` WHERE `email`='$email2'";
                                   $sres= $conn->query($scheck);
                                   $sro= mysqli_fetch_assoc($sres);
                                   $rem= $sro['rem_sub'];
                                   $read= (string) $sro['iread'];
                                   $crem= (string)$rem;
                                   $crem= ',' . $m . ',';
                                   $strp= strpos($read, $crem)  ;
                                   
                                   if($rem==0 && $strp=== false){
                                       echo 'please <a href="sub.php">subscribe</a> to download content';

//echo $rem . $crem . $read;
//echo $strp;
                                   }elseif($strp !== false){
                                           
                                       $m_count= "UPDATE `catalogue` SET `r_count`=`r_count`+1 WHERE `id` = $m";
                                       $conn->query($m_count);
                                       echo '<a href="' .  $romq['issue'] . '"download="MLL ' . date('F Y', strtotime($romq['date'])) . ' Edition">download</a>';
                                   }elseif($rem>0){
                                       $read= $read . $crem;
                                       $rem= (int)$sro['rem_sub'];
                                       $rem = $rem-1;
                                       $mod= "UPDATE `users` SET `rem_sub`= '$rem',
                                       `iread`= '$read' WHERE `email`= '$email2'";
                                       
                                       $m_count= "UPDATE `catalogue` SET `r_count`=`r_count`+1 WHERE `id` = $m";
                                       $conn->query($m_count);
                                       
                                       $conn->query($mod);
                                       echo '<a href="' .  $romq['issue'] . '"download="MLL ' . date('F Y', strtotime($romq['date'])) . ' Edition">download</a>';
                                   }
                                   
                               }else{
                                   echo 'please <a href="reg.php">register</a> and subscribe to download content';
                               }
                           }
                            
                            ?>
                            </div>
                        <div class="col" style="margin-top: 50px;">
                            <div>
                            <div class="fb-comments" data-href="http://localhost/mll/mag.php?m=<?php echo $m;?>" data-width="" data-numposts="10"></div>
                                
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 offset-xl-0" style="background-color: #000000;padding: 0;">
                <?php include 'side_ad.php';?>
            </div>
        </div>
    </div>
    </div>
    <?php include 'footer.php';?>
    <script src="assets/js/jquery.min.js?h=89312d34339dcd686309fe284b3f226f"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=0168f7c1e0d08faa2f4b13f4a1dc8c98"></script>
    <script src="assets/js/bs-init.js?h=a24a748d1ebf2b30dec97d2c79b26872"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script src="assets/js/sidebar-with-button.js?h=1b8952d8cba47110081772478660f37b"></script>
    <script src= "js2/index2.js"></script>
</body>

</html>