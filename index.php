<!DOCTYPE html>
<html>
<?php include 'head.php';?>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding: 0px;">
                    <div class="carousel slide carousel-fade" data-ride="carousel" id="carousel-1">
                        <div class="carousel-inner">
                        <?php 
                        $jum0= "SELECT * FROM `jumbotron` ORDER BY `id` ASC";
                        $rejum0= $conn->query($jum0);
                        $active= 'active';
                        $activechk= false;
                        while($rojum0 = mysqli_fetch_assoc($rejum0)){
                            $ju= $rojum0['j_id'];
                            $jum= "SELECT * FROM `a_index` WHERE `id`= $ju";
                            $rejum= $conn->query($jum);
                            while($rojum= mysqli_fetch_array($rejum)){
                                if($activechk==false){
                                    $active='active';
                                    $activechk=true;
                                }else{
                                    $active='';
                                }
                                echo '<div class="carousel-item ' . $active . '"><img class="w-100 d-block" src="' . $rojum['title_pic'] . '" alt="Slide Image" height="400px">
                                <a href= "article.php?aid=' . $rojum['id'] . '" style="color:inherit;"><div style="background-color: rgba(149,126,3,1);padding: 5px;">
                                    <h2 style="padding: 15px;">' . $rojum['title'] . '</h2>
                                </div></a>
                            </div>';
                            }
                        }
                        
                        ?>

                        </div>
                        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next d-none" href="#carousel-1"
                                role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container" style="background-color: #f0f0f0;">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 20px;">
                    <h3 style="margin-top: 8px;margin-bottom: 0px;">This just in...</h3>
                </div>
            </div>
            <div class="row">
            	<?php 
            	$latest = "SELECT * FROM `a_index` ORDER BY `id` DESC LIMIT 3";
            	$relatest=$conn->query($latest);
            	while($rolatest=mysqli_fetch_assoc($relatest)){
            		echo '<div class="col-md-3">
                    <div class="card"><img class="card-img-top w-100 d-block" src="' . $rolatest['title_pic'] . '">
                        <div class="card-body">
                            <h4 class="card-title">' . $rolatest['title'] . '</h4>
                            <p class="card-text">' . $rolatest['a_pre'] . '</p><a class="btn text-white" role="button" style="background: #b3a84b;" href="article.php?aid=' . $rolatest['id'] . '">read more</a></div>
                    </div>
                </div>';
            	}
            	?>
                <div class="col-md-4 col-lg-3 offset-xl-0" style="background-color: #000000;padding: 0;">
                    <?php include 'side_ad.php';?>
                </div>
                <?php 
                $ad= "SELECT * FROM `adverts` ORDER BY `id` DESC LIMIT 4";
                $read= $conn->query($ad);
                while ($road= mysqli_fetch_assoc($read)){
                    if((int)$road['id'] !== 1 && $road['status'] == 'active'){
                        echo '<div class="col-md-3">
                    <div class="card"><a href="https://' . $road['a_link'] . '" target="blank"><img class="card-img d-block w-100 h-100" src="' . $road['a_pic'] . '" height="400px" style="box-shadow: 0px 0px;"></a></div>
                </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div>
        <div class="d-lg-flex justify-content-lg-center align-items-lg-center" id="box-2">
        <?php 
        $first= "SELECT * FROM `adverts` ORDER BY `id` ASC LIMIT 1";
        $refirst= $conn->query($first);
        $rofirst= mysqli_fetch_assoc($refirst);
        if($rofirst['status'] == 'active'){
            echo'<div style="width : 100%; height : 100%;">
	<a href="https://' . $rofirst['a_link'] . '" target="blank"><img src= "' . $rofirst['a_pic'] . '" width=100% height= 100%></a>
           </div>';
        }
        
        ?>
            
        </div>
    </div>
    <div class="text-center d-lg-flex justify-content-lg-center align-items-lg-center" style="height: auto;padding-top: 10%;padding-bottom: 10%;background-color: #000000;">
        <div class="container-fluid" data-aos="fade" data-aos-duration="1000">
            <div class="intro">
                <h2 class="text-center" style="color: #fefefe;">Prestine news with Prestige</h2>
                <p class="text-center" style="color: #fefefe;">Purchase our monthly editorial and have all your latest news, tips and stories all in one place. <strong style="color: red;font-size: 20px;">Whenever</strong>&nbsp;you want, <strong style="color: red;font-size: 20px;">Wherever</strong>&nbsp;you
                    want it.</p>
                <p class="text-center" style="color: #d2113a;">top 3 most read issues</p>
            </div>
            <div class="row d-lg-flex justify-content-lg-center align-items-lg-center photos" data-aos="slide-up" data-aos-duration="2000" data-aos-delay="500">
                <?php 
                $top = "SELECT * FROM `catalogue` ORDER BY `r_count` DESC LIMIT 3";
                $retop=$conn->query($top);
                while($rotop=mysqli_fetch_assoc($retop)){
                	echo '<div class="col-sm-6 col-md-4 col-lg-3 item" data-bs-hover-animate="pulse"><a href="mag.php?m=' . $rotop['id'] . '"><img class="img-fluid" src="' . $rotop['i_pic'] . '"></a></div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="article-list">
        <div class="container">
            <div class="intro" style="height: auto;">
                <h2 class="text-center" style="margin-bottom: 10px;color: rgb(33,37,41);">Most Read</h2>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">
            <?php 
                $catget = "SELECT * FROM `categories`";
                $recatget= $conn->query($catget);
                while($rocatget = mysqli_fetch_assoc($recatget)){
                    $catid= $rocatget['id'];
                    $catcat= $rocatget['category'];
                    echo '<div class="col-md-3" style="margin-bottom: 30px;">
                    <h6 style="background-color: rgba(193,19,8,0.15);padding: 8px;">' . $catcat . '</h6>';
                    $acat= "SELECT * FROM `a_index` WHERE `cat_id` = $catid ORDER BY `id` DESC LIMIT 1";
                    $reacat = $conn->query($acat);
                    $roim= mysqli_fetch_assoc($reacat);
                    echo '<div class="card"><img class="card-img-top w-100 d-block" src= "' . $roim['title_pic'] . '" width= "100%">';
                        echo '<div class="card-body">
                            <ul class="list-unstyled">';
                    $acat= "SELECT * FROM `a_index` WHERE `cat_id` = $catid ORDER BY `id` DESC LIMIT 5";
                    $reacat = $conn->query($acat);
                    while($roacat = mysqli_fetch_assoc($reacat)){
                        $aid= $roacat['id'];
                        $title= $roacat['title'];
                        echo '<li class="index_list" style="margin-bottom: 5px;"><a style=" color: inherit;" href=article.php?aid=' . $aid . '>' . substr($title, 0, 50) . '...' . '</a></li>';
                    }
                    echo '</ul><a class="btn" role="button" style="background-color: rgb(179,168,75);color: white; font-size: 12px;" href=list.php?cat=' . $catid . '>more from this section</a>';
                    echo '</div></div></div>';
                }
            
            ?>
            </div>
    	</div>
	</div>            
	<h1 class="d-xl-flex justify-content-xl-center" style="margin-top: 50px;font-family: Lora, serif;color: grey;">My Legal Lifestyle (MLL) latest issues</h1>
    <div class="accordian" style="margin-bottom: 50px;margin-top: 50px;background-color: #040202;">
        <ul>
        	<?php 
        	$ilatest = "SELECT * FROM `catalogue` ORDER BY `id` DESC LIMIT 5";
        	$reilatest=$conn->query($ilatest);
        	while($roilatest=mysqli_fetch_assoc($reilatest)){
        		echo '<li><a class="image_title" href="mag.php?i=' . $roilatest['id'] . '"></a><a href="mag.php?m=' . $roilatest['id'] . '"><img src="' . $roilatest['i_pic'] . '" width="300px" height="400px"></a></li>';
        	}
        	?>
        </ul>
    </div>
    <p class="text-center" style="margin-bottom: 50px;font-size: 20px;font-family: 'IM Fell Great Primer SC', serif;" font-weight="bold">click <a href="catalogue.php">here</a>&nbsp;for a complete list of out catalogue...</p>
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