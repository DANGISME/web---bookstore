<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">Book Store Online</a>
         

         <nav class="navbar">
            <a href="home.php">Trang chủ</a>
            <a href="shop.php">Sản phẩm</a>
            <a href="orders.php">Đơn hàng</a>
            <a href="about.php">Về chúng tôi</a>
            <a href="contact.php">Liên hệ</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span></span> </a>
         </div>

         <div class="user-box">
            <p>Tên : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">Đăng xuất</a>
         </div>
      </div>
   </div>

</header>
