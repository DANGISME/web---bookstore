<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Về chúng tôi</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Về chúng tôi</h3>
   <p> <a href="home.php">Trang chủ</a> / Về chúng tôi </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about_us.jpg" alt="">
      </div>

      <div class="content">
         <h3>Tại sao chọn chúng tôi?</h3>
         <p>Sản phẩm hoặc dịch vụ của chúng tôi mang lại giá trị gì cho khách hàng?</p>
         <p>Chúng tôi có các ưu đãi đặc biệt hoặc chương trình khuyến mãi nào cho khách hàng?</p>
         <p>Chúng tôi cam kết mang lại sự hài lòng cho khách hàng như thế nào?</p>
         <a href="contact.php" class="btn">Liên hệ với chúng tôi</a>
      </div>

   </div>

</section>



<section class="authors">

   <h1 class="title">Các tác giả tuyệt vời</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>?</h3>
      </div>

      <div class="box">
         <img src="images/avater.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Đặng Phương Đằng</h3>
      </div>

      <div class="box">
         <img src="images/" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>?</h3>
      </div>


  

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
