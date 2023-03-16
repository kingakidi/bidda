<?php 
    include "./functions.php";
    $userid = $_SESSION['juId'];
    if (isset($_POST['aPForm'])) {
        $name =  checkForm($_POST['name']);
        $des =   trim(mysqli_escape_string($conn, ($_POST['des'])));
        $price = checkForm($_POST['price']);
        $cat = checkForm($_POST['cat']);
        $qty = checkForm($_POST['qty']);
        $product_type = checkForm($_POST['product_type']);

        $fName = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $type = $_FILES['image']['type'];
        $tmp = $_FILES['image']['tmp_name'];
        
        
        if (!empty($name) && !empty($des) && !empty($price) && !empty($cat) && !empty($qty) && !empty($_FILES['image'])) {
            //    CHECK IF PRODUCT ALREADY EXIST WITH THE SAME MERCHANT 
                $pCQuery = mysqli_query($conn, "SELECT * FROM `product` WHERE product.name='$name' AND product.user_id='$userid'");
                if (!$pCQuery) {
                    die(error("Product Verification Failed ").mysqli_error($conn));
                }else{
                    
                    if (mysqli_num_rows($pCQuery) > 0) {
                        echo error("YOU HAVE ALREADY ADD THIS PRODUCT");
                    }else{
                        $ext = pathinfo($fName, PATHINFO_EXTENSION);
                        
                        $nCFName = $userid."_".$name."_".date("Y-m-d").".".$ext;
                        $cd = dirname(__DIR__, 2);
                        $p = $_SESSION['juPhone'];
         
                        if (move_uploaded_file($tmp, $cd."/users/sydeestack_$p/$nCFName")) {
                            // INSERT THE PRODUCT INTO DB
                            $sql = "INSERT INTO `product`(`user_id`, `name`, `description`, `category_id`, `qty`, `price`, `images`, product_type) VALUES ($userid, '$name', '$des', $cat, $qty, $price,'$nCFName', '$product_type')";
                            if (!mysqli_query($conn, $sql)) {
                                die(error("Production upload failed try again ".mysqli_error($conn)));
                            }else{
                                echo info("Product Added successfully");
                            }
                            
                        }else{
                            die(error("UNABLE TO UPLOAD PRODUCT "));
                        };    
                        


                    }
                }
        }else{
            echo error("ALL FIELDS REQUIRED");
        }
    }

    // ALL PRODUCTS TABLES 


    if (isset($_POST['allProducts'])) {
        
        $aPQuery = mysqli_query($conn, "SELECT * FROM product ORDER BY date DESC");
        if (!$aPQuery) {
            die(error("PRODUCT FETCH FAILS ".mysqli_error($conn)));
        }else if(mysqli_num_rows($aPQuery) < 1){
            echo error("<h2 class='m-3'>NO PRODUCT UPLOADED</h2>");
        }else{
        ?>
        <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>S/N</th>
                <th>MERCHANT NAME</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>PRICE</th>
                <th>QTY UPLOADED</th>
                <th>IMAGE</th>
                <th>CATEGORY</th>
                <th>DATE</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // BRING PRODUCTS TABLES 
            $sn = 1;
            while ($row = mysqli_fetch_assoc($aPQuery)) {
                $mid = $row['user_id'];
                
                $n = $row['name'];
                $des = truncate($row['description']);
                $p = $row['price'];
                $q = $row['qty'];
                $c = $row['category_id'];
                $image = $row['images'];
                $date = $row['date'];

                // GET THE MERCHANT STORE NAME 
                    $msNameQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=$mid");
                    $msName = mysqli_fetch_assoc($msNameQuery)['trading_name'];
                    

                // GET THE CATEGORY  
                $catQuery = mysqli_query($conn, "SELECT * FROM category WHERE id=$c");
                if (!$catQuery) {
                    die(error("FAIL: ITEM CATEGORY"));
                }
                $catName = ucwords(mysqli_fetch_assoc($catQuery)['title']);
                $image = $row['images'];
                $date = $row['date'];
                // FETCH PRODUCT IMAGE 

                $uIQuery = mysqli_query($conn, "SELECT * FROM users WHERE id=$userid");
                if (!$uIQuery) {
                    die("PRODUCT  FAILED ");
                }
                $p = mysqli_fetch_assoc($uIQuery)['phone'];
                echo "<tr>
                <td>$sn</td>
                <td>$msName</td>
                <td>$n</td>
                <td>$des</td>
                <td>$p</td>
                <td>$q</td>
                <td> <img src='../users/sydeestack_$p/$image' alt='' style='width: 40px; height: 40px'></td>
                <td>$c</td>
                <td>$date</td>
                <td>Action</td>
            </tr>";
            $sn++;
            }

            echo "   </tbody>
            </table>";
        }
    }


    // FETCH MERCHANTS SALES  
    if (isset($_POST['mySales'])) {
        $uId = $_SESSION['juId'];
        // GET THE MERCHANT ID         
        $mIdQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=$uId");
                if (!$mIdQuery) {
                    die('MERCHANT INFO FAILED ');
                }else{
                    $merchantId = ucwords(mysqli_fetch_assoc($mIdQuery)['id']);
                }
        
       
        $pQuery = mysqli_query($conn, "SELECT * FROM `transaction` WHERE merchant_id =$merchantId ORDER BY date DESC");
    
      
        if (!$pQuery) {
            die("UNABLE TO GET YOUR PURCHASE ");
            exit();
        }
    
        if (mysqli_num_rows($pQuery) < 1) {
            echo '<div class="text-center text-info">You have no purchase record at the moment </div>';
        }else{
            echo '
                <table class="table table-bordered table-responsive">
                <thead>
                    <th>S/N</th>
                    <th>Item Name </th>
                    <th>Store Name</th>
                    <th>Delivery Company</th>
                    <th>Qty</th>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Status</th>
                </thead>
                <tbody>
    
            ';
            $sn = 1;
            while ($row = mysqli_fetch_assoc($pQuery)) {
                // echo "<pre>";
                // print_r($row);
                // echo "</pre>";
                $mId = $row['merchant_id'];
                $rId = $row['rider_id'];
                $qty = $row['qty'];
                $pId = $row['product_id'];
                $tId = $row['trasaction_id'];
                $date = $row['date'];
               
                // echo "$mId $rId $qty $pId $tId $date";
                // GET THE MERCHANT NAME 
                $mQuery = mysqli_query($conn, "SELECT * FROM profile WHERE id=$mId");
                if (!$mQuery) {
                    die('MERCHANT INFO FAILED ');
                }else{
                    $mName = ucwords(mysqli_fetch_assoc($mQuery)['trading_name']);
                }
               
               
                // GET THE DELIVERY NAME 
                $rQuery = mysqli_query($conn, "SELECT * FROM rider WHERE id=$rId");
                if (!$rQuery) {
                    die("DELIVERY COMPANY FAILED ".mysqli_error($conn));
                 
                }else{
                    $rName = ucwords(mysqli_fetch_assoc($rQuery)['company_name']);
                }
                // // GET THE PRODUCT NAME 
                $productQuery = mysqli_query($conn, "SELECT * FROM product WHERE id=$pId");
                if (!$productQuery) {
                    die("PRODUCT FAILED ".mysqli_error($conn));
                 
                }else{
                    $pName = ucwords(mysqli_fetch_assoc($productQuery)['name']);
                }  
                echo "
                    <tr>
                        <td>$sn</td>
                        <td>$pName</td>
                        <td>$mName</td>
                        <td>$rName</td>
                        <td>$qty</td>
                        <td>$tId</td>
                        <td>$date</td>
                        <td>Delivery Status</td>
                    </tr>";    
                    $sn++;     
            }
            echo "
                </tbody>
                </table>
                ";
        }


    }

    // FETCH DELIVERY REQUEST 
    if (isset($_POST['deliveryRequest'])) {
        $uId = $_SESSION['juId'];
        // GET THE MERCHANT ID         
        $rIdQuery = mysqli_query($conn, "SELECT * FROM rider WHERE userid=$uId");
                if (!$rIdQuery) {
                    die('RIDER INFO FAILED ');
                }else{
                    $riderId = ucwords(mysqli_fetch_assoc($rIdQuery)['id']);
                }
        
       
        $pQuery = mysqli_query($conn, "SELECT * FROM `transaction` WHERE rider_id =$riderId ORDER BY date DESC");
    
      
        if (!$pQuery) {
            die("UNABLE TO GET YOUR PURCHASE ");
            exit();
        }
    
        if (mysqli_num_rows($pQuery) < 1) {
            echo '<div class="text-center text-info">You have no purchase record at the moment </div>';
        }else{
            echo '
                <table class="table table-bordered table-responsive">
                <thead>
                    <th>S/N</th>
                    <th>Item Name </th>
                    <th>Store Name</th>
                    <th>Delivery Company</th>
                    <th>Qty</th>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Status</th>
                </thead>
                <tbody>
    
            ';
            $sn = 1;
            while ($row = mysqli_fetch_assoc($pQuery)) {
                // echo "<pre>";
                // print_r($row);
                // echo "</pre>";
                $mId = $row['merchant_id'];
                $rId = $row['rider_id'];
                $qty = $row['qty'];
                $pId = $row['product_id'];
                $tId = $row['trasaction_id'];
                $date = $row['date'];
               
                // echo "$mId $rId $qty $pId $tId $date";
                // GET THE MERCHANT NAME 
                $mQuery = mysqli_query($conn, "SELECT * FROM profile WHERE id=$mId");
                if (!$mQuery) {
                    die('MERCHANT INFO FAILED ');
                }else{
                    $mName = ucwords(mysqli_fetch_assoc($mQuery)['trading_name']);
                }
               
               
                // GET THE DELIVERY NAME 
                $rQuery = mysqli_query($conn, "SELECT * FROM rider WHERE id=$rId");
                if (!$rQuery) {
                    die("DELIVERY COMPANY FAILED ".mysqli_error($conn));
                 
                }else{
                    $rName = ucwords(mysqli_fetch_assoc($rQuery)['company_name']);
                }
                // // GET THE PRODUCT NAME 
                $productQuery = mysqli_query($conn, "SELECT * FROM product WHERE id=$pId");
                if (!$productQuery) {
                    die("PRODUCT FAILED ".mysqli_error($conn));
                 
                }else{
                    $pName = ucwords(mysqli_fetch_assoc($productQuery)['name']);
                }  
                echo "
                    <tr>
                        <td>$sn</td>
                        <td>$pName</td>
                        <td>$mName</td>
                        <td>$rName</td>
                        <td>$qty</td>
                        <td>$tId</td>
                        <td>$date</td>
                        <td>Delivery Status</td>
                    </tr>";    
                    $sn++;     
            }
            echo "
                </tbody>
                </table>
                ";
        }


    }
