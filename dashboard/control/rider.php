<div class="item" id="item">
    
    <div class="item-link-container" id="item-link-container">
        <div>
            <a href="?p=rider" name='' class="item-link" id="viewprofile">View Profile</a>
        </div>
        <div>
            <a name='p-link' class="item-link" id="companyrecord">Company Details</a>
        </div>
        <div>
            <a name='p-link' class="item-link" id="settlement">Settlement Information</a>
        </div>
        <div>
            <a name='p-link' class="item-link" id="orders">Delivery Orders</a>
        </div>
      
    </div>
    <div class="show-item mt-3" id="show-item">
        <?php 
                $userid = $_SESSION['juId'];
               $query = mysqli_query($conn, "SELECT * FROM rider WHERE userid=$userid");
               if (!$query) {
                   die(("PROFILE DETAILS FAILED ").mysqli_query($conn));
               }else if(mysqli_num_rows($query) > 0){
                   $row = mysqli_fetch_assoc($query);
                  
                   
                    $cName = ucwords($row['company_name']);
                    $cPhone = $row['company_phone'];
                    $accountNumber = $row['account_number'];
                    $bank = $row['bank'];
                    $bankName = $row['bank_name'];
                    $country = $row['country'];
                    $cAddress = ucwords($row['company_address']);
                    $nFleet = $row['number_of_fleet'];
                    $cDocument = $row['company_document'];
                    $status =  $row['status'];
                    $p = $_SESSION['juPhone'];
                    echo "
                    <table class='table'>
                    <tbody>
                               <tr>
                                    <td>Company Name</td>
                                    <td>$cName</td>
                               </tr>
                               <tr>
                                    <td>Company Phone</td>
                                    <td>$cPhone</td>
                               </tr>
                               <tr>
                                    <td>Account Number</td>
                                    <td>$accountNumber</td>
                               </tr>
                               <tr>
                                    <td>BANK NAME</td>
                                    <td>$bankName</td>
                               </tr>
                               <tr>
                                    <td>Number of Fleet</td>
                                    <td>$nFleet</td>
                               </tr>
                               <tr>
                                    <td>Company Address</td>
                                    <td>$cAddress</td>
                               </tr>
                               <tr>
                                    <td>Country</td>
                                    <td>$country</td>
                               </tr>
                               
                               <tr>
                                    <td>Document</td>
                                    <td><a href='../users/sydeestack_$p/$cDocument' target='_blank'><i class='fa fa-file-pdf-o fa-2x' aria-hidden='true'></i> </a></td>
                               </tr>
                               <tr>
                                    <td>Status</td>
                                    <td>$status</td>
                               </tr>
                               
                    </tbody>
                </table>
                    ";


               }else{
                   echo "KINDLY UPDATE YOUR COMPANY AND SETTLEMENT DETAILS";
               }
        ?>
    </div>
</div>
