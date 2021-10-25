<div class="card" style="width: 100%;">
                        <h4 class="text-center" style="margin-bottom: 0px;background-color: #957e03;color: rgb(248,249,251);padding: 10px;">LATEST ISSUE</h4>
                        <?php 
                        $iss="SELECT * FROM `catalogue` ORDER BY `id` DESC LIMIT 1";
                        $reiss= $conn->query($iss);
                        $roiss=mysqli_fetch_assoc($reiss);                        
                        ?>
                        <img class="card-img w-100 d-block" src="<?php echo $roiss['i_pic'];?>" height="400px" style="box-shadow: 0px 0px;">
                        <div class="card-img-overlay text-light" style="height: 15%;margin-bottom: 0;margin-top: auto;background-color: rgba(255,0,0,0.55);">
                            <h4><a href="mag.php?m=<?php echo $roiss['id'];?>" style="color:inherit;"><?php echo date('F Y', strtotime($roiss['date']));?></a></h4>
                        </div>
                    </div>
                    <?php 
                    $cur= basename($_SERVER['PHP_SELF']);
                    //echo '<p style="color:yellow;">' . $cur . '</p>';
                    if($cur !=='index.php'){
                        $ad= "SELECT * FROM `adverts` ORDER BY `id` DESC";
                        $read= $conn->query($ad);
                        while ($road= mysqli_fetch_assoc($read)){
                            if((int)$road['id'] !== 1 && $road['status'] == 'active'){
                                echo'<div class="card" style="width: 100%;">
                            <a href="https://' . $road['a_link'] . '" target="blank"><img class="card-img w-100 d-block" src="' . $road['a_pic'] . '" height="400px" style="box-shadow: 0px 0px;"></a>
                    </div>';
                            }
                        }
                    }
                    
                    ?>
<!-- <h1 class="d-md-flex align-items-md-center">Adverts of any kind here</h1> -->
