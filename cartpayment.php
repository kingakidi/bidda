<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MERCHANT ACTIVATION VERIFICATION </title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="activation-container">
  <div class="">
  <?php
  require('./control/conn.php');

    if (isset($_GET['status'])) {
      $status = $_GET['status'];

      if ($status === 'successful') {
        $ti = $_GET['transaction_id'];
        $_SESSION['transaction_id'] = $ti;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$ti/verify",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer $lSecret"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response, true);
        

        if ($res['status'] ==='success') {
            // CHECK THE TRASACTION STATUS 
            $t_status = $res['data']['status'];
            if ( $t_status === 'successful') {
                echo "SUCCESSFUL";
                header('Location: ./updateDb.php');
            }
        }else{
          echo "MERCHANT FEES VERIFICATION FAILED, IF DEBITED PROCEED TO <a href='./login.php' class='btn btn-jumga'> LOGIN </a>";
          exit();
        }
      }
    }


?>
  </div>
</div>
</body>
</html>






