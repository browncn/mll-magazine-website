    <?php 
    include '../conns/mll/conn/conn.php';
    
    $query = "SELECT * FROM `contact`";
    
    $res = $conn->query($query);
    $ro= mysqli_fetch_assoc($res);
    
    $addr= $ro['addr'];
    $state= $ro['state'];
    $city= $ro['city'];
    $country= $ro['country'];
    $tel= $ro['tel'];
    $email= $ro['email'];
    
    ?>
    <div class="footer-dark" style="margin-top : 100px;">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 item">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="catalogue.php">Our Catalogue</a></li>
                            <li><a href="#">Real Estate</a></li>
                            <li><a href="#">Law Doctor</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="terms.php">Terms and Conditions</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 text-center item text">
                        <h3><strong>Dream D' Diamonds Concept</strong></h3>
                        <p> <?php echo $addr . ', ' . $city . ', ' . $state . ', ' . $country . '.';?><a href="tel:<?php echo $tel;?>"><br><?php echo $tel;?><br></a><a href="mailto:<?php echo $email;?>"><br><?php echo $email;?><br><br></a>&nbsp;</p>
                    </div>
                    <div class="col item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
                </div>
                <p class="copyright">Dream D' Diamonds Concept © 2020</p>
            </div>
        </footer>
        		<!-- The Modal -->
			<div id="myModal" class="modal">
			  <!-- Modal content -->			
				<div class="modal-content">
				  <div class="modal-header" id = "modal-header">
				    <h2>Information!</h2>
				    <span class="close" id = 'cancel'> &times; </span>
				  </div>
				  <div class="modal-body" id = "modal-body">
				  </div>
				  <div class="modal-footer" id="modal-footer">
				  </div>
				</div>
			</div>
    </div>


<?php


?>