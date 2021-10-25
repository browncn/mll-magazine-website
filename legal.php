<!DOCTYPE html>
<html>
<?php include 'head.php';?>
    <div>
        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8 col-lg-9 col-xl-8" style="font-size: 18px;padding: 30px;margin: 10px;">
                <?php 
                if(isset($_GET['l'])){
                    $l= $_GET['l'];
                    if($l == 'about'){
                        echo '<div class="intro" style="margin-bottom: 30px;">
                        <h2 class="text-left text-body" style="margin-bottom: 10px;color: #888888!important;">ABOUT US</h2>
                    </div>
                    <div class="text sun-editor-editable" style="color: #888888!important;">';
                        
                        include '../conns/mll/conn/conn.php';
                        $get="SELECT `about` FROM `legal` LIMIT 1";
                        $re=$conn->query($get);
                        $ro = mysqli_fetch_assoc($re);
                        echo $ro['about'];
                    }
                    if($l == 'agreement'){
                        echo '<div class="intro" style="margin-bottom: 30px;">
                        <h2 class="text-left text-body" style="margin-bottom: 10px;color: #888888!important;">SUBMISSION AGREEMENT</h2>
                    </div>
                    <div class="text sun-editor-editable" style="color: #888888!important;">';
                        
                        include '../conns/mll/conn/conn.php';
                        $get="SELECT `agreement` FROM `legal` LIMIT 1";
                        $re=$conn->query($get);
                        $ro = mysqli_fetch_assoc($re);
                        echo $ro['agreement'];
                    }
                    if($l == 'terms'){
                        echo '<div class="intro" style="margin-bottom: 30px;">
                        <h2 class="text-left text-body" style="margin-bottom: 10px;color: #888888!important;">TERMS AND CONDITIONS</h2>
                    </div>
                    <div class="text sun-editor-editable" style="color: #888888!important;">';
                        
                        include '../conns/mll/conn/conn.php';
                        $get="SELECT `terms` FROM `legal` LIMIT 1";
                        $re=$conn->query($get);
                        $ro = mysqli_fetch_assoc($re);
                        echo $ro['terms'];
                    }
                    echo '</div></div>';
                }
                            
                        ?>
                    
                    
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