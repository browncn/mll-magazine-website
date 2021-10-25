<!DOCTYPE html>
<html>
<?php


if(isset($_GET['scat'])){
    $scat= $_GET['scat'];
}else{
    $scat=1;
}
if(isset($_GET['saut'])){
    $saut= $_GET['saut'];
}else{
    $saut=1;
}
if(isset($_GET['search'])){
    $saut= $_GET['search'];
}else{
    $ssearch=1;
}
if(isset($_GET['salist'])){
    $salist= $_GET['salist'];
}else{
    $salist=1;
}


include 'head.php';?>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                <?php 
                $range= 20;
                if(isset($_GET['search'])){
                    $search= $_GET['search'];
                    if(isset($_GET['prev'])){
                        $offset= $_GET['prev'];
                        $lq= "SELECT * FROM `a_index` WHERE `title` LIKE '%$search%' AND `id` >= $offset ORDER BY `id` ASC LIMIT $range";
                    }elseif(isset($_GET['next'])){
                        $offset= $_GET['next'];
                        $lq= "SELECT * FROM `a_index` WHERE `title` LIKE '%$search%' AND `id` <= $offset ORDER BY `id` DESC LIMIT $range";
                    }else{
                        $lq= "SELECT * FROM `a_index` WHERE `title` LIKE '%$search%' ORDER BY `id` DESC LIMIT $range";
                    }
                    
                    $recat= $conn->query($lq);
                    $first= 0;
                    echo '<form style="margin-top:20px;" action="list.php" method="get">
                                    <input name="search" type= "text" paceholder="search article in category">
                                    <input type="submit" name="submit" value= "search"></form><h2>search result for "' . $search . '"</h2>';
                    echo '<header style="margin-top: 30px;margin-bottom: 10px;"><span class="text-uppercase" style="font-family: IM Fell Great Primer SC, serif;">search:</span>
                    </header>
                    
                    <div>';
                    $first++;
                           $ssearch= (int)$rocat['id'];
                    while($rocat= mysqli_fetch_assoc($recat)){
                        $ltitle= str_replace(' ', '-', $rocat['title']);
                        if($first== 0){
                           
                        }else{
                            $date= date('l, jS  F, Y', strtotime($rocat['timestamp']));
                            
                            echo '<div class="row alist">
                            <div class="col-md-3 offset-md-0">
                                <div class="d-md-flex align-items-md-center" style="width: 100%;"><img src="' . $rocat['title_pic'] . '" width="100%"></div>
                            </div>
                            <div class="col">
                                <div style="width: 70%;">
                                    <h4><a href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '" style="color: inherit;">' . $rocat['title'] . '</a></h4>
                                    <p style="font-family: Almendra, serif;margin-bottom: 0px;">by ' . strtoupper($rocat['author']) . ' | ' . $date . ' | ' . $rocat['category'] . '</p>
                                </div>
                            </div>
                        </div>';
                            $ssearch= (int)$rocat['id'];
                        }
                    }
                    echo '<div class= "pagi">
                            <a class="btn text-white pagiprev" role="button" href="list.php?prev=' . ($ssearch) . '&search=' . $search . '">prev</a>
                            <a class="btn text-white paginext" role="button" href="list.php?next=' . ($ssearch) . '&search=' . $search . '">next</a>
                            </div>';
                }
                if(isset($_GET['cat'])){
                    $cat = $_GET['cat'];
                    if(isset($_GET['prev'])){
                        $offset= $_GET['prev'];
                        $lq= "SELECT * FROM `a_index` WHERE `cat_id` = $cat AND `id` >= $offset ORDER BY `id` ASC LIMIT $range";
                    }elseif(isset($_GET['next'])){
                        $offset= $_GET['next'];
                        $lq= "SELECT * FROM `a_index` WHERE `cat_id` = $cat AND `id` <= $offset ORDER BY `id` DESC LIMIT $range";
                    }else{
                        $lq= "SELECT * FROM `a_index` WHERE `cat_id` = $cat ORDER BY `id` DESC LIMIT $range";
                    }
                    
                    $recat= $conn->query($lq);
                    $first=0;
                    while($rocat= mysqli_fetch_assoc($recat)){
                    $ltitle= str_replace(' ', '-', $rocat['title']);
                        if($first== 0){
                            echo '<form style="margin-top:20px;" action="list.php" method="get">
                                    <input name="search" type= "text" paceholder="search article in category">
                                    <input type="submit" name="submit" value= "search"></form>';
                            echo '<header style="margin-top: 30px;margin-bottom: 10px;"><span class="text-uppercase" style="font-family: IM Fell Great Primer SC, serif;">category:</span>
                        <h1 style="color: #363739;font-family: IM Fell Great Primer SC, serif;">' . $rocat['category'] . '</h1>
                    </header>
                    <div class="card"><a href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '"><img src="' . $rocat['title_pic'] . '" width= 100%></a>
                        <div class="card-body">
                            <a class="card-link" href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '" style="color: inherit;">
                                <h4>' . $rocat['title'] . '</h4>
                            </a>
                            <p class="card-text"></p>
                        </div>
                    </div>
                    <div>';
                            $first++;
                            $scat= (int)$rocat['id'];
                        }else{
                            $date= date('l, jS  F, Y', strtotime($rocat['timestamp']));
                            
                            echo '<div class="row alist">
                            <div class="col-md-3 offset-md-0">
                                <div class="d-md-flex align-items-md-center" style="width: 100%;"><img src="' . $rocat['title_pic'] . '" width="100%"></div>
                            </div>
                            <div class="col">
                                <div style="width: 70%;">
                                    <h4><a href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '" style="color: inherit;">' . $rocat['title'] . '</a></h4>
                                    <p style="font-family: Almendra, serif;margin-bottom: 0px;">by ' . strtoupper($rocat['author']) . ' | ' . $date . ' | ' . $rocat['category'] . '</p>
                                </div>
                            </div>
                        </div>';
                            $scat= (int)$rocat['id'];
                        }
                    }
                    echo '<div class= "pagi">
                            <a class="btn text-white pagiprev" role="button" href="list.php?prev=' . ($scat) . '&cat=' . $cat . '" >prev</a>
                            <a class="btn text-white paginext" role="button" href="list.php?next=' . ($scat + 1) . '&cat=' . $cat . '">next</a>
                            </div>';
                }
                if(isset($_GET['aut'])){
                    $aut = $_GET['aut'];
                    if(isset($_GET['prev'])){
                        $offset= $_GET['prev'];
                        $lq= "SELECT * FROM `a_index` WHERE `author` = '$aut' AND `id` >= $offset ORDER BY `id` ASC LIMIT $range";
                    }elseif(isset($_GET['next'])){
                        $offset= $_GET['next'];
                        $lq= "SELECT * FROM `a_index` WHERE `author` = '$aut' AND `id` <= $offset ORDER BY `id` DESC LIMIT $range";
                    }else{
                        $lq= "SELECT * FROM `a_index` WHERE `author` = '$aut' ORDER BY `id` DESC LIMIT $range";
                    }
                    
                    $recat= $conn->query($lq);
                    $first=0;
                    while($rocat= mysqli_fetch_assoc($recat)){
                        $ltitle= str_replace(' ', '-', $rocat['title']);
                        if($first== 0){
                            echo '<form style="margin-top:20px;" action="list.php" method="get">
                                    <input name="search" type= "text" paceholder="search article in category">
                                    <input type="submit" name="submit" value= "search"></form>';
                            echo '<header style="margin-top: 30px;margin-bottom: 10px;"><span class="text-uppercase" style="font-family: IM Fell Great Primer SC, serif;">publisher:</span>
                        <h1 style="color: #363739;font-family: IM Fell Great Primer SC, serif;">' . $aut . '</h1>
                    </header>
                    <div class="card"><a href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '"><img src="' . $rocat['title_pic'] . '" width= 100%></a>
                        <div class="card-body">
                            <a class="card-link" href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '" style="color: inherit;">
                                <h4>' . $rocat['title'] . '</h4>
                            </a>
                            <p class="card-text"></p>
                        </div>
                    </div>
                    <div>';
                            $first++;
                            $saut= (int)$rocat['id'];
                        }else{
                            $date= date('l, jS  F, Y', strtotime($rocat['timestamp']));
                            
                            echo '<div class="row alist" >
                            <div class="col-md-3 offset-md-0">
                                <div class="d-md-flex align-items-md-center" style="width: 100%;"><img src="' . $rocat['title_pic'] . '" width="100%"></div>
                            </div>
                            <div class="col">
                                <div style="width: 70%;">
                                    <h4><a href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '" style="color: inherit;">' . $rocat['title'] . '</a></h4>
                                    <p style="font-family: Almendra, serif;margin-bottom: 0px;">by ' . strtoupper($rocat['author']) . ' | ' . $date . ' | ' . $rocat['category'] . '</p>
                                </div>
                            </div>
                        </div>';
                            $saut= (int)$rocat['id'];
                        }
                    }
                    echo '<div class= "pagi">
                            <a class="btn text-white pagiprev" role="button" href="list.php?saut=' . ($saut) . '&aut=' . $aut . '" >prev</a>
                            <a class="btn text-white paginext" role="button" href="list.php?saut=' . ($saut + 1) . '&aut=' . $aut . '">next</a>
                            </div>';
                }
                if(!isset($_GET['search']) && !isset($_GET['cat']) && !isset($_GET['aut'])){
                    $_GET['alist']= 1;
                    if(isset($_GET['alist'])){
                        $alist = $_GET['alist'];
                        if(isset($_GET['prev'])){
                            $offset= $_GET['prev'];
                            $lq= "SELECT * FROM `a_index` WHERE `id` >= $offset ORDER BY `id` ASC LIMIT $range";
                        }elseif(isset($_GET['next'])){
                            $offset= $_GET['next'];
                            $lq= "SELECT * FROM `a_index` WHERE `id` <= $offset ORDER BY `id` DESC LIMIT $range";  
                        }else{
                            $lq= "SELECT * FROM `a_index` ORDER BY `id` DESC LIMIT $range";      
                        }
                        
                        $recat= $conn->query($lq);
                        $first=0;
                        while($rocat= mysqli_fetch_assoc($recat)){
                        $ltitle= str_replace(' ', '-', $rocat['title']);
                            if($first== 0){
                                echo '<form style="margin-top:20px;" action="list.php" method="get">
                                    <input name="search" type= "text" paceholder="search article in category">
                                    <input type="submit" name="submit" value= "search"></form>';
                                echo '<header style="margin-top: 30px;margin-bottom: 10px;"><span class="text-uppercase" style="font-family: IM Fell Great Primer SC, serif;">category:</span>
                        <h1 style="color: #363739;font-family: IM Fell Great Primer SC, serif;">Articles</h1>
                    </header>
                    <div class="card"><a href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '"><img src="' . $rocat['title_pic'] . '" width= 100%></a>
                        <div class="card-body">
                            <a class="card-link" href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '" style="color: inherit;">
                                <h4>' . $rocat['title'] . '</h4>
                            </a>
                            <p class="card-text"></p>
                        </div>
                    </div>
                    <div>';
                                $first++;
                                $salist= (int)$rocat['id'];
                            }else{
                                $date= date('l, jS  F, Y', strtotime($rocat['timestamp']));
                                
                                echo '<div class="row alist">
                            <div class="col-md-3 offset-md-0">
                                <div class="d-md-flex align-items-md-center" style="width: 100%;"><img src="' . $rocat['title_pic'] . '" width="100%"></div>
                            </div>
                            <div class="col">
                                <div style="width: 70%;">
                                    <h4><a href="article.php?aid=' . $rocat['id'] . '&atitle=' . $ltitle . '" style="color: inherit;">' . $rocat['title'] . '</a></h4>
                                    <p style="font-family: Almendra, serif;margin-bottom: 0px;">by ' . strtoupper($rocat['author']) . ' | ' . $date . ' | ' . $rocat['category'] . '</p>
                                </div>
                            </div>
                        </div>';
                                $salist= (int)$rocat['id'];
                            }
                        }
                        echo '<div class= "pagi">
                            <a class="btn text-white pagiprev" role="button" href="list.php?prev=' . ($salist) . '&alist=' . $alist . '" >prev</a>
                            <a class="btn text-white paginext" role="button" href="list.php?next=' . ($salist + 1) . '&alist=' . $alist . '">next</a>
                            </div>';
                    }
                }
                
                    
                    ?>

                    </div>
                </div>
                <div class="col-md-4" style="background-color: #000000;padding: 0;">
                    <?php include 'side_ad.php';?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'?>
    <script src="assets/js/jquery.min.js?h=89312d34339dcd686309fe284b3f226f"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=0168f7c1e0d08faa2f4b13f4a1dc8c98"></script>
    <script src="assets/js/bs-init.js?h=a24a748d1ebf2b30dec97d2c79b26872"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script src="assets/js/sidebar-with-button.js?h=1b8952d8cba47110081772478660f37b"></script>
    <script src= "js2/index2.js"></script>
</body>

</html>