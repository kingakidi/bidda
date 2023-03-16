<?php 
    // print_r($_GET);
        if (isset($_GET['p']) && isset($_GET['i'])) {
            $pId = $_GET['i'];
           
                $product_query = mysqli_query($conn, "SELECT * FROM product WHERE id=$pId");
                if (!$product_query) {
                    die(error("ERROR LOADING PRODUCTS"));
                }else if(mysqli_num_rows($product_query) > 0){
                  $row = mysqli_fetch_assoc($product_query);
            
                  $price = number_format($row['price']);
                  $name = ucwords($row['name']);
                  $description = $row['description'];
                  $uId = $row['user_id'];
                  $image = $row['images'];
                  $product_type = $row['product_type'];


                  $uIQuery = mysqli_query($conn, "SELECT * FROM users WHERE id=$uId");
                  if (!$uIQuery) {
                      die("PUID FAILED ");
                  }
                  $phone = mysqli_fetch_assoc($uIQuery)['phone'];
                  echo "<div class='cart-item-more'>
                  <p class='cart-name'>$name</p>
                  <div class='cart-image'>
                      <img src='./users/sydeestack_$phone/$image' alt='$name' class=''>
                  </div>
                  <div class='description mt-2'>
                    <h5>Details</h5>
                    <p>$description</p>
                  </div>";

                  if ($product_type ==='merchant') {
                
                      echo "<div class='cart-item-checkout' id='cart-item-checkout'>
                    
                      <div class='add-to-cart' id='add-to-cart'>
                        <a href='?p=cart&pid=$pId' class='btn btn-info btn-add-to-cart' name='btn-add-to-cart' id='$pId'>Add to Cart</a>
                      </div>
                      <div class='checkout' id='checkout'>
                        <a href='?p=cart&pid=$pId' class='btn btn-success btn-checkout' name='' id=''>View Cart</a>
                      </div>
                      <div>
                        <button class='btn btn-outline-dark' name='btn-like' id='$pId'><i class='fa fa-heart-o' aria-hidden='true'></i></button>
                      </div>
                  </div>
              </div>";
               }else{?>

                
                
            <!-- CHECK IF THE PRODUCT IS WON OR CLOSED  -->

            <div class="mt-2" >
              <?php if(isset($_SESSION['juId'])){ ?>
                <div class="" v-if="!isBidded">
                  <div class="" >
                    <input type="hidden" ref="start_amount" value="<?php  echo $price; ?>">
                    <input type="hidden" ref="product_id" value="<?php  echo $pId; ?>">
                    <input type="number" v-model="bid_amount" value  class="form-control" placeholder="Enter bidding amount min of <?php  echo $price; ?>">
                  
                    </div>
                        <button class="btn btn-jumga form-control mt-2" @click="submitBid()"> 
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-if="show_loader"></span> 
                          <span v-if="!show_loader"> Submit Bid </span>
                      </button>
                    </div>

                   
                    <div class="mt-2 bg-blue-700 text-white p-3 rounded" v-else="isBidded">
                        <span >You have bid <strong> N {{bid_object.amount}}</strong> for this product</span>
                    </div>

                    <div v-html="show_status" class="mb-5"></div>
                    <?php
                    }else{
                      echo '<a href="./login.php" class="btn btn-jumga form-control" > 
                              <span > Login to place bid </span>
                            </a>';
                    } ?>
                     
                  </div>
               

               
                <?php
               }
            }
        }
      
