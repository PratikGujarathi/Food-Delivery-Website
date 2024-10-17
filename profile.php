<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

     <!-- custome css file link -->
      <link rel="stylesheet" href="css/style.css">

</head>
<body>
 
<!-- header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<!-- profile section starts -->
<section class="user-profile">
    <div class="box">
        <img src="images/user-icon.png" alt="">
        <p><i class="fas fa-user"></i><span><?= $fetch_profile['name']; ?></span></p>
        <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
        <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
        <a href="update_profile.php" class="btn">Update Info</a>
        <p><i class="fas fa-map-marker-alt"></i><span><?php if($fetch_profile['address'] == ''){echo 'please enter your address';}else{echo $fetch_profile['address'];};?></span></p>
        <a href="update_address.php" class="btn">Update Address</a>

    </div>
</section>

<!-- profile section ends -->

















<!-- footer section starts -->

<?php include 'components/footer.php';?>
<!-- footer section ends -->



<!-- custome js file link -->
 <script src="js/script.js"></script>

</body>
</html>