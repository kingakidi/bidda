<?php include './control/conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDDA</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="./index.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
    @layer utilities {
      .btn {
        background-color: #8d078e;
      }
    }
  </style>
</head>
<body>


    <div class="main-container" id="wrapper">
        <nav>
           
            <div class="link">
                <button class="btn m-2">
                    <span>
                        <a href="index.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Home</a>
                     </span>
                </button>
                <button class="btn m-2" id="btn-show-cart-number">  
                    <span >
                        <a href="?p=cart" id="link-show-cart-number"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> My Cart
                        
                        <?php
                            if (isset($_SESSION['cart'])) {
                                $cartCount = count($_SESSION['cart']);
                                echo "<span id='show-cart-number'> $cartCount </span></a>";
                            }else{
                                echo '<span id="show-cart-number"></span></a> ';
                            }
                        ?>
                        
                    </span>
                </button>
                <?php
                    if (isset($_SESSION['juId'])) {
                        echo '
                        <button class="btn m-2">
                
                        <span>
                            <a href="./dashboard/?p=purchase"><i class="fa fa-truck" aria-hidden="true"></i>  Orders</a>
                        </span>
                    </button>
                    <button class="btn m-2">
                    <span>
                     <a href="./signup.php"><i class="fa fa-money" aria-hidden="true"></i> Sell Or Bid on Ridda</a>
                        </span>
                    </button>
                   ';
                    }

                ?>
                
            </div>
            <div class="action">
            <?php
                if (isset($_SESSION['juId'])) {
                   echo ' <a href="./dashboard/" class="btn m-2"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>';
                }else{
                    echo '
                    <a href="./login.php" class="btn m-2"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                    <a href="./signup.php" class="btn m-2"><i class="fa fa-user" aria-hidden="true"></i> Create Account</a>
                    ';
                }
            
            ?>
               
            </div>
        </nav>
      
        <div class="content">
           <div class="sidebar">
                <!-- SELECT * CATEGORY -->
                <?php
                $cQuery = mysqli_query($conn, "SELECT * FROM category WHERE category.status ='approve'");
                // print_r(mysqli_fetch_assoc($cQuery));
                if (!$cQuery) {
                    die(error("Category Fails"));
                }else if(mysqli_num_rows($cQuery) < 1){
                    echo "<option value=''>NO CATEGORY</option>";
                }else{
                    
                    while ($row = mysqli_fetch_assoc($cQuery)) {
                        $title = ucwords($row['title']);
                        $id = $row['id'];
                        $title = ucwords($row['title']);
                        echo "<div class='category-link-container pl-2'>$title</div>";

                }
            }
                ?>
           </div>
           <div class="product" >
                <div class="cart" id="cart">
                    <?php

                        
                        if (isset($_GET['p'])) {

                            $p = $_GET['p'];
                            switch ($p) {
                                case 'more':
                                    include "./view/ridda/more.php";
                                    break;
                                case 'checkout':
                                    include "./view/ridda/checkout.php";
                                    break;
                                case 'cart':
                                    include "./view/ridda/cart.php";
                                    break;
                                default:
                                include "./view/ridda/home.php";
                                    break;
                            }                            
                        }else {
                            include "./view/ridda/home.php";
                        }

                        
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL PAGE  -->
    <div class="popup-page" id="popup-page">
        <div class="popup-content" id="popup-content">
            <div class="popup-close text-right">
                <button id="btn-popup-close" class="btn-popup-close btn"><i class="fa fa-window-close" aria-hidden="true"></i></button>
            </div>
           
            <div class="popup-show" id="popup-show">
                
            </div>
        </div>
    </div>

   
       
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js" ></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    
    <script src="./vendor/jquery/jquery.js"></script>
    <script src="./js/sydeestack.js"></script>
    <?php
        if (isset($_GET['p'])) {
            $p = $_GET['p'];
            echo "<script src='./js/$p.js'></script>";
        }
    ?>

   

</body>
</html>