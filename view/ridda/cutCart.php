<?php 
    if (isset($_GET['p']) && isset($_GET['pid'])) {
            // ADD TO CART AND SHOW CART 
            echo "adding to cart";

        }else if (isset($GET['p']) && count($_SESSION['cart']) > 0) {
            // BRING ALL USER CART ITEMS 
            echo "
  
            <table class='table'>
            <thead>
                    <tr>
                        <td>Image</td>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
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
              $qty = 1;
              echo "
                            <tr>
                                <td> <img src='./pics.png' alt='$name' class='img-checkout'> </td>
                                <td>$name</td>
                                <td>N $fPrice</td>
                                <td><input type='number' value='1' class='checkout-input' id='qty' min='1'></td>
                                <td><input type='text' value='Total' class='checkout-input-total' id='total' disabled></td>
                                
                            </tr>
                            <tr>";
            }
  
          }
  
                                 echo "<td colspan='5'>
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
    ?>