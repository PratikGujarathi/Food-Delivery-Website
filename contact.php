<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $msg = $_POST['message'];
    $msg = filter_var($msg, FILTER_SANITIZE_STRING);

    $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
    $select_message->execute([$name, $email, $number, $msg]);

    if($select_message->rowCount() > 0){
        $message[] = 'Message Sent Already!';
    }else{
        $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
        $insert_message->execute([$user_id, $name, $email, $number, $msg]);
        $message[] = 'Message Sent Successfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

     <!-- custome css file link -->
      <link rel="stylesheet" href="css/style.css">

</head>
<body>
 
<!-- header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
    <h3>Contact Us</h3>
    <p>Contact / <a href="home.php">Home</a></p>
</div>

<!-- Contact section starts -->

<section class="contact">
    <div class="row">
        <div class="image">
            <img src="images/contact-img.svg" alt="">
        </div>
        <form action="" method="POST">
            <h3>Tell Us Something!</h3>
            <input type="text" required placeholder="Enter Your Name" maxlength="50" name="name" class="box">
            <input type="email" required placeholder="Enter Your Email" maxlength="50" name="email" class="box">
            <input type="number" required placeholder="Enter Your Number" maxlength="10" min="0" max="9999999999" name="number" class="box">
            <textarea name="message" class="box" required rows="10" cols="30" maxlength="500" placeholder="Enter Your Message"></textarea>
            <input type="submit" value="Send Message" class="btn" name="submit">
        </form>
    </div>
</section>

 <!-- Contact section ends -->















<!-- footer section starts -->

<?php include 'components/footer.php';?>
<!-- footer section ends -->



<!-- custome js file link -->
 <script src="js/script.js"></script>

</body>
</html>