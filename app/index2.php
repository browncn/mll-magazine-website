<?phpheader('Access-Control-Allow-Origin: http://localhost');header('Access-Control-Allow-Credentials: true');header('Access-Control-Allow-Methods: GET, POST, PUT');header('Access-Control-Allow-Headers: Content-Type');echo 'hello world!!! cross was successful. yay!!!!!!!!!!!!!<br>Here comes the new challenger!!!!';setcookie($name, $value, [    'expires' => time() + 86400,    'path' => '/',    'domain' => 'domain.com',    'secure' => true,    'httponly' => true,    'samesite' => 'None',]);

session_start();

if(isset($_POST['email'])){
    
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    if($email == '' || $pass == ''){
        echo '<b style= color:red;font-size:10px;">login details blank</b>';
    }else{
        include '../../conns/mll/conn/conn.php';
        
        $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$pass'";
        $ret = $conn->query($query);
        if(mysqli_num_rows($ret)==0){
            echo '<form class= "m-auto row">
                    	<div class= "form-group col-md-4"><input id= "email" class= "form-control" name= "email" type= "text" value="" placeholder= "email"></div>
                    	<div class= "form-group col-md-4"><input id= "pass" class= "form-control" name= "pass" type= "password" value="" placeholder= "password"></div>
                    	<div><button id= "signin" class= "btn btn-primary" style="background: #b3a84b; border-color:#b3a84b;" onclick="return false">sign in</button></div>
                        <div><a class="btn" role="button" href="reg.php" target="_parent" style="background: #c8ced7;color: rgba(139,122,12,0.9);margin-right: 5px;">register</a></div>
                        <div><a class="btn" role="button" href="contact.php" style="margin: auto;background: white;color: rgba(139,122,12,0.9);">forgot password</a></div>
                    	<!-- <div style="margin-right:20px;"><span class= "mr-auto" style= "font-size:12px; margin-left: 20px;"><input id= "rem" class="" type= "checkbox"> remember me</span></div> -->
                    	<div id="error" style= "color:red; font-weight:bold;">invalid credentials</div>
                    </form>';
        }else{
            $rot = mysqli_fetch_assoc($ret);
            $dept = $rot['dept'];
            $fname = $rot['fname'];
            $id= $rot['id'];
            if($dept == 'reader'){
                $_SESSION['email']= $email;
                $_SESSION['dept']= $dept;
                $_SESSION['id']= $id;
            }
            if($dept == 'admin'){
                $_SESSION['email']= $email;
                $_SESSION['dept']= $dept;
                $_SESSION['id']= $id;
            }
        }
        
        if(isset($_SESSION['email']) && isset($_SESSION['dept'])){
            $email = $_SESSION['email'];
            $dept= $_SESSION['dept'];
            
            if($dept == 'reader'){
                $accept= '<div id = "access"><b>' . $email . '</b><a  href="user.php" target= "_parent">my profile</a><a  href="signout.php" target= "_parent">sign out</a></div>';
                echo '<script>localStorage.accept=' . $accept . '</script>';
                echo $accept;
            }
            if($dept == 'admin'){
                $accept = '<div id = "access"><b>' . $email . '</b><a  href="editor.html" target= "_parent">admin</a><a  href="user.php" target= "_parent">my profile</a><a  href="signout.php" target= "_parent">sign out</a></div>';
                echo '<script>alert("cdcdf")</script>';
                echo $accept;
            }

        }

        
    }
}elseif(isset($_SESSION['email']) && isset($_SESSION['dept'])){
    $email = $_SESSION['email'];
    $dept= $_SESSION['dept'];
    
    if($dept == 'reader'){
        $accept= '<div id = "access"><b>' . $email . '</b><a  href="user.php" target= "_parent">my profile</a><a  href="signout.php" target= "_parent">sign out</a></div>';
        echo '<script>localStorage.accept=' . $accept . '</script>';
        echo $accept;
    }
    if($dept == 'admin'){
        $accept = '<div id = "access"><b>' . $email . '</b><a  href="editor.html" target= "_parent">admin</a><a  href="user.php" target= "_parent">my profile</a><a  href="signout.php" target= "_parent">sign out</a></div>';
        echo '<script>alert("cdcdf")</script>';
        echo $accept;
    }
    
}else{
    echo '<form class= "m-auto row">
                    	<div class= "form-group col-md-4"><input id= "email" class= "form-control" name= "email" type= "text" value="" placeholder= "email"></div>
                    	<div class= "form-group col-md-4"><input id= "pass" class= "form-control" name= "pass" type= "password" value="" placeholder= "password"></div>
                    	<div><button id= "signin" class= "btn btn-primary" style="background: #b3a84b; border-color:#b3a84b;" onclick="return false">sign in</button></div>
                        <div><a class="btn" role="button" href="reg.php" target="_parent" style="background: #c8ced7;color: rgba(139,122,12,0.9);margin-right: 5px;">register</a></div>
                        <div><a class="btn" role="button" href="contact.php" style="margin: auto;background: white;color: rgba(139,122,12,0.9);">forgot password</a></div>
                    	<!-- <div style="margin-right:20px;"><span class= "mr-auto" style= "font-size:12px; margin-left: 20px;"><input id= "rem" class="" type= "checkbox"> remember me</span></div> -->
                    	<div id="error" style= "color:red; font-weight:bold;"></div>
                    </form>';
}




if(isset($_POST['navi'])){
    if($_POST['navi'] == 'navi'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
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
        
    }
}


if(isset($_POST['caru'])){
    if($_POST['caru'] == 'caru'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
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
    }
}


if(isset($_POST['justin'])){
    if($_POST['justin'] == 'justin'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
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
        echo '<div id= "sidemag" class="col-md-4 col-lg-3 offset-xl-0" style="background-color: #000000;padding: 0;">';
    }
}


if(isset($_POST['sidemag'])){
    if($_POST['sidemag'] == 'sidemag'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
        // for side mag
        echo '
                <div class="card" style="width: 100%;">
                      <h4 class="text-center" style="margin-bottom: 0px;background-color: #957e03;color: rgb(248,249,251);padding: 10px;">LATEST ISSUE</h4>';
        
        $iss="SELECT * FROM `catalogue` ORDER BY `id` DESC LIMIT 1";
        $reiss= $conn->query($iss);
        $roiss=mysqli_fetch_assoc($reiss);
        echo '<img class="card-img w-100 d-block" src="' . $roiss['i_pic'] . '" height="400px" style="box-shadow: 0px 0px;">
                        <div class="card-img-overlay text-light" style="height: 15%;margin-bottom: 0;margin-top: auto;background-color: rgba(255,0,0,0.55);">
                            <h4><a href="mag.php?m=' . $roiss['id'] . '" style="color:inherit; display:block;">' . date('F Y', strtotime($roiss['date'])) . '</a></h4>
                        </div>';
        echo '</div></div>';
    }
}


if(isset($_POST['sidead'])){
    if($_POST['sidead'] == 'sidead'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
        $cur= basename($_SERVER['PHP_SELF']);
        //echo '<p style="color:yellow;">' . $cur . '</p>';
        if($cur !=='index.php'){
            echo $cur;
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
    }
}


if(isset($_POST['midad'])){
    if($_POST['midad'] == 'midad'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
        $first= "SELECT * FROM `adverts` ORDER BY `id` ASC LIMIT 1";
        $refirst= $conn->query($first);
        $rofirst= mysqli_fetch_assoc($refirst);
        if($rofirst['status'] == 'active'){
            echo'<div style="width : 100%; height : 100%;">
	<a href="https://' . $rofirst['a_link'] . '" target="blank"><img src= "' . $rofirst['a_pic'] . '" width=100% height= 100%></a>
           </div>';
        }
    }
}


if(isset($_POST['topcat'])){
    if($_POST['topcat'] == 'topcat'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
        $top = "SELECT * FROM `catalogue` ORDER BY `r_count` DESC LIMIT 3";
        $retop=$conn->query($top);
        while($rotop=mysqli_fetch_assoc($retop)){
            echo '<div class="col-sm-6 col-md-4 col-lg-3 item" data-bs-hover-animate="pulse"><a href="mag.php?m=' . $rotop['id'] . '"><img class="img-fluid" src="' . $rotop['i_pic'] . '"></a></div>';
        }
    }
}


if(isset($_POST['catlist'])){
    if($_POST['catlist'] == 'catlist'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
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
                echo '<li class="index_list" style="margin-bottom: 5px; border-bottom: 1px solid rgba(0,0,0,.125);"><b><a style=" color: inherit;" href=article.php?aid=' . $aid . '>' . substr($title, 0, 50) . '...' . '</a></b></li>';
            }
            echo '</ul><a class="btn" role="button" style="background-color: rgb(179,168,75);color: white; font-size: 12px;" href=list.php?cat=' . $catid . '>more from this section</a>';
            echo '</div></div></div>';
        }
    }
}


if(isset($_POST['mllissue'])){
    if($_POST['mllissue'] == 'mllissue'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
        $ilatest = "SELECT * FROM `catalogue` ORDER BY `id` DESC LIMIT 5";
        $reilatest=$conn->query($ilatest);
        while($roilatest=mysqli_fetch_assoc($reilatest)){
            echo '<li><a class="image_title" href="mag.php?i=' . $roilatest['id'] . '"></a><a href="mag.php?m=' . $roilatest['id'] . '"><img src="' . $roilatest['i_pic'] . '" width="300px" height="400px"></a></li>';
        }
    }
}


if(isset($_POST['footer'])){
    if($_POST['footer'] == 'footer'){
        include '../../conns/mll/conn/conn.php'; session_start();
        
        $query = "SELECT * FROM `contact`";
        
        $res = $conn->query($query);
        $ro= mysqli_fetch_assoc($res);
        
        $addr= $ro['addr'];
        $state= $ro['state'];
        $city= $ro['city'];
        $country= $ro['country'];
        $tel= $ro['tel'];
        $email= $ro['email'];        
        
        echo $addr . ', ' . $city . ', ' . $state . ', ' . $country . '.<a href="tel:' . $tel . '"><br>' . $tel . '<br></a><a href="mailto:' . $email . '"><br>' . $email . '<br><br></a>&nbsp';
    }
}

?>