?>
    
    <?php
    
    // MY PRODUCTS 
    if (isset($_POST['myProducts'])) {
                
                $aPQuery = mysqli_query($conn, "SELECT * FROM product WHERE user_id=$userid ORDER BY date DESC");
                if (!$aPQuery) {
                    die(error("PRODUCT FETCH FAILS ".mysqli_error($conn)));
                }else if(mysqli_num_rows($aPQuery) < 1){
                    echo error("<h2 class='m-3'>NO PRODUCT UPLOADED</h2>");
                }else{
        ?>
        <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>PRICE</th>
                        <th>QTY UPLOADED</th>
                        <th>IMAGE</th>
                        <th>CATEGORY</th>
                        <th>DATE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                    // BRING PRODUCTS TABLES 
                    $sn = 1;
                    while ($row = mysqli_fetch_assoc($aPQuery)) {
                        $mid = $row['user_id'];
                        $n = strtoupper($row['name']);
                        $des = $row['description'];
                        $tDes = truncate($des);
                        $price = $row['price'];
                        $q = $row['qty'];
                        
                        $c = $row['category_id'];

                        // GET THE CATEGORY  
                        $catQuery = mysqli_query($conn, "SELECT * FROM category WHERE id=$c");
                        if (!$catQuery) {
                            die(error("FAIL: ITEM CATEGORY"));
                        }



                        $catName = ucwords(mysqli_fetch_assoc($catQuery)['title']);
                        $image = $row['images'];
                        $date = $row['date'];
                        // FETCH PRODUCT IMAGE 

                        $uIQuery = mysqli_query($conn, "SELECT * FROM users WHERE id=$userid");
                        if (!$uIQuery) {
                            die("PRODUCT  FAILED ");
                        }
                        $p = mysqli_fetch_assoc($uIQuery)['phone'];
                        
                        echo "<tr>
                        <td>$sn</td>
                        <td>$n</td>
                        <td>$tDes</td>
                        <td>$price</td>
                        <td>$q</td>
                        <td> <img src='../users/sydeestack_$p/$image' alt='' style='width: 40px; height: 40px'></td>
                        <td>$catName</td>
                        <td>$date</td>
                        <td>Action</td>
                    </tr>";
                    $sn++;
                    }

                    echo "   </tbody>
                    </table>";
                }
            }

    // ADDING CATEGORY 
    if (isset($_POST['catAdd'])) {
        $cn = checkForm($_POST['cn']);
        $p = checkPass($_POST['p']);
       
        // CHECK IF ALL FIELD IS FILLED

        if (!empty($cn) && !empty($p)) {
            // CHECK IF CATEGORY ALREADY EXIST 
            $cCQuery = mysqli_query($conn, "SELECT * FROM category WHERE title='$cn'");
            if(!$cCQuery){
                die(error('CATEGORY CHECK FAILED ').mysqli_error($conn));
            }else if(mysqli_num_rows($cCQuery) > 0){
                echo error("CATEGORY ALREADY EXIST");
                exit();
            }else{
                // CHECK IF PASSWORD IS CORRECT
                $uQuery = mysqli_query($conn, "SELECT * FROM users WHERE id=$userid");
                $row = mysqli_fetch_assoc($uQuery);
                $dbPassword = $row['password'];
                
                if (password_verify($p, $dbPassword)) {
                //   UPDATE THE CATEGORY 

                    $category_query = mysqli_query($conn, "INSERT INTO `category`(`title`, `status`) VALUES ('$cn', 'approve')");
                    if (!$category_query) {
                        die(error("CATEGORY FAIL ").mysqli_error($conn));
                    }else{
                        echo info("CATEGORY ADDED SUCCESSFULLY");
                    }

                }else{
                    echo error("INVALID PASSWORD");
                }
                
            }
        }else{
            echo error("ALL FIELD REQUIRED");
        }
    }

    if (isset($_POST['viewCat'])) {
    
            // SELECT ALL CATEGORY 
            $category_query = mysqli_query($conn, "SELECT * FROM category");
            if (!$category_query) {
                die(error("CATEGORY QUERY FAILED ").mysqli_error($conn));
            }else if(mysqli_num_rows($category_query) < 1){
                echo info("<h2>NO CATEGORY</h2>");
            }else{
                echo '<table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>NAME</th>
                        <th>NO OF PRODUCTS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>';
                $sn = 1;
              while ($row = mysqli_fetch_assoc($category_query)) {
                  $id = $row['id'];
                  $title = ucwords($row['title']);

                echo "<tr>
                        <td>$sn</td>
                        <td>$title</td>
                        <td>78</td>
                        <td>Action</td>
                    </tr>";
                $sn++;
              } 
              echo '</tbody>
              </table>';
            }
        }


        // GET ALL BANKS BASE ON COUNTRY 

        if (isset($_POST['fetchBanks'])) {
          try {
            $cn = $_POST['fetchBanks'];

            $curl = curl_init();
             curl_setopt_array($curl, array(
             CURLOPT_URL => "https://api.flutterwave.com/v3/banks/$cn",
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 0,
             CURLOPT_FOLLOWLOCATION => true,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "GET",
             CURLOPT_HTTPHEADER => array(
                 "Authorization: Bearer $lSecret"
             ),
             ));
             $response = curl_exec($curl);
 
             curl_close($curl);
             $res = json_decode($response, true);
            

             echo "<option value=''> Choose Bank </option>";
             foreach ($res['data'] as $banksArray) {
             $bankName = $banksArray['name'];
             $bankCode = $banksArray['code'];
                 echo "<option value='$bankCode'> $bankName </option>";
             }
          } catch (\Throwable $th) {
       

            print_r($th);
          }
        
        }

    // USER PROFILE UPDATE 
    if (isset($_POST['userProfileUpdate'])) {
        $dob = $_POST['dob'];
        $address = checkForm($_POST['address']);
        $city = checkForm($_POST['city']);
        $state = checkForm($_POST['state']);
        $userid = $_SESSION['juId'];
        // CHECK FOR EMPTY FIELDS 
        if (!empty($dob) && !empty($address) && !empty($city) && !empty($state)) {
            // CHECK IF TRADING NAME ALREADY EXIST 
            $uPQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=$userid");
            if (!$uPQuery) {
                die(error("USER VERIFICATION FAILED ".mysqli_error($conn)));
            }else if(mysqli_num_rows($uPQuery) > 0){
                echo error("PROFILE ALREADY EXIST");
                exit();
            }else{
            
            // IF NO SEND THE DATA TO DB 
            $sql = "INSERT INTO `profile`(`userid`, `dob`, `address`, `city`, `state`) VALUES ($userid, '$dob', '$address', '$city', '$state' )";
            $preUpdateQuery = mysqli_query($conn, $sql);
            if (!$preUpdateQuery) {
                die(error("FAILED TO UPDATE PROFILE <br>").mysqli_error($conn));
            }else{
                echo success("PROFILE UPDATED SUCCESSFULLY");
            }


            }
        
        }else{
            echo error('ALL FIELD REQUIRED');
        }

    }
    

    // SETTLEMENT UPDATE FORM
    if (isset($_POST['settlementSubmitForm'])) {
        $tn = checkForm($_POST['tn']);
        $act = checkForm($_POST['act']);
        $c = strtoupper(checkForm($_POST['c']));
        $bank = checkForm($_POST['bank']);
        $userid = $_SESSION['juId'];
        // CHECK FOR EMPTY FIELDS 
        if (!empty($tn) && !empty($act) && !empty($c) && !empty($bank)) {
            
            // CHECK IF TRADING NAME ALREADY EXIST 
            $tnExistQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=$userid");
            if (!$tnExistQuery) {
                die(error("VALIDATING TRADING REGISTRATION FAILED ".mysqli_error($conn)));
            }else if(mysqli_fetch_assoc($tnExistQuery)['trading_name'] !== ""){
                echo error("YOU HAVE ALREADY REGISTERED TRADING INFORMATION");
            }else{

                $uPQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=$userid");
                if (!$uPQuery) {
                    die(error("USER VERIFICATION FAILED ".mysqli_error($conn)));
                }else if(mysqli_num_rows($uPQuery)  < 1){
                    echo error("KINDLY FILLED IN YOUR PERSONAL DETAILS TO PROCEED");
                    exit();
                }else{
                    // CHECK IF MERCHANT ALREADY EXIST 
                    $cTradingName = mysqli_query($conn, "SELECT * FROM `profile` WHERE trading_name = '$tn'");
                    if (!$cTradingName) {
                        die(error("FAILED TO VERIFY TRADING NAME ").mysqli_error($conn));
                    }else if(mysqli_num_rows($cTradingName) > 0){
                        echo error('TRAIDING NAME ALREADY REGISTERED');
                    }else{
                        // SEND THE SUB ACCOUNT REQUEST TO FLUTTERWAVE 
                        
                        $phone = $_SESSION['juPhone'];
                        $email =  $_SESSION['juEmail'];
                        

                        // SELECT ADDRESS FROM PROFILE PAGE 
                        $addressQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=$userid");
                        if (!$addressQuery) {
                            die(error("ADDRESS FETCH FAILED ").mysqli_error($conn));
                        }
                        $address = mysqli_fetch_assoc($addressQuery)['address'];
                        // echo "$phone </br> $email <br> $address <br> $bank <br> $tn <br> $act <br> $c";


                        // API CALL FOR SUB ACCOUNT 
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.flutterwave.com/v3/subaccounts",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS =>"{\n    \"account_bank\": \"$bank\",\n    \"account_number\": \"$act\",\n    \"business_name\": \"$tn\",\n    \"business_email\": \"$email\",\n    \"business_contact\": \"$address\",\n    \"business_contact_mobile\": \"$phone\",\n    \"business_mobile\": \"$phone\",\n    \"country\": \"$c\",\n    \"meta\": [\n        {\n            \"meta_name\": \"mem_adr\",\n            \"meta_value\": \"0x16241F327213\"\n        }\n    ],\n    \"split_type\": \"percentage\",\n    \"split_value\": 0.9\n}",
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json",
                            "Authorization: Bearer $lSecret"
                        ),
                        ));

                        $response = curl_exec($curl);

                        curl_close($curl);
                        $res = json_decode($response, true);
                        $status = $res['status'];
                        $message = $res['message'];
                        $data = $res['data'];
                        if ($status === 'success') {

                        $account_number = $data['account_number'];
                        $bank_code = $data['account_bank'];
                        $full_name = $data['full_name'];
                        $subaccount_id = $data['subaccount_id'];
                        $bank_name  = $data['bank_name'];
                        
                        

                        // UPDATE THE PROFILE 
                            $mUQuery = mysqli_query($conn, "UPDATE `profile` SET `trading_name`='$tn',`account_number`= $account_number,`account_name`='$full_name',`country`='$c',`bank`='$bank_name',`bank_code`='$bank_code', subaccount_id='$subaccount_id' WHERE userid=$userid");

                            if (!$mUQuery) {
                                die(error("FAILED TO UPDATE MERCHNAT ID.. CONTACT ADMIN..").mysqli_error($conn));
                            }else{
                                echo success("MERCHANT PROFILE UPDATED SUCCESSFULLY");
                            }
                        
                        }else{
                            $message = str_replace('A subaccount with the', 'account', $message);
                            echo error($message);
                        }

                    }
                }
            }
            }else{
                echo error('ALL FIELD REQUIRED');
            }      
    }
    
    if (isset($_POST['scDetails'])) {
        $userid = $_SESSION['juId'];
        $cName = checkForm($_POST['cName']);
        $cAddress = checkForm($_POST['cAddress']);
        $cPhone = checkForm($_POST['cPhone']);
        $nFleet = checkForm($_POST['nFleet']);
        $cFileName = $_FILES['cFile']['name'];
        $cFileSize = $_FILES['cFile']['size'];
        $cFileType = $_FILES['cFile']['type'];
        $cFileTmp = $_FILES['cFile']['tmp_name'];
        
        // CHECK FOR ANY EMPTY FIELD 

        // CHECK FOR COMPANY ALREADY EXIST 
        $cEQuery = mysqli_query($conn, "SELECT * FROM rider WHERE company_name='$cName'");
        if ($cName === ""  OR $cAddress === "" OR $cPhone === "" OR $nFleet === "" OR empty($_FILES)) {
            echo error("ALL FIELD REQUIRED");
        }else if(mysqli_num_rows($cEQuery) > 0){
            echo error("COMPANY DETAILS ALREADY EXIST");
        }else if($cFileType !== 'application/pdf'){
            echo error("INVALID FILE: UPLOAD PDF ONLY");
        }else if($cFileSize > 5000000){
            echo error("FILE TOO LARGE: MAXIMUM OF 5MB");
        }else{
            // CHECK IF THE USER HAS A RECORD IN DB
            $cRQuery = mysqli_query($conn, "SELECT * FROM `rider` WHERE userid=$userid");
            if (!$cRQuery) {
                die("FAILED UNABLE TO VERIFY DETAILS ".mysqli_error($conn));
            }else if(mysqli_num_rows($cRQuery) > 0){
                echo error("COMPANY DETAILS ALREADY EXIST");
            }else{
                // INSERT THE VALUES INTO DB 
                    // SET THE FILE NAME 
                    $ext = pathinfo($cFileName, PATHINFO_EXTENSION);
                    $p = $_SESSION['juPhone'];
                    $nCFName = $userid."_".$cName."_".date("Y-m-d").".".$ext;
                  
                $sql = "INSERT INTO `rider`(`userid`, `company_name`, `company_phone`, `company_address`, `number_of_fleet`, `company_document`, `status`) VALUES ($userid, '$cName', '$cPhone', '$cAddress', '$nFleet', '$nCFName', 'false')";
                $cDQuery =  mysqli_query($conn, $sql);
                $cd = dirname(__DIR__, 2);
         
                if (move_uploaded_file($cFileTmp, $cd."/users/sydeestack_$p/$nCFName") && $cDQuery) {
                    echo success("REGISTERED SUCCESSFULLY");
                }else{
                    die(error("COMPANY REGISTERATION FAILED ").mysqli_error($conn));
                };             
              
            }
        }
       
    }  
    
    // RIDDER SETTLMENT UPDATE 
    if (isset($_POST['rsU'])) {
        $acn = checkForm($_POST['acn']);
        $country = strtoupper(checkForm($_POST['country']));
        $bank = checkForm($_POST['bank']);

        if ($acn === "" OR $country === "" OR $bank === "") {
            echo error("All field required");
        }else{
           // API CALL FOR SUB ACCOUNT 
           $phone = $_SESSION['juPhone'];
           $email =  $_SESSION['juEmail'];
        

           $uQuery = mysqli_query($conn, "SELECT * FROM rider WHERE userid=$userid");
           
           if (!$uQuery) {
               die(error("FAILED: COMPANY INFORMATION ").mysqli_error($conn));
           }else{
               $row = mysqli_fetch_assoc($uQuery);
               $address = $row['company_address'];
               $company_name = $row['company_name'];

               $curl = curl_init();

               curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/subaccounts",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>"{\n    \"account_bank\": \"$bank\",\n    \"account_number\": \"$acn\",\n    \"business_name\": \"$company_name\",\n    \"business_email\": \"$email\",\n    \"business_contact\": \"$address\",\n    \"business_contact_mobile\": \"$phone\",\n    \"business_mobile\": \"09087930450\",\n    \"country\": \"$country\",\n    \"meta\": [\n        {\n            \"meta_name\": \"mem_adr\",\n            \"meta_value\": \"0x16241F327213\"\n        }\n    ],\n    \"split_type\": \"percentage\",\n    \"split_value\": 0.85\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $lSecret"
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $res = json_decode($response, true);
                
                $status = $res['status'];
                $message = $res['message'];
                $data = $res['data'];
                if ($status === 'success') {

                    $account_number = $data['account_number'];
                    $bank_code = $data['account_bank'];
                    $full_name = $data['full_name'];
                    $subaccount_id = $data['subaccount_id'];
                    $bank_name  = $data['bank_name'];

                    $sql = "UPDATE `rider` SET `account_number`='$account_number',`bank`='$bank_code',`account_name`='$full_name',`subaccount_id`='$subaccount_id',`country`='$country', bank_name='$bank_name'";
                    $query = mysqli_query($conn, $sql);
                    if (!$query) {
                        die(error("COMPANY DETAILS UPDATE FAIL ").mysqli_error($conn));
                    }else{
                        echo success("DETAILS UPDATED SUCCESSFULLY");
                    }
                }else{
                    $message = str_replace('A subaccount with the', 'account', $message);
                    echo error($message);
                }

           }

                
        }
        
    }

    if (isset($_POST['mRAS'])) {
        $riderId = checkForm($_POST['riderId']);

        // CHECK IF RIDER IS ALREADY ASSIGN 
            $cMRQuery = mysqli_query($conn, "SELECT * FROM merchant_riders WHERE merchant_id=$userid");
            if (!$cMRQuery) {
                die(error("FAILED TO VERIFY ").mysqli_error($conn));
            }else if (mysqli_num_rows($cMRQuery) > 0){
                echo info("RIDER ALREADY ASSIGNED");
            }else{

           
                if (!empty($riderId)) {
                    // ASSIGN RIDER TO MERCHANT 
                    $mRASQuery = mysqli_query($conn, "INSERT INTO `merchant_riders`( `merchant_id`, `rider_id`) VALUES ($userid, $riderId)");
                    if (!$mRASQuery) {
                        die(error("Fail ").mysqli_error($mRASQuery));
                    }else{
                        echo success("RIDER ASSIGN SUCCESSFULLY");
                    }
                }
            }
    }


    // vue receive data 

  $receive_data = json_decode(file_get_contents("php://input"));
  $data = array();
if(isset($receive_data->getMyBids)){

    $user_id = $_SESSION['juId']; 

    // get all the bids of login users
    $mybids_query = mysqli_query($conn, "SELECT * FROM product WHERE product_type = 'bidda' AND user_id = $user_id");

    if(!$mybids_query){
        $data['message'] = "something went wrong"; 
        $data['status'] = false; 
        
        echo json_encode($data);

        die(); 
    }else{
        $n = 1; 
        while ($row = $mybids_query->fetch_assoc()) {
            $data['data'][] = $row;

            $n++;
        }

    // am about to append data to fetch products 
        $data['status'] = true; 
        $data['message'] = "Bids products fetch successfully";
       

        echo json_encode($data);
    }
}


if(isset($receive_data->getBidById)){

    $product_id = $receive_data->product_id;

  
    $get_bid_query = mysqli_query($conn, "SELECT bids.amount as amount, users.fullname as fullname, product.name as product_name, users.phone as phone_number, users.id as user_id, product.id as product_id, bids.status as bid_status FROM bids JOIN product ON bids.product_id = product.id JOIN users ON bids.bidder_id = users.id WHERE bids.product_id = $product_id ORDER BY bids.amount ASC;"); 

    if(!$get_bid_query){
        $data['status'] = false; 
        $data['message'] = "something went wrong";
        
        echo json_encode($data); 
        die("SOMETHING WENT WRONG");
    }else{
        $n = 1; 
        while ($row = $get_bid_query->fetch_assoc()) {
            $row["amount"] = number_format($row["amount"]);
            $row["fullname"] = ucwords($row["fullname"]);

            $data['data'][] = $row;

            $n++;
        }

        // am about to append data to fetch products 
        $data['status'] = true; 
        $data['message'] = "Bids products fetch successfully";
       

        echo json_encode($data);
        
    }
}
   

// Select bid winner 

if(isset($receive_data->selectedBidWinner)){

    $product_id = $receive_data->product_id; 
    $user_id = $receive_data->user_id; 

   
    // check if winner has been set before for this products 

    $select_bid_winner_query = mysqli_query($conn, "UPDATE bids SET bids.status = 'win' WHERE product_id = $product_id AND bidder_id = $user_id"); 

    if(!$select_bid_winner_query){
        $data['status'] = false; 
        $data['message'] = "Something went wrong"; 

        die("Unable to update winner".$conn->error); 
    }else{
        $data['message'] = "winner selected successfully"; 
        $data['status'] = true; 
    }

    echo json_encode($data);
}

// check bid winner 
if(isset($receive_data->checkBidWin)){
    $product_id = $receive_data->product_id; 

    $check_bid_win_query = mysqli_query($conn, "SELECT * FROM bids WHERE product_id = $product_id AND bids.status = 'win'"); 
    
    if(!$check_bid_win_query){
        $data['status'] = true; 
        $data['message'] = "Something went wrong"; 

        die("Something went wrong ".$conn->error);
    }else{
        
        $num_rows = mysqli_num_rows($check_bid_win_query); 
        
        if($num_rows > 0){
            $data['isWon'] = true; 
            $data['status'] = true; 
            $data['message'] = "this product is already won"; 

        }else{
            $data['isWon'] = false; 
            $data['status'] = true; 
            $data['message'] = "The bid is open"; 
        }
    }

    echo json_encode($data);
}

// proposed bids 

if(isset($receive_data->proposedBids)){

    $user_id = $_SESSION['juId'];

    $proposed_bid_query = mysqli_query($conn, "SELECT bids.id as bids_id, product.name as product_name, product.id as product_id, product.price as product_price, bids.amount as bidder_amount, bids.status as bidder_status FROM bids JOIN product ON bids.product_id = product.id WHERE bidder_id = $user_id "); 

    if(!$proposed_bid_query){
        $data['status'] = false; 
        $data['message'] = "something went wrong"; 

        die("Something went wrong ".$conn->error); 
    }else{
        $n = 1; 
        while ($row = $proposed_bid_query->fetch_assoc()) {
            $row['product_name'] = ucwords($row['product_name']);
            $row['product_price'] = number_format($row['product_price']);
            $row['bidder_amount'] = number_format($row['bidder_amount']);

            $product_id = $row['product_id'];
            // check bids status 
            
            $check_bid_status = mysqli_query($conn, "SELECT * FROM bids WHERE product_id = $product_id AND bids.status='win'");
            
           
            $status_num = mysqli_num_rows($check_bid_status);
            
            $row['isWon'] = $status_num;
         

            $data['data'][] = $row;

            $n++;
        }

        $data['status'] = true; 
        $data['message'] = "bids selected successfully"; 
    }

    echo json_encode($data);
}


// Get bids by bid id 
if(isset($receive_data->getBidByBidId)){

    $bid_id = $receive_data->bid_id;

  
    $get_bid_query = mysqli_query($conn, "SELECT bids.amount as amount, users.fullname as fullname, product.name as product_name, users.phone as phone_number, users.id as user_id, users.email as user_email, product.id as product_id, bids.status as bid_status FROM bids JOIN product ON bids.product_id = product.id JOIN users ON bids.bidder_id = users.id WHERE bids.id = $bid_id ORDER BY bids.amount ASC;"); 

    if(!$get_bid_query){
        $data['status'] = false; 
        $data['message'] = "something went wrong";
        
        echo json_encode($data); 
        die("SOMETHING WENT WRONG");
    }else{
        $n = 1; 
        while ($row = $get_bid_query->fetch_assoc()) {
          
            $row["fullname"] = ucwords($row["fullname"]);

            $data['data'][] = $row;

            $n++;
        }

        // am about to append data to fetch products 
        $data['status'] = true; 
        $data['message'] = "Bids products fetch successfully";
       

        echo json_encode($data);
        
    }
}
?>          
 