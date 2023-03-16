<?php 
    include './control/conn.php';
   
   $products = array_keys($_SESSION['cart']);
   $subIds = $_SESSION['cartSub'][0];
   $quantities = $_SESSION['qty'];
   $rSubId = $subIds[0]['id'];

   // GET RIDER ID 
       $rIdQuery = mysqli_query($conn, "SELECT * FROM `rider` WHERE subaccount_id='$rSubId'");
       if (!$rIdQuery) {
           die("FAILED ".mysqli_error($rIdQuery));
       }
       $riderId = mysqli_fetch_assoc($rIdQuery)['id'];
   $i = 0;
   $userid = $_SESSION['juId'];
   $tId = $_SESSION['transaction_id'];
   while ($i <  count($products)) {
       $iForMerchant = $i+1;
       $iId = ($subIds[$iForMerchant]['id']);
       // GET THE MERCHANT ID FROM DB 
       $meQuery = mysqli_query($conn, "SELECT * FROM `profile` WHERE subaccount_id='$iId'");
       if (!$meQuery) {
           die("FAILED ".mysqli_error($meQuery));
       }
       $mId = mysqli_fetch_assoc($meQuery)['id'];
       
       $tCharge = $subIds[$i]['transaction_charge'];
       $pId = $products[$i];
       $qty = $quantities[$i];
     
       // SEND VALUE TO TRANSACTION 
       $sSql = "INSERT INTO transaction(user_id, merchant_id, product_id, qty, rider_id, trasaction_id, `date`) VALUES ($userid, $mId, $pId, $qty, $riderId, '$tId', NOW())";
           $sQuery = mysqli_query($conn, $sSql);
           if (!$sQuery) {
           die("FAILED TO UPDATE TRANSACTION STATUS ".mysqli_error($conn));
           }
       
       $i++;
   }
   unset($_SESSION['cart']);
   unset( $_SESSION['cartSub']);
   unset($_SESSION['qty']);
   header('Location ./dashboard/?p=purchase');