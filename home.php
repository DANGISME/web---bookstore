<?php

include 'config.php';
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang chủ</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

<div class="content">
      <h3>Tiết kiệm lên đến 75%</h3>
      <p>Bộ công cụ tính phần trăm giảm giá của chúng tôi sẽ giúp bạn xác định bạn sẽ tiết kiệm bao nhiêu trong một cuộc khuyến mại, khi toàn bộ sản phẩm được giảm giá "X phần trăm!".
          Đọc tiếp nếu bạn không biết cách tính phần trăm, bộ công cụ này chắc chắn sẽ giúp bạn tránh rất nhiều rắc rối.</p>
      <a href="shop.php" class="white-btn">Mua ngay</a>
   </div>
   <div class="img">
            <img src="images/economic.jpg" alt="">
        </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
