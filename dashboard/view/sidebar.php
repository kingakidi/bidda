<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="">RIDDA </div>
</a>

<?php 
     if ($_SESSION['juType'] === 'merchant') {
         $uId = $_SESSION['juId'];
       $mQuery = mysqli_query($conn, "SELECT transaction_code FROM users WHERE id =$uId");
       $tCode = mysqli_fetch_assoc($mQuery)['transaction_code'];
       if ($tCode === 'null' || $tCode === "") {
           $e = $_SESSION['juEmail'];
           $fn = $_SESSION['juFullname'];
           $t_ref = $uId."_merchant_activation_fees";
           $p = $_SESSION['juPhone'];
           echo " 
           
           <!-- Divider -->
          
           <li class='text-center'>
          
           <form method='POST' action='https://checkout.flutterwave.com/v3/hosted/pay'>
            <input type='hidden' name='public_key' value='$tPublic' />
            <input type='hidden' name='customer[email]' value='$e' />
            <input type='hidden' name='customer[phone_number]' value='$p' />
            <input type='hidden' name='customer[name]' value='$fn' />
            <input type='hidden' name='tx_ref' value='$t_ref' />
            <input type='hidden' name='amount' value='2000' />
            <input type='hidden' name='currency' value='NGN' />
            <input type='hidden' name='meta[token]' value='54' />
            <input type='hidden' name='redirect_url' value='http://localhost/ridda/pay.php' />
            
            <button type='submit' class='btn btn-light'>Activate</button> 
          </form>
        
          </li>
          
           ";
           echo '
           <!-- Divider -->
           <hr class="sidebar-divider">
           <!-- Nav Item - Pages Collapse Menu -->
           <li class="nav-item">
               <a class="nav-link collapsed" href="?p=logout"  >
               <i class="fa fa-cog" aria-hidden="true"></i>
                   <span>Logout</span>
               </a>
           </li>
           ';
           exit();
       }else{

       }
    }
?>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="?p=index">
    <i class="fa fa-home" aria-hidden="true"></i>
        <span>Home</span></a>
</li>

<?php
    if ($_SESSION['juType'] !== 'user' || $_SESSION['juType'] !== 'rider') {?>
      
   
        <hr class="sidebar-divider">
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="?p=profile"  >
            <i class="fa fa-user" aria-hidden="true"></i>
                <span>Merchant Profile</span>
            </a>
        </li>

        <hr class="sidebar-divider">
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="?p=bids"  >
            <i class="fa fa-user" aria-hidden="true"></i>
                <span>Bids</span>
            </a>
        </li>
        
  <?php  }

?>

<!-- Divider -->
<hr class="sidebar-divider">
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="?p=purchase"  >
    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
        <span>My Purchase</span>
    </a>
</li>
<!-- Divider -->



<?php
    if ($_SESSION['juType'] !== 'user' || $_SESSION['juType'] !== 'rider') {
        echo '
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="?p=product"  >
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span>Products</span>
            </a>
        </li>
        
        ';
    }

    // SHOW RIDER FOR RIDER AND ADMIN 
    if ($_SESSION['juType'] === 'rider' || $_SESSION['juType'] === 'admin') {
       
        echo '
            <hr class="sidebar-divider">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="?p=rider"  >
                <i class="fa fa-truck" aria-hidden="true"></i>
                    <span>Riders</span>
                </a>
            </li>
        ';
    }

?>



<?php 

    if ($_SESSION['juType'] === 'admin') {
       echo '
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="?p=category"  >
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span>Category</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="?p=users"  >
                <i class="fa fa-users" aria-hidden="true"></i>
                    <span>User Manager</span>
                </a>
            </li>
       ';
    }
?>

<!-- Divider -->
<!-- <hr class="sidebar-divider"> -->
<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="?p=settings"  >
    <i class="fa fa-cog" aria-hidden="true"></i>
        <span>Settings</span>
    </a>
</li> -->

<!-- Divider -->
<hr class="sidebar-divider">
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="?p=logout"  >
    <i class="fa fa-sign-out" aria-hidden="true"></i>
        <span>Logout</span>
    </a>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle">
   
    </button>
</div>


</ul>