<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>


<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="dashboard.php">home</a>
         <a href="products.php">products</a>
         <a href="placed_orders.php">orders</a>
         <a href="admin_accounts.php">admins</a>
         <a href="users_accounts.php">users</a>
         <a href="messages.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
                  <p>admin</p>
         <a href="update_profile.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">login</a>
            <a href="register_admin.php" class="option-btn">register</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>

   </section>

</header>
<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
      <h3>welcome!</h3>
      <p>admin</p>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>

   <div class="box">
            <h3><span>₹</span>21<span>/-</span></h3>
      <p>total pendings</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <div class="box">
            <h3><span>₹</span>7<span>/-</span></h3>
      <p>total completes</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <div class="box">
            <h3>4</h3>
      <p>total orders</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <div class="box">
            <h3>9</h3>
      <p>products added</p>
      <a href="products.php" class="btn">see products</a>
   </div>

   <div class="box">
            <h3>9</h3>
      <p>users accounts</p>
      <a href="users_accounts.php" class="btn">see users</a>
   </div>

   <div class="box">
            <h3>1</h3>
      <p>admins</p>
      <a href="admin_accounts.php" class="btn">see admins</a>
   </div>

   <div class="box">
            <h3>3</h3>
      <p>new messages</p>
      <a href="messages.php" class="btn">see messages</a>
   </div>

   </div>

</section>

<!-- admin dashboard section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>