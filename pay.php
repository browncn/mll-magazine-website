<?php
session_start();

if(isset($_POST['pay'])){
    if(isset($_SESSION['sid']) && isset($_SESSION['amount']) && isset($_SESSION['email'])){
        $email= $_SESSION['email'];
        $amount= $_SESSION['amount'];
        $sid= $_SESSION['sid'];
        echo '<form name= "checkout" method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">
  <input type="hidden" name="public_key" value="FLWPUBK_TEST-d98954e819cccf36eb1be3d647f9b53b-X" />
  <input type="hidden" name="customer[email]" value="' . $email , '" />
  <input type="hidden" name="customer[name]" value="kenji" />
  <input type="hidden" name="tx_ref" value="' . time() . '" />
  <input type="hidden" name="amount" value="' . $amount . '" />
  <input type="hidden" name="currency" value="NGN" />
  <input type="hidden" name="payment_options" value="card" />
  <input type="hidden" name="meta[token]" value="54" />
  <input type="hidden" name="redirect_url" value="https://mylegallifestyle.com/pay.php" />
    </form>';
        
        echo '<script>document.forms["checkout"].submit()</script>';
    }
}


if(isset($_GET['status']) && isset($_GET['tx_ref']) && isset($_GET['transaction_id'])) {
    if($_GET['status']!=='' && $_GET['tx_ref']!=='' && $_GET['transaction_id']!=='') {
        
        echo '<form name= "verify" method="POST" action= "https://mylegallifestyle.com/sub.php">
  <input type="hidden" name="done" value="' . $_GET['status'] . '" />
    </form>';
        
        echo '<script>document.forms["verify"].submit()</script>';
    }
}