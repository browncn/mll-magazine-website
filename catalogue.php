<!DOCTYPE html>
<html>
<?php include 'head.php';?>
    <div class="highlight-clean" style="background: #efefef;border-top-style: solid;border-top-color: #957e03;margin-bottom: 20px;">
        <div class="container">
            <div class="intro">
                <h2 class="text-center" style="font-family: Lora, serif;margin-bottom: 0;">My Legal Lifestyle (MLL) Catalogue</h2>
                <p class="text-center" style="font-family: Lora, serif;">find and download your preferred issue that contains your most favored stories and articles. Take it, read it, everywhere, anywhere...</p>
            </div>
            <div class="buttons"></div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin: auto;">
        <?php 
        $cq= "SELECT * FROM `catalogue` ORDER BY `id` DESC";
        $recq= $conn->query($cq);
        while($rocq= mysqli_fetch_assoc($recq)){
            echo '<div class="col-3 col-sm-12 col-md-5 col-lg-4 col-xl-3" style="margin: auto;margin-bottom: +20px;">
                <figure class="figure" style="margin: 0;"><img class="img-fluid figure-img" src="' . $rocq['i_pic'] . '" width="100%" style="margin: 0;">
                    <a href="mag.php?m=' . $rocq['id'] . '">
                        <div class="card-img-overlay text-light cont-fadein" style="height: 100%;background-color: rgba(139,122,12,0.9);width: inherit;">
                            <h4>' . date('F Y', strtotime($rocq['date'])) . '</h4>
                            <p class="text-left" style="font-size: 100%;"><br>' . substr($rocq['i_descr'], 0, 50) . '...' . '<br><br></p>
                        </div>
                    </a>
                </figure>
            </div>';
        }
        
        
        ?>
            
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