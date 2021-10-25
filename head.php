<head>
<?php
//session.cookie_samesite="None" ;
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id= 278725474"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SM5MRB781D');
</script>
<script data-ad-client="ca-pub-3397222912594486" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</script>
<?php

include '../conns/mll/conn/conn.php'; session_start();

$cur= basename($_SERVER['PHP_SELF']);

if($cur=='article.php'){
echo "<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=60618d279269c20011a2a1b7&product=sticky-share-buttons' async='async'></script>";

 
$mtitle= "My Legal Lifestyle (MLL) is your best source for legal information and advice in Nigeria." ;

if(isset($_GET['aid'])){
                    $aid= $_GET['aid'];
                    
                    $query = "SELECT * FROM `a_index` WHERE `id`= $aid";
                    $re= $conn->query($query);
                    $ro = mysqli_fetch_assoc($re);
                    $title = $ro['title'];
                    $atitle = $ro['title'];
                    $ltitle= str_replace(' ', '-', $atitle);
                    $tag_title= str_replace(' ', ', ', $atitle);
                    $a_pic= $ro['title_pic'];
                    $timestamp= $ro['timestamp'];
                    $timestamp= date('l, jS  F, Y', strtotime($timestamp));
                    $color= $ro['color'];
                    $author= $ro['author'];
                    $cat_id= $ro['cat_id'];
                    $category= $ro['category'];
                    $article= $ro['article'];
                    $pre= $ro['a_pre'];
                 
                    echo "<title>MLL Magazine | " . $title . "</title>" ;
                    
} 
} else{
echo "<title>MLL Magazine</title>" ;
$mtitle= "My Legal Lifestyle (MLL) is your best source for legal information and advice in Nigeria." ;
$pre= $mtitle;
$tag_title= str_replace(' ', ', ', $mtitle);
} 
?>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <meta name="description" content=" <?php echo $pre;?>">
    <meta name="keywords" content=" <?php echo $tag_title;?>">
    <meta name="theme-color" content="#b3a84b">
    <meta property="og:image" content="assets/img/MLL2.png">
    <link rel="icon" type="image/png" sizes="517x292" href="assets/img/MLL2.png">
    <link rel="icon" type="image/png" sizes="517x292" href="assets/img/MLL2.png">
    <link rel="icon" type="image/png" sizes="517x292" href="assets/img/MLL2.png">
    <link rel="icon" type="image/png" sizes="517x292" href="assets/img/MLL2.png">
    <link rel="icon" type="image/png" sizes="517x292" href="assets/img/MLL2.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aguafina+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Almendra">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amita">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bad+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Berkshire+Swash">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bilbo+Swash+Caps">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IM+Fell+Great+Primer+SC">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Modern+Antiqua">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Article-Clean.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Bold-BS4-CSS-Image-Slider.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/Lightbox-Gallery.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Newsletter-Subscription-Form.css">
    <link rel="stylesheet" href="assets/css/Parallax-Scroll-Effect.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/sidebar-with-button.css">
    <link rel="stylesheet" href="assets/css/Social-Icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
    <link href="css2/css.css" rel="stylesheet">
    <link href="suneditor/css/suneditor.min.css" rel="stylesheet">
    
<style>
    .im {
	width: 100%;
	height: 100%;
}
.loader_bg{
	position: fixed;
	z-index: 999999;
	background: white;
	width: 100%;
	height: 100%;
	
	
}
.loader{
	width: 300px;
	height: 150px;
	background: white;
	margin-top:calc(50vh - 75px);
	margin-left:calc(50vw - 150px);
	border: 0 solid transparent;
	background: url("mll.png") center;
	background-size: cover;
}
.loader:before, .loader:after{
	content: '';
	border: 5px solid yellow;
	border-radius: 5px;
	width: inherit;
	height: inherit;
	position: absolute;
	animation: loader 2s linear infinite;
	opacity: 0;
}
.loader:before{
	animation-delay: .5s;
}
@keyframes loader {
0%{
		transform: scale(0.7);
		opacity: 0;
	}
50%{
		opacity: 1;
		border-radius: 3px;
	}
100%{
		transform: scale(1);
		opacity: 0;
		border: 20px solid white;		
	}
}

</style>
<script src="assets/js/jquery.min.js"></script>

</head>

<body>

<div class="loader_bg">
	<div class= "loader">
	</div>
</div>
<script>
		setTimeout(function(){
			$('.loader_bg').fadeToggle();
		}, 3500);
    </script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="DVD0Zlee"></script>
    <div class="text-lowercase">
        <div class="container">
            <div class="row">
                <div class="col-md-1" style="min-width: 100px;">
                    <div style="margin-top: 20px;"><button class="open_button" onclick="openNav()"><span></span><span></span><span></span></button>
                        <div class="text-lowercase sidenav ultima_z-index" id="mySidenav" style="font-family: 'IM Fell Great Primer SC', serif;font-size: 12px;">
                        <a class="closebtn" href="javascript:void(0)" onclick="closeNav()">×</a>
                        <a href="legal.php?l=about">About Us</a>
                        <a href="legal.php?l=agreement">Submission Agreement</a>
                        <a href="catalogue.php">Catalogue</a>
                        <a href="legal.php?l=terms">Terms &amp; Conditions</a>
                        <a href="contact.php">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-8 offset-md-0 ml-auto" id= "login" style="overflow: hidden; margin-top:20px !important;">
                
                </div>
                
            </div>
        </div>
    </div>
    <nav class="navbar navbar-light navbar-expand-md sticky-top text-lowercase navigation-clean" style="height: 100px;border-bottom-style: solid;border-bottom-color: #957e03;font-family: 'IM Fell Great Primer SC', serif;">
        <div class="container"><a class="navbar-brand" href="index.php" style="font-family: 'IM Fell Great Primer SC', serif;font-style: normal;font-size: 55px;background: url(&quot;assets/img/MLL2.png?h=5fc1621f1fe37057f68c0fc43dc9ce70&quot;) center / contain no-repeat;height: 100px;width: 200px;"></a>
            <button
                data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto"  style="background:white!important;">
                    <li class="nav-item"><a class="nav-link"href="index.php">HOME</a></li>
                    <?php 
                        $query= "SELECT * FROM `categories` ORDER BY `cat_order` ASC";
                        $re= $conn->query($query);
                        $limit= 6;
                        $top = 0;
                        $bottom = 0;
                        
                        while($ro = mysqli_fetch_assoc($re)){
                            if(isset($_GET['page']) && $_GET['page'] == $ro['category']){
                                $active= 'active';
                            }else{
                                $active= '';
                            }
                            if($limit!==0){
                                echo'<li class="nav-item"><a class="nav-link ' . $active . '" href="list.php?cat=' . $ro['id'] . '&page=' . $ro['category'] . '">' . strtoupper($ro['category']) . '</a></li>';
                                $limit--;
                            }
                            
                            if($top !== 0){
                                echo '<a class="dropdown-item ' . $active . '" href="list.php?cat=' . $ro['id'] . '&page=' . $ro['category'] . '">' . strtoupper($ro['category']) . '</a>';
                            }
                            if($limit== 0 && $top== 0){
                                echo '<li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">More</a><div class="dropdown-menu">';
                                $top++;
                            }
                            
                        }
                        echo '</div></li>';
                        $query= "SELECT * FROM `categories` ORDER BY `cat_order` DESC LIMIT 1";
                        $re= $conn->query($query);
                        $ro = mysqli_fetch_assoc($re);
                        echo'<li class="nav-item"><a class="nav-link" href="list.php?cat=' . $ro['id'] . '">' . strtoupper($ro['category']) . '</a></li>';
                    ?>
                        
                    </ul>
                </div>
        </div>
    </nav>
   