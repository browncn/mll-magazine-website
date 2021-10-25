
<link media = all  rel = stylesheet href="../assets/bootstrap/css/bootstrap.min.css">
<link href="../css2/css.css" rel="stylesheet">


<div class= "" style= "padding:5px;">

<?php 

session_start(); 
if(!isset($_SESSION['dept'])){
    echo '<script>parent.location.replace("../signout.php")</script>';
}else{
    if($_SESSION['dept']!=='admin'){
        echo '<script>parent.location.replace("../signout.php")</script>';
    }
}

include '../../conns/mll/conn/conn.php';
$range= 20;
if(isset($_GET['search'])){
    $search= $_GET['search'];
    if(isset($_GET['prev'])){
        $offset= $_GET['prev'];
        $get= "SELECT * FROM `a_index` WHERE `title` LIKE '%$search%' AND `id` <= $offset ORDER BY `id` DESC LIMIT $range";
    }elseif(isset($_GET['next'])){
        $offset= $_GET['next'];
        $get= "SELECT * FROM `a_index` WHERE `title` LIKE '%$search%' AND `id` >= $offset ORDER BY `id` ASC LIMIT $range";
    }else{
        $get= "SELECT * FROM `a_index` WHERE `title` LIKE '%$search%' ORDER BY `id` DESC LIMIT $range";
    }
    
    $first= 0;
    echo '<form style="margin-top:20px;" action="a_index.php" method="get">
                                    <input name="search" type= "text" paceholder="search article in category">
                                    <input type="submit" name="submit" value= "search"></form><h2>search result for "' . $search . '"</h2>';
    echo '<header style="margin-top: 30px;margin-bottom: 10px;"><span class="text-uppercase" style="font-family: IM Fell Great Primer SC, serif;">search:</span>
                    </header>
                                        
                    <div>';
    
    $first++;
    $re_get = $conn->query($get);
    while($ro_get=mysqli_fetch_assoc($re_get)){
        if($first== 0){
            
        }else{
            $date= date('l, jS  F, Y', strtotime($ro_get['timestamp']));
            
            echo '<div class="row artdiv"><div class="imgdiv" style= "margin:10px;"><img src="' . $ro_get['title_pic'] . '" width=100% height=100px/>
			</div><div class="infodiv">' .
			'<h2><a href= "e_article.php?aid=' . $ro_get['id'] . '" style= "color:' . $ro_get['color'] . ';">' . substr($ro_get['title'], 0, 20) . '...' . '</a></h2>' .
			'<a href= "e_article.php?aid=' . $ro_get['id'] . '">' . $ro_get['id'] . ' - ' . $ro_get['category'] . '</a><br>' .
			'<a href= "e_article.php?aid=' . $ro_get['id'] . '">' . $ro_get['author'] . '</a>on ' . $date . '<br>' .
			'<a href= "a_index.php?adel=' . $ro_get['id'] . '">delete</a></div></div>';
            $ssearch= (int)$ro_get['id']; 
        }
    }
    echo '<div class= "pagi">
                            <a class="btn text-white pagiprev" role="button" href="a_index.php?prev=' . ($ssearch) . '&search=' . $search . '" disable>prev</a>
                            <a class="btn text-white paginext" role="button" href="a_index.php?next=' . ($ssearch) . '&search=' . $search . '">next</a>
                            </div>';
}

if(!isset($_GET['search'])){
    echo '<form style="margin-top:20px;" action="a_index.php" method="get">
                                    <input name="search" type= "text" paceholder="search article in category">
                                    <input type="submit" name="submit" value= "search"></form>';
    
    if(isset($_GET['prev'])){
        $offset= $_GET['prev'];
        $get= "SELECT * FROM `a_index` WHERE `id` <= $offset ORDER BY `id` DESC LIMIT $range";
    }elseif(isset($_GET['next'])){
        $offset= $_GET['next'];
        $get= "SELECT * FROM `a_index` WHERE `id` >= $offset ORDER BY `id` ASC LIMIT $range";
    }else{
        $get= "SELECT * FROM `a_index` ORDER BY `id` DESC LIMIT $range";
    }
    
    
    $re_get = $conn->query($get);
    while($ro_get=mysqli_fetch_assoc($re_get)){
        echo '<div class="row artdiv"><div class="imgdiv" style= "margin:10px;"><img src="' . $ro_get['title_pic'] . '" width=100% height=100px/>
			</div><div class="infodiv">' .
			'<h2><a href= "e_article.php?aid=' . $ro_get['id'] . '" style= "color:' . $ro_get['color'] . ';">' . substr($ro_get['title'], 0, 20) . '...' . '</a></h2>' .
			'<a href= "e_article.php?aid=' . $ro_get['id'] . '">' . $ro_get['id'] . ' - ' . $ro_get['category'] . '</a><br>' .
			'<a href= "e_article.php?aid=' . $ro_get['id'] . '">' . $ro_get['author'] . '</a><br>' .
			'<a href= "a_index.php?adel=' . $ro_get['id'] . '">delete</a></div></div>';
        $ssearch= (int)$ro_get['id']; 
    }
    echo '<div class= "pagi">
                            <a class="btn text-white pagiprev" role="button" href="a_index.php?prev=' . ($ssearch) . '">prev</a>
                            <a class="btn text-white paginext" role="button" href="a_index.php?next=' . ($ssearch) . '">next</a>
                            </div>';
}
    


if(isset($_GET['adel'])){
	$adel = $_GET['adel'];
	$del = "DELETE FROM `a_index` WHERE `id` = $adel";
	$conn->query($del);
	
	echo '<script>location.assign("a_index.php");</script>';
	
}

?>

</div>


<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
