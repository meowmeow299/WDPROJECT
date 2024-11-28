<?php

@include 'config.php';

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];
   $product_name = array();

   $cart_query = mysqli_query($connect, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
          $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
          // Calculate total price without number_format
          $product_price = $product_item['price'] * $product_item['quantity'];
          $price_total += $product_price;
      }
  }

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($connect, "INSERT INTO `orders`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      // Clear the cart after successful order placement
      $clear_cart_query = "DELETE FROM `cart`";
      $clear_cart_result = mysqli_query($connect, $clear_cart_query);
  
      if ($clear_cart_result) {
          // Cart cleared successfully
          echo "Cart cleared after successful payment.";
      } else {
          // Error occurred while clearing cart
          echo "Error clearing cart.";
      }
  
      // Display order success message
      echo "
      <div class='order-message-container'>
          <div class='message-container'>
              <h3>Thank you for shopping!</h3>
              <div class='order-detail'>
                  <span>".$total_product."</span>
                  <span class='total'> Total : RM".$price_total."  </span>
              </div>
              <div class='customer-details'>
                  <p> Your name: <span>".$name."</span> </p>
                  <p> Your number: <span>".$number."</span> </p>
                  <p> Your email: <span>".$email."</span> </p>
                  <p> Your address: <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
                  <p> Your payment mode: <span>".$method."</span> </p>
                  <p>(*Pay when product arrives*)</p>
              </div>
              <a href='productList.php' class='btn'>Continue shopping</a>
          </div>
      </div>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
   <?php
$select_cart = mysqli_query($connect, "SELECT * FROM `cart`");
$total = 0;
$grand_total = 0;
if(mysqli_num_rows($select_cart) > 0){
    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
        $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
        $grand_total += $total_price;
?>
<span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
<?php
    }
}else{
    echo "<div class='display-order'><span>your cart is empty!</span></div>";
}


?>
<span class="grand-total"> total : RM<?= $grand_total; ?> </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="tel" pattern="[0-9]{3}-[0-9]{7}" placeholder="e.g 019-5426076" name="number" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on devlivery</option>
               <option value="credit cart">credit cart</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. Cheras" name="city" required>
         </div>
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. Kuala Lumpur" name="state" required>
         </div>
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. Malaysia" name="country" required>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="script.js"></script>
   
</body>
</html>