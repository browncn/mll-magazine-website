<!DOCTYPE html>
<html>


<?php include 'head.php';?>
    <div>
        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8 col-lg-9" style="font-size: 18px;">
                <?php 
                include '../conns/mll/conn/conn.php';

echo '<div class= "row m-auto" >';
                $ad= "SELECT * FROM `adverts` ORDER BY `id` DESC LIMIT 4";
                $read= $conn->query($ad);
                while ($road= mysqli_fetch_assoc($read)){
                    if((int)$road['id'] !== 1 && $road['status'] == 'active'){
                        echo'<div class="card m-auto" style="width: 200px; border: none;">
                            <a href="https://' . $road['a_link'] . '" target="blank"><img class="card-img d-block w-100 h-100" src="' . $road['a_pic'] . '" height="400px" style="box-shadow: 0px 0px;"></a>
                    </div>';
                    }
                }
                echo '</div>';
                
                    if(isset($aid)) {
                    echo '<div class="intro">
                        <h2 class="text-center text-body">' . $title . '</h2>
                        <p class="text-center" style="font-family: Almendra, serif;"><span class="by">published by</span> <a class="anchor" href="list.php?aut=' . $author . '">' . $author . '</a><span class="date"> | ' . $timestamp . ' </span><span class="date">| <a class="anchor" href="list.php?cat=' . $cat_id . '">' . $category . '</a> | </span></p><img class="img-fluid" src="' . $a_pic . '" width= 100%
                            style="margin-bottom: 40px;"></div>';
                    
echo '<div class= "row">';
                    $ad= "SELECT * FROM `adverts` ORDER BY `id` ASC LIMIT 4";
                    $read= $conn->query($ad);
                    while ($road= mysqli_fetch_assoc($read)){
                        if((int)$road['id'] !== 1 && $road['status'] == 'active'){
                            echo'<div class="card m-auto" style= "width: 200px; border: none;">
                            <a href="https://' . $road['a_link'] . '" target="blank"><img class="card-img d-block w-100 h-100" src="' . $road['a_pic'] . '" height="400px" style="box-shadow: 0px 0px;"></a>
                    </div>';
                        }
                    }
                    echo '</div>';

                    echo '<div style= "margin-bottom: 150px;"><div class="text sun-editor-editable">' . $article . '</div></div>';
                    /* echo '<div class= "pagi">
                            <a class="btn text-white pagiprev" role="button" href="article.php?aid=' . ($aid - 1) . '" disable>prev</a>
                            <a class="btn text-white paginext" role="button" href="article.php?aid=' . ($aid + 1) . ' ">next</a>
                            </div>'; */
                }
                
                ?>
                <div>
                        <div class="fb-comments" data-href="http://localhost/mll/article.php?aid=<?php echo $aid;?>&title=<?php echo $atitle;?>" data-width="" data-numposts="10"></div>
                </div>
                    <br><br><br>
                    
                    
                    <div class="shadow" style="margin-top: 30px;margin-bottom: 50px;">
                        <h3 class="text-center d-md-flex justify-content-md-center" style="color: inherit;font-family: Lora, serif;font-size: 15px;">RECENT ARTICLES FROM SAME CATEGORY</h3>
                        <div class="card-group">
                        <?php 
                            $query = "SELECT * FROM `a_index` WHERE `cat_id` = $cat_id ORDER BY `id` DESC LIMIT 4";
                            $re= $conn->query($query);
                            while($ro= mysqli_fetch_assoc($re)){
                                $img= $ro['title_pic'];
                                $tit= $ro['title'];
                                $idd= $ro['id'];
                                echo '<div class="card"><img class="card-img-top w-100 d-block" src="' . $img . '" width= 100%>
                                <a class= "anchor" href="article.php?aid=' . $idd . '&tit=' . $tit . '"><div class="card-body">
                                    <h4 class="text-center card-title">' . substr($tit, 0, 20). '... </h4>
                                </div></a>
                            </div>';
                            }
                        
                        ?>
                        </div>
                    </div>
                    
                    
                </div>
                
                
                <div class="col-md-4 col-lg-3 offset-xl-0" style="background-color: #000000;padding: 0;">
                    <?php include 'side_ad.php';?>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-clean"></div>
    
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