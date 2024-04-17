<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit();
}

if (isset($_POST['order_btn'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'Căn hộ số ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_codes']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products = array();

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Lỗi truy vấn');
   if (mysqli_num_rows($cart_query) > 0) {
      while ($cart_item = mysqli_fetch_assoc($cart_query)) {
         $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
         $sub_total = $cart_item['price'] * $cart_item['quantity'];
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ', $cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('Lỗi truy vấn');

   if ($cart_total == 0) {
      $message[] = 'Giỏ hàng của bạn đang trống';
   } else {
      if (mysqli_num_rows($order_query) > 0) {
         
      } else {
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('Lỗi truy vấn');
        
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Lỗi truy vấn');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thanh toán</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Thanh toán</h3>
   <p> <a href="home.php">Trang chủ</a> / Thanh toán </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('Lỗi truy vấn');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo ''.$fetch_cart['price'].'đ/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Giỏ hàng của bạn đang trống</p>';
   }
   ?>
   <div class="grand-total"> Tổng cộng : <span><?php echo $grand_total; ?>đ</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Đặt hàng</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Nhập tên :</span>
            <input type="text" name="name" required placeholder="Nhập họ tên của bạn">
         </div>
         <div class="inputBox">
            <span>Nhập số điện thoại :</span>
            <input type="number" name="number" required placeholder="Nhập số điện thoại của bạn">
         </div>
         <div class="inputBox">
            <span>Nhập email :</span>
            <input type="email" name="email" required placeholder="Nhập email của bạn">
         </div>
         <div class="inputBox">
            <span>Phương thức thanh toán :</span>
            <select name="method">
               <option value="cash on delivery">Thanh toán khi giao hàng</option>
               <option value="credit card">Thẻ tín dụng</option>
               <option value="paypal">PayPal</option>
               <option value="paytm">Thanh toán ATM</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Nhập địa chỉ :</span>
            <input type="number" min="0" name="flat" required placeholder="Số nhà">
         </div>
         <div class="inputBox">
            <span>Nhập tên đường :</span>
            <input type="text" name="street" required placeholder="Tên đường">
         </div>
         <div class="inputBox">
            <span>Thành phố :</span>
            <input type="text" name="city" required placeholder="Thành phố">
         </div>
         <div class="inputBox">
            <span>Khu vực :</span>
            <input type="text" name="state" required placeholder="Khu vực">
         </div>
         <div class="inputBox">
            <span>Đất Nước :</span>
            <input type="text" name="country" required placeholder="Đất nước">
         </div>
         <div class="inputBox">
            <span>Mã bưu điện :</span>
            <input type="number" min="0" name="pin_codes" required placeholder="Mã bưu điện">
         </div>
      </div>
      <input type="submit" value="Đặt hàng" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
