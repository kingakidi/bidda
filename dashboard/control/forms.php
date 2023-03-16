<?php 
     include "./functions.php";
     $userid = $_SESSION['juId'];
    if (isset($_POST['aPForm'])) {
        
        echo '  
        
            <div class="flex flex-column">
                 


                <form enctype="multipart/form-data" class="addProduct" id="addProduct">
                    <div class="form-group">
                        <label> Select product type</label>
                        <select class="form-control" id="product_type">
                            <option value="bidda" selected> Bidda Product </option>
                            <option value="merchant"> Merchant Product </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" placeholder="Product Name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="des">Description</label>
                        <textarea name="" id="des" cols="20" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" placeholder="Price" id="price">
                    </div>
                    <div class="form-group">
                        <label for="qty">Quantity Available</label>
                        <input type="number" class="form-control" placeholder="Quantity Available" id="qty">
                    </div>
                    <div class="form-group">
                        <label for="cat">Select Category</label>
                        <select name="category" id="cat" class="form-control">
                        <option value="" selected disabled>Select Category</option>';


                        // CATEGORY SELECTION 

                        $cQuery = mysqli_query($conn, "SELECT * FROM category WHERE category.status ='approve'");
                        if (!$cQuery) {
                            die(error("Category Fails"));
                        }else if(mysqli_num_rows($cQuery) < 1){
                            echo "<option value=''>NO CATEGORY</option>";
                        }else{

                            while ($row = mysqli_fetch_assoc($cQuery)) {
                                $title = ucwords($row['title']);
                                echo $title;
                                $id = $row['id'];
                                echo "<option value='$id'>$title</option>";
                            }
                            
                        }

                    echo '
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div>
                                <label for="">Select Product Image </label>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="p-image">
                                <label class="custom-file-label" for="p-image">Choose file</label>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="image-info" id="image-info" accept="image/*"></div>
                        </div>
                    </div>
                    <div class="m-3">
                        <div class="error" id="pfError"></div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-jumga bg-cyan-500 text-white" id="btn-pf">Add Product</button>
                    </div>
                </form>
            </div>
              
       ';

    }

    if (isset($_POST['aCForm'])) {
       echo '<form class="category-form" id="category-form">
       <div class="form-group">
           <label for="category-name"> Category Name</label>
           <input type="text" class="form-control" placeholder="Category Name" id="category-name" required>
       </div>
       <div class="form-group">
           <label for="password">Password</label>
           <input type="password" class="form-control" id="password" placeholder="Password">
       </div>
       <div class="error error-cf text-center" id="error-cf"></div>
       <div class="form-group text-right">
            <button type="submit" id="btn-af" class="btn btn-jumga">Add</button>
       </div>
        </form>';
    }


    // SETTLEMENT FORM 
    if (isset($_POST['personalform'])) {

        $userid = $_SESSION['juId'];
        $uPQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=$userid");
        if (!$uPQuery) {
            die(error("USER VERIFICATION FAILED ".mysqli_error($conn)));
        }else if(mysqli_num_rows($uPQuery)  > 0){

            echo '
            <table class="table" id="profile-table">
            <thead>
            </thead>
            <tbody>
        ';
            $row = mysqli_fetch_assoc($uPQuery);
       
            $dob = $row['dob'];
            $address = ucwords($row['address']);
            $city = ucwords($row['city']);
            $state =ucwords($row['state']);

            echo "
                   
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
                    
                </tbody>
                </table>
            ";

            }else{
            echo '<div class="personal-form" id="personal-form">
            <form class="profile-form" id="profile-form">
                
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control"  id="dob" required>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Address" required>
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" placeholder="City" required>
                        </div>
                    </div>
                    <div class="col-sm">
                    <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" placeholder="State" required>
                        </div>
                    </div>
                </div>
                <div class="error profile-form-error" id="profile-form-error">
        
                </div>
                <div class="form-group text-right">
                    <button type="submit" id="profile-btn-submit" class="btn btn-jumga">Update</button>
                </div>
                
                
            </form>
        </div>';
        }
    }

    // SETTLEMENT FORM
    if (isset($_POST['settlementform'])) {

            $userid = $_SESSION['juId'];
            $uPQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=$userid");

            if (!$uPQuery) {
                die(error("USER VERIFICATION FAILED ".mysqli_error($conn)));
            }else if(mysqli_num_rows($uPQuery)  < 1){
                echo info("KINDLY FILLED IN YOUR PERSONAL DETAILS TO PROCEED ");
               
            }else if(mysqli_fetch_assoc($uPQuery)['trading_name']  !== ""){
                $uTQuery = mysqli_query($conn, "SELECT * FROM profile WHERE userid=$userid");
                // print_r(mysqli_fetch_assoc($uTQuery));
                    // BRING SETTLEMENT DETAIL 
                    echo '
                    <table class="table" id="profile-table">
                    <thead>
                    </thead>
                    <tbody>
                ';
                    $sRow = mysqli_fetch_assoc($uTQuery);
                    // print_r($sRow);
                    $tn = ucwords($sRow['trading_name']);
                    $accountNumber = $sRow['account_number'];
                    $accountName = $sRow['account_name'];
                    $country = $sRow['country'];
                    $bank = $sRow['bank'];
                    

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
                            <td>Country</td>
                            <td>$country</td>
                        </tr>

                        </tbody>
                        </table>
                    ";


            }else{               

                echo '          
                    <div class="settlement-container">
                        <form action="" class="settlement-form" id="settlement-form">
                        <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="merchant">Trading Name</label>
                                <input type="text" class="form-control" placeholder="Trading Name" id="trading-name">
                            </div>
                        </div>
                        <div class="col-sm">
                        <div class="form-group">
                                <label for="account-number" id="">Account Number</label>
                                <input type="number" class="form-control" placeholder="Account Number" id="account-number">
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-sm">
                            <label for="country">Country</label>
                            <select name="country" id="country" class="form-control">

                                <option value="" selected disabled>Select Country</option>
                                <option value="NG">NIGERIA</option>
                                <option value="GH">GHANA</option>
                                <option value="KE">KENYA</option>
                                <option value="UK">UK</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="banks">Select Bank</label>
                                <select name="banks" id="banks" class="form-control">
                                <option value="">Select Country First</option>
                                </select>
                            </div>
                        </div>       
                    </div>  
                    <div class="error settlement-form-error" id="settlement-form-error">
            
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" id="settlement-btn-submit" class="btn btn-jumga">Update</button>
                    </div>
                </form>
            </div>';
        }
    }

    // MERCHANT - RIDERS FORM 
    if (isset($_POST['ridersForm'])) {
        echo '
        <form class="riderForm" id="riderForm">
        
                <div class="form-group">
                    <select name="riderName" id="riderName" class="select form-control" >
                        <option value="" selected disabled>Select Rider</option>';
        $riderQuery = mysqli_query($conn, "SELECT * FROM rider WHERE status ='approved'");
        while ($row = mysqli_fetch_assoc($riderQuery)) {
            $rName = ucwords($row['company_name']); 
            $rId = $row['id'];
            echo "<option value='$rId'>$rName</option>";
        }
       
                
        echo '</select>
                </div>
                <div class="form-group show-info" id="show-info">
            
                </div>
            </form>
        ';
    }


    if (isset($_POST['riderCompanyRecord'])) {
        
        $query = mysqli_query($conn, "SELECT * FROM rider WHERE userid=$userid");
        if (!$query) {
            die(error(" FAILED TO VERIFY COMPANY INFORMATION ".mysqli_error($conn)));
        }else if(mysqli_num_rows($query) > 0){
            echo info("COMPANY DETAILS ALREADY EXIST");
        }else{
            echo '
                <div>
                <form class="rider-form" id="rider-form">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="company-name">Company Name</label>
                                <input type="text" class="form-control" placeholder="Company Name" id="company-name" required>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="address">Company Address </label>
                                <input type="text" placeholder="Company Address" class="form-control" id="company-address" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="number-of-fleet">Number of Fleet</label>
                                <input type="number" class="form-control" id="number-of-fleet" placeholder="Number of Fleets" required>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="company-phone">Company Phone</label>
                                <input type="number" class="company-phone form-control" id="company-phone" placeholder="Company Phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <div>
                                    <label for="document">Company Document (PDF Only)</label>
                                </div>
                                <input type="file" class="file" id="company-file" required>
                                
                            </div>
                        </div>
                        <div class="col-sm">
                            <div id="show-file-info"></div>
                        </div>
                    </div>
                
                    <div class="error company-form-error" id="company-form-error"></div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-jumga" id="btn-update">Update</button>
                    </div>


                </form>
            </div>

            
            ';

            
            } 
    }

    if (isset($_POST['riderSettlement'])) {
            $userid = $_SESSION['juId'];
        // CHECK FOR RIDER COMPANY INFOMATION 
            $query = mysqli_query($conn, "SELECT * FROM rider WHERE userid=$userid");
            if (!$query) {
                die(error(" FAILED TO VERIFY COMPANY INFORMATION ".mysqli_error($conn)));
            }else if(mysqli_num_rows($query) < 1){
                echo info("KINDLY FILLED YOUR COMPANY DETAILS BY CLICKING ON THE LINK ABOVE TO PROCEED");
            }else{
                    // CHECK FOR SETTLEMENT DETAILS 
                    $sa_id =  mysqli_fetch_assoc($query)['subaccount_id'];

                    if ($sa_id !== "") {
                       echo  "<span>SETTLEMENT DETAILS ALREADY EXIST</span>";
                    }else{
                        echo '          
                            <div class="settlement-container">
                                <form action="" class="settlement-form" id="settlement-form">
                                    <div class="row">
                                    <div class="col-sm">
                                    <div class="form-group">
                                            <label for="account-number" id="">Account Number</label>
                                            <input type="number" class="form-control" placeholder="Account Number" id="account-number" required>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="country">Country</label>
                                        <select name="country" id="country" class="form-control" required>
                        
                                            <option value="" selected disabled>Select Country</option>
                                            <option value="NG">NIGERIA</option>
                                            <option value="GH">GHANA</option>
                                            <option value="KE">KENYA</option>
                                            <option value="UK">UK</option>
                                        </select>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="banks">Select Bank</label>
                                            <select name="banks" id="banks" class="form-control" required>
                                            <option value="">Select Country First</option>
                                            </select>
                                        </div>
                                    </div>       
                                </div>  
                                <div class="error settlement-form-error" id="settlement-form-error">
                        
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" id="settlement-btn-submit" class="btn btn-jumga">Update</button>
                                </div>
                            </form>
                        </div>';
                }
            }
      


    }

    if (isset($_POST['merchantRiderInfo'])) {
       
        $riderId = $_POST['riderId'];
        $rQuery = mysqli_query($conn, "SELECT * FROM rider WHERE id=$riderId");
        $row = mysqli_fetch_assoc($rQuery);
      
        $cName = ucwords($row['company_name']);
        $cPhone = $row['company_phone'];
        $cAddress = ucwords($row['company_address']);
        $nFleet = $row['number_of_fleet'];

       echo "
            <table class='table'>
            <tr>
                <td>COMPANY NAME</td>
                <td>$cName</td>
            </tr>
            <tr>
                <td>COMPANY PHONE</td>
                <td>$cPhone</td>
            </tr>
            <tr>
                <td>ADDRESS</td>
                <td>$cAddress</td>
            </tr>
            <tr>
                <td>NO OF FLEETS</td>
                <td>$nFleet</td>
            </tr>
            <tr>
                <td>
                    <div id='riderForm-error'></div>
                </td>
                <td>
                    <div class='form-group text-right'>
                        <button type='submit' class='btn btn-jumga' id='btn-rider-merchant'>Add</button>
                    </div>
                </td>
            </tr>
        </table>
       ";

    }

       
?>
