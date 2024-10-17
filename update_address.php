<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
}
if(isset($_POST['submit'])){
    $address = $_POST['flat'] .', '.$_POST['building'].', '.$_POST['area'].', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    $update_address = $conn->prepare("UPDATE `users` SET address = ? WHERE id = ?");
    $update_address->execute([$address,$user_id]);

    $message[] = 'address updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Address</title>

    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

     <!-- custome css file link -->
      <link rel="stylesheet" href="css/style.css">

</head>
<body>
 
<!-- header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<!-- Update address section starts  -->

<section class="form-container">
    <form action="" method="POST">
        <h3>Address</h3>
        <input type="text" name="flat" maxlength="50" required placeholder="Flat No." class="box">
        <input type="text" name="building" maxlength="50" required placeholder="Building No." class="box">
        <input type="text" name="area" maxlength="50" required placeholder="Area" class="box">
        <input type="text" name="city" maxlength="50" required placeholder="City" class="box">
        <input type="text" name="state" maxlength="50" required placeholder="State" class="box">
        <input type="text" name="country" maxlength="50" required placeholder="Country" class="box">
        <input type="number" name="pin_code" required class="box" placeholder="Enter PIN CODE" maxlength="6" min="0" max="999999">
        <input type="submit" value="save address" name="submit" class="btn">
    </form>
</section>

<!-- Update address section ends  -->
















<!-- footer section starts -->

<?php include 'components/footer.php';?>
<!-- footer section ends -->



<!-- custome js file link -->
 <script src="js/script.js"></script>

</body>
</html>