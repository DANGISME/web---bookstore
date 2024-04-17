<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit();
}

if (isset($_POST['update_cart'])) {
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   $update_query = "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'";
   if (mysqli_query($conn, $update_query)) {
     
   } else {
      die('Câu lệnh thất bại: ' . mysqli_error($conn));
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_query = "DELETE FROM `cart` WHERE id = '$delete_id'";
   if (mysqli_query($conn, $delete_query)) {
      header('location:cart.php');
      exit();
   } else {
      die('Câu lệnh thất bại: ' . mysqli_error($conn));
   }
}

if (isset($_GET['delete_all'])) {
   $delete_all_query = "DELETE FROM `cart` WHERE user_id = '$user_id'";
   if (mysqli_query($conn, $delete_all_query)) {
      header('location:cart.php');
      exit();
   } else {
      die('Câu lệnh thất bại: ' . mysqli_error($conn));
   }
}
?>

<!DOCTYPE html>
<html lang="vi">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Giỏ hàng</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
      <?php include 'header.php'; ?>

      <div class="heading">
         <h3>Giỏ hàng</h3>
         <p><a href="home.php">Trang chủ</a> / Giỏ hàng</p>
      </div>

      <section class="shopping-cart">
         <h1 class="title">Thêm sản phẩm</h1>
         <div class="box-container">
            <?php
            $grand_total = 0;
            $select_cart_query = "SELECT * FROM `cart` WHERE user_id = '$user_id'";
            $select_cart_result = mysqli_query($conn, $select_cart_query);
            if (mysqli_num_rows($select_cart_result) > 0) {
               while ($fetch_cart = mysqli_fetch_assoc($select_cart_result)) {
                  $sub_total = $fetch_cart['quantity'] * $fetch_cart['price'];
                  $grand_total += $sub_total;
                  ?>
                  <div class="box">
                     <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?');"></a>
                     <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                     <div class="name"><?php echo $fetch_cart['name']; ?></div>
                     <div class="price"><?php echo $fetch_cart['price']; ?>đ</div>
                     <form action="" method="post">
                        <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                        <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                        <input type="submit" name="update_cart" value="Cập nhật" class="option-btn">
                     </form>
                     <div class="sub-total">Tổng phụ: <span><?php echo $sub_total; ?>đ</span></div>
                  </div>
               <?php
               }
            } else {
               echo '<p class="empty">Giỏ hàng của bạn đang trống</p>';
            }
            ?>
         </div>
         <div style="margin-top: 2rem; text-align:center;">
            <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('Xóa tất cả sản phẩm khỏi giỏ hàng?');">Xóa tất cả</a>
         </div>
         <div class="cart-total">
            <p>Tổng cộng: <span><?php echo $grand_total; ?>đ</span></p>
            <div class="flex">
               <a href="shop.php" class="option-btn">Tiếp tục mua sắm</a>
               <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Thanh toán</a>
            </div>
         </div>
      </section>

      <?php include 'footer.php'; ?>

      <script src="js/script.js"></script>
   </body>
</html>
