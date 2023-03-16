# jumga
Jumga E-commerce using flutterwave payment api
Regiter an account @ root/signup.php
  if account type is merchant show merchant fees of 2000 Naira payment button. 
  upon successful verification of fees paid, show login page. 
  if not paid, user will be allow to login to await activation button on the dashboard, for the fees if merchant 
MERCHANT HAS ACCESS TO 
  PROFILE PAGE: MERCHANT is expected to complete his merchant profiles details before granted to use product page links.
  Actions like, entering his Business details, settlement account (on this, i used your flutterwave api features of subaccount for Merchants and Riders, at the ration of 10%, 15% to JUMGA);
  Merchant are expected to assign to themself from list of approved riders, before the his store can be granted the ability to add store products.
  
  PRODUCT PAGE which container links to (View his products, add products, view his sales)
  
  RIDER PAGE 
    Just like Merchant, they are expected to complete their rider page, before they can be granted the approval.
  HOME PAGE (Index)
    items are display base on category generate by the admin, 
    the add to cart features are base on session veriables, 
  ON CHECKOUT 
    All subaccounts of the cart items are selected and set on array of objects as requied by your Api using flat_account and charge parameter
    the % deduction are made on each of the items before sending. 
   
   IN CASE 
   in a cart item has different store which as every store has his riders. 
   the first store Rider is choosen. when cart has more than one item from different store the delivering fees is top up by 1000 Naira.
   Upon successfully payment and verification the data of transaction are input into the database, which will show up on the parties (The custormer, merchant, rider) page. 
   a function of this project will be hosted at jumga.sydeestack.com to makes it easy for your accessment. 
   Thanks for the opportunity
