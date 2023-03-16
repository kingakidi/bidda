<?php
       
        if (isset($_GET['p']) && isset($_GET['pid'])) {
                $spId = $_GET['pid'];   
                if (isset($_SESSION['juId'])) {

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
                
                        echo "<div class='container'>
                        <form id='singleCheckOutForm'>
                            <div >
                                <input type='text' id='price' value='$price' disabled hidden>
                            </div>
                                <table class='table table-responsive'>
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
                                        <tr>
                                            <td> <img src='./pics.png' alt='$name' class='img-checkout'> </td>
                                            <td>$name</td>
                                            <td>N $fPrice</td>
                                            <td><input type='number' value='1' class='checkout-input' id='qty' min='1'></td>
                                            <td><input type='text' value='Total' class='checkout-input-total' id='total' disabled></td>
                                            
                                        </tr>
                                        <tr>
                                        <td colspan='5'>
                                            <div class='form-group text-right'>
                                            <input type='submit' value='Checkout' class='btn btn-jumga'>
                                        </div>
                                        </td>
                                        </tr>
                                    </tbody>
                            </table>
                            
                        </form>
                        </div>";
                }else{
                    echo "PRODUCT NOT AVAILABLE AT THE MOMENT";
                }


            }else{
            echo '<div class="text-center text-info"><h4>YOUR SHOPPING CART IS EMPTY</h4></div>';
            }
        }
      

?>
