<div class="item" id="item">
    
    <div class="item-link-container" id="item-link-container">
        <div>
            <a href="?p=profile" class="item-link" id="viewprofile">View Profile</a>
        </div>
        <div>
            <a class="item-link" name="p-link" id="personaldetails">Personal Details</a>
        </div>
      
        <div>
            <a class="item-link" name="p-link" id="settlementaccount">Merchant Details</a>
        </div>
        <div >
            <a class="item-link" name="p-link" id="riderdetails">Rider Detail</a>
        </div>
        
        
    </div>
    <div class="show-item mt-3" id="show-item">
            <!-- BRING THE PROFILE DETAILS  -->
            <?php
            
                $pQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=".$_SESSION['juId']);
                if (!$pQuery) {
                    die("FAILED TO FETCH QUERY");
                }else if(mysqli_num_rows($pQuery) < 1){
                        echo '<div class="text-center ">
                        Kindly Fill your Personal and Settlement Details Using the Links Above
                        </div>';
                }else{
                        echo '
                            <table class="table" id="profile-table">
                            <thead>
                            </thead>
                            <tbody>
                        ';
                    $row = mysqli_fetch_assoc($pQuery);
                    $tn = ucwords($row['trading_name']);
                    $accountNumber = $row['account_number'];
                    $accountName = $row['account_name'];
                    $country = $row['country'];
                    $bank = $row['bank'];
                    $dob = $row['dob'];
                    $address = $row['address'];
                    $city = ucwords($row['city']);
                    $state =ucwords($row['state']);

                    echo "
                        <tr>
                            <td>Trading Name</td>
                            <td>$tn</td>
                        </tr>
                        <tr>
                            <td>Account Name</td>
                            <td>$accountName</td>
                        </tr>
                        <tr>
                            <td>Account Number</td>
                            <td>$accountNumber</td>
                        </tr>
                        <tr>
                            <td>Bank</td>
                            <td>$bank</td>
                        </tr> 
                        <tr>
                            <td>Date of Birth</td>
                            <td>$dob</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>$address</td>
                        </tr> 
                        <tr>
                            <td>City</td>
                            <td>$city</td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>$state</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>$country</td>
                        </tr>

                        </tbody>
                        </table>
                    ";
                    
                }
            ?>
    </div>
</div>


                    
 





