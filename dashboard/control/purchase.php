<?php
    $uId = $_SESSION['juId'];
    $pQuery = mysqli_query($conn, "SELECT * FROM `transaction` WHERE user_id =$uId ORDER BY date DESC");

  
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
    ?>



            
      

    
