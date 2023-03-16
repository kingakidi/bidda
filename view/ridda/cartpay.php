<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CART PAYMENT VERIFICATION</title>
  <link rel="stylesheet" href="../../bootstrap.css">
  <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="activation-container">
  <div class="">
  <?php 
    include "../../control/conn.php";
    if (!isset($_SESSION['juId'])) {
       header("Location: ../../login.php");
    }
    function clean($data)
    {
        global $conn;
        return mysqli_real_escape_string($conn, $data);
    }
    $_SESSION['qty'] = $_GET['qty'];
    $cart =  array_keys($_SESSION['cart']);
    $qty = $_GET['qty'];
    $fMId = $cart[0];
    $phone = $_SESSION['juPhone'];
    $email = $_SESSION['juEmail'];

    
    $subaccounts = array();
    if (count($qty) > 0) {
        // GET A RANDOM RIDER BASE ON SMALLEST VALUE
            $useridQuery = mysqli_query($conn, "SELECT * FROM product WHERE id=$fMId");
            if (!$useridQuery) {
                die("FAILED TO PRODUCT I ".mysqli_error($conn));
            }

            $totalFees = 0;
            $uId = mysqli_fetch_assoc($useridQuery)['user_id'];
          
            $rSql = "SELECT * FROM merchant_riders JOIN rider on merchant_riders.rider_id = rider.id WHERE merchant_riders.merchant_id=$uId";
            $rQuery = mysqli_query($conn, $rSql);
            $rRow = mysqli_fetch_assoc($rQuery);

         
            if (count($qty) > 1) {
              $dPrice = 3000;
            }else{
              $dPrice = 2000;
            }
        
            $dCPrice = 0.85*$dPrice;
            $rSubaccount = $rRow['subaccount_id'];

            $totalFees += $dPrice;
            $riderDetailArray = array(

                'id' => $rSubaccount, 
                'transaction_charge_type' => "flat_subaccount",
                'transaction_charge' => "$dCPrice" 
            );

            $subaccounts[] = $riderDetailArray;

      
        for ($i=0; $i < count($cart); $i++) { 
            $itemId = clean($cart[$i]);
            $itemQty = clean($qty[$i]);
            $sql = "SELECT * FROM profile JOIN product ON profile.userid = product.user_id WHERE product.id = $itemId";
    
            $query = mysqli_query($conn, $sql);
    
            $row = mysqli_fetch_assoc($query);
            $price = $row['price'];
            $subaccountId = $row['subaccount_id'];
            $totalPrice = ((int)$price)*((int)$itemQty);
            $totalFees += $totalPrice;
            $mPrice = 90*($totalPrice)/100;
            $userid = $row['user_id'];
            
            $pArray = array(
                
                'id' => $subaccountId, 
                'transaction_charge_type' => "flat_subaccount",
                'transaction_charge' => "$mPrice"        
            );
                
                $pJson = $pArray;
           
                $subaccounts[] = $pJson;     
    
        }

    }
   
    $_SESSION['cartSub'] = array($subaccounts);
?>


<form>
  <script src="https://checkout.flutterwave.com/v3.js"></script>
  
  <button class="btn btn-jumga" id="payFees" type="button" onClick="makePayment()">Pay Now </button>
</form>

<script>
   try {
    let arr = <?php echo json_encode($subaccounts); ?>; 
       
       function makePayment() {
         FlutterwaveCheckout({
           public_key: '<?php echo $tPublic; ?>',
           tx_ref: '<?php echo $phone; ?>' + Date.now(),
           amount: <?php echo $totalFees; ?>,
           currency: "NGN",
           payment_options: "card,ussd,barter",
           customer: {
             email: "<?php echo $email; ?>",
             phonenumber: <?php echo $phone; ?>,
             name: "Yemi Desola",
           },
           subaccounts: arr,
           callback: function (data) {
             console.log(data);
           },
           customizations: {
             title: "RIDDA",
             description: "Payment for items in cart",
             logo: "https://images.unsplash.com/photo-1557821552-17105176677c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=889&q=80",
           },
        
         "redirect_url": "http://localhost/ridda/cartpayment.php"
         
           
         });}
   } catch (error) {
    
   console.log(error)
  }

  window.onload = (event) => {
  document.getElementById('payFees').click();
};
</script>
  </div>
</div>
</body>
</html>








