<?php
                $cQuery = mysqli_query($conn, "SELECT * FROM category WHERE category.status ='approve'");
                if (!$cQuery) {
                    die(error("Category Fails"));
                }else if(mysqli_num_rows($cQuery) < 1){
                    echo "<option value=''>NO CATEGORY</option>";
                }else{

                    while ($row = mysqli_fetch_assoc($cQuery)) {
                        $title = ucwords($row['title']);
                        $id = $row['id'];
                        $title = $row['title'];
                        
                        // FETCH PRODUCTS 
                        
                        $product_query = mysqli_query($conn, "SELECT * FROM product WHERE category_id=$id");
                        $numRow = mysqli_num_rows($product_query);
                       
                        if (!$product_query) {
                            die(error("ERROR LOADING PRODUCTS"));

                        }else if($numRow > 0){
                            echo '<div class="cart-category" id="category-id">';
                            // echo "<h3>$title</h3>";
                            while ($row = mysqli_fetch_assoc($product_query)) {
                                $p_id = $row['id'];
                                $price = number_format($row['price']);
                                $name = ucwords($row['name']);
                                $image = $row['images'];
                                $uId = $row['user_id'];

                                $product_type = ucwords($row['product_type']);
                               
                                
                                if(strtolower($product_type) === 'bidda'){
                                    $bidda_check_query  = mysqli_query($conn, "SELECT * FROM bids WHERE product_id = $p_id AND bids.status = 'win'"); 

                                   
                                    if($bidda_check_query){
                                        $row = mysqli_num_rows($bidda_check_query); 
                                        
                                        $is_won = $row > 0 ? true : false;
                                    }
                                }
                                // check if the product is wind already 
                              
                                $uIQuery = mysqli_query($conn, "SELECT * FROM users WHERE id=$uId");
                                if (!$uIQuery) {
                                    die("PUID FAILED ");
                                }
                                $p = mysqli_fetch_assoc($uIQuery)['phone'];
                            
                                echo "<div class='cart-item'>
                                <div class='d-flex flex-row-reverse m-2'> <span class='product-tag'> $product_type</span></div>
                                <p class='cart-name'><strong>$name  </strong></p>
                                <div class='cart-image'>
                                    <img src='./users/sydeestack_$p/$image' alt='' class=''>
                                </div>
                                
                                <div class='cart-item-details'>
                                    <div class='price'>N $price</div>
                                    <div class='title'></div>

                                    ";
                                    if(strtolower($product_type) === 'bidda'){
                                        $bidda_check_query  = mysqli_query($conn, "SELECT * FROM bids WHERE product_id = $p_id AND bids.status = 'win'"); 
    
                                       
                                        if($bidda_check_query){
                                            $row = mysqli_num_rows($bidda_check_query); 
                                            
                                            if($row > 0){
                                                echo "<div class='rounded flex justify-center items-center p-2  bg-red-500 text-white'><a name='more'>BID WON</a></div>";
                                            }else{
                                                echo "<div class='more'><a href='?p=more&i=$p_id' id='$p_id' name='more'>More</a></div>";
                                            }
                                        }
                                    }else{
                                        echo "<div class='more'><a href='?p=more&i=$p_id' id='$p_id' name='more'>More</a></div>";
                                    }
                                 echo  "
                                    
                                </div>
                            </div>";

                            }
                            echo '</div>';
                        }   
                    }   
                }
            ?>