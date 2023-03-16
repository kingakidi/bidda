<?php 
    $userid = $_SESSION['juId'];
    function truncate($text, $chars = 25) {
        if (strlen($text) <= $chars) {
            return $text;
        }
        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text."...";
        return $text;
    }
    // CHECK IF MERCHANT PROFILE IS FILLED 
   if ($_SESSION['juType'] === 'merchant') {
    $userid = $_SESSION['juId'];
    $mrQuery = mysqli_query($conn, "SELECT * FROM `merchant_riders` JOIN profile ON merchant_riders.merchant_id = profile.id WHERE profile.userid=$userid");
    if (!$mrQuery) {
        die("FAILED TO VERIFY ".mysqli_error($mrQuery));
    }

    if (mysqli_num_rows($mrQuery) < 1) {
        echo '<p class="text-center text-info">Click <a href="?p=profile" class="btn">here</a> to complete your Merchant Profile to View this page</p>';
        exit();
    }
   }

?>

<div class="item" id="item">
    
    <div class="item-link-container" id="item-link-container">
        <div>
            <a href="?p=product" class="item-link" name="p-link" id="myproducts">My Products</a>
        </div>

        <?php
            if ($_SESSION['juType'] === 'admin') {
                echo '
                    <div>
                        <a class="item-link" name="p-link" id="allproducts">All Products</a>
                    </div>
                ';
            }
        ?>
       
        <div>
            <a class="item-link" name="p-link" id="addproducts">Add Products</a>
        </div>
        <div>
            <a class="item-link" name="p-link" id="sales">Sales</a>
        </div>
        <div>
            <a class="item-link" name="p-link" id="pending">Pendings</a>
        </div>
    </div>
    <div class="show-item mt-3" id="show-item">
    <?php
        $aPQuery = mysqli_query($conn, "SELECT * FROM product WHERE user_id=$userid ORDER BY date DESC");
                if (!$aPQuery) {
                    die(("PRODUCT FETCH FAILS ".mysqli_error($conn)));
                }else if(mysqli_num_rows($aPQuery) < 1){
                    echo ("<h2 class='m-3'>NO PRODUCT UPLOADED</h2>");
                }else{
        ?>
        <table class="table table-bordered table-responsive table-striped table-hover">
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
            

            ?>
    </div>
</div>