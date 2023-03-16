<?php 
        if (isset($_GET['pid']) ) {
            $spId = $_GET['pid'];
            $product_query = mysqli_query($conn, "SELECT * FROM product WHERE id=$spId");
          if (!$product_query) {
           
              die(error("ERROR LOADING PRODUCTS"));
          }else if(mysqli_num_rows($product_query) > 0){
            $row = mysqli_fetch_assoc($product_query);
            $fPrice = number_format($row['price']);
            $price = $row['price'];
            $name = ucwords($row['name']);
            $description = $row['description'];
            $qty = 1;

            // SET THE PRODUCT CART SESSION 
              
              if (isset($_SESSION['cart'])) {
                // CHECK IF THE PRODUCT ALREADY EXIST IN THE ARRAY 
                if (!array_key_exists ($spId, $_SESSION['cart'])) {
                  $_SESSION['cart'][$spId] = $name;
                }
                 
              }else{
                // SET THE SESSION AND CREAT THE FIRST ARRAY 
                $_SESSION['cart'] = array($spId => $name);
              }

            // BRING ALL SESSION ITEMS 
              if (count($_SESSION['cart']) < 1) {
                exit();
              }
            echo "
            <form action='view/ridda/cartpay.php' >
            <table class='table table-responsive'>
            <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price (N) </th>
                        <th>Quantity</th>
                        <th>Total (N)</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
            ";
          foreach ($_SESSION['cart'] as $key => $value) {
               $pId = $key;
               $product_query = mysqli_query($conn, "SELECT * FROM product WHERE id=$pId");
            if (!$product_query) {
                die(error("ERROR LOADING PRODUCTS"));
            }else if(mysqli_num_rows($product_query) > 0){
                $row = mysqli_fetch_assoc($product_query);
              
                $fPrice = number_format($row['price']);
                $price = $row['price'];
                $name = ucwords($row['name']);
                $description = $row['description'];
                $image = $row['images'];
                $uId = $row['user_id'];
                $uIQuery = mysqli_query($conn, "SELECT * FROM users WHERE id=$uId");
                if (!$uIQuery) {
                    die("PUID FAILED ");
                }
                $phone = mysqli_fetch_assoc($uIQuery)['phone'];
              
                echo "
                              <tr>
                                  <td> <img src='./users/sydeestack_$phone/$image' alt='$name' class='img-checkout'> </td>
                                  <td>$name</td>
                                  <td> <input type='text' value='$fPrice' name='price' class='checkout-input-total' id='price-$pId' disabled></td>
                                  <td><input type='number' name='qty[]' value='1' class='checkout-input' id='qty-$pId' min='1'></td>
                                  <td><input type='text' value='Total' name='total' class='checkout-input-total' id='$pId' disabled></td>
                                  <td><a href='?p=cart&remove=$pId'>Remove</a></td>
                              </tr>
                             
                              <tr>";
              }
    
            }
    
                                   echo "
                                   <tr>
                                   <td colspan='5'>
                                       <div class='text-right'>
                                          Total <input type='number' value='' id='totalCartPrice' class='checkout-input-total'  disabled>
                                       </div>
                                   </td>
                               </tr>
                                   <td colspan='5'>
                                    <div class='form-group text-right'>
                                    <input type='submit' value='Checkout' class='btn btn-jumga'>
                                </div>
                                </td>
                              </tr>
                          </tbody>
                  </table>
                  
                </form>
                </div>
            ";
            

          }else{
              echo "PRODUCT NOT AVAILABLE AT THE MOMENT";
          }
        }else if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
          
            echo "
            <form action='view/ridda/cartpay.php'>
            <table class='table table-responsive'>
            <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price (N)</th>
                        <th>Quantity</th>
                        <th>Total (N)</th>
                        <th>Remove</td>
                    </tr>
                </thead>
                <tbody>
            ";
          foreach ($_SESSION['cart'] as $key => $value) {
               $pId = $key;
               $product_query = mysqli_query($conn, "SELECT * FROM product WHERE id=$pId");
            if (!$product_query) {
                die(error("ERROR LOADING PRODUCTS"));
                
            }else if(mysqli_num_rows($product_query) > 0){
              $row = mysqli_fetch_assoc($product_query);
            
              $fPrice = number_format($row['price']);
              $price = $row['price'];
              $name = ucwords($row['name']);
              $description = $row['description'];
              $image = $row['images'];
              $uId = $row['user_id'];
              $uIQuery = mysqli_query($conn, "SELECT * FROM users WHERE id=$uId");
              if (!$uIQuery) {
                  die("PUID FAILED ");
              }
              $phone = mysqli_fetch_assoc($uIQuery)['phone'];
            
              echo "
                            <tr>
                                <td> <img src='./users/sydeestack_$phone/$image' alt='$name' class='img-checkout'> </td>
                                <td>$name</td>
                                <td> <input type='text' value='$fPrice' name='price' class='checkout-input-total' id='price-$pId' disabled></td>
                                <td><input type='number' name='qty[]' value='1' class='checkout-input' id='qty-$pId' min='1'></td>
                                <td><input type='text' value='Total' name='total' class='checkout-input-total' id='$pId' disabled></td>
                                <td><a href='?p=cart&remove=$pId'>Remove</a></td>
                            </tr>
                           
                            <tr>";
            }
  
          }
  
                                 echo "
                                 <tr>
                                 <td colspan='5'>
                                     <div class='text-right'>
                                        Total <input type='number' value='' class='checkout-input-total' id='totalCartPrice' disabled>
                                     </div>
                                 </td>
                             </tr>
                                 <td colspan='5'>
                                  <div class='form-group text-right'>
                                  <input type='submit' value='Checkout' class='btn btn-jumga'>
                              </div>
                              </td>
                            </tr>
                        </tbody>
                </table>
                
              </form>
              </div>
          ";
        }


        // Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
      if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
        // Remove the product from the shopping cart
        unset($_SESSION['cart'][$_GET['remove']]);
        header('Location: ./index.php?p=cart');
}
?>
