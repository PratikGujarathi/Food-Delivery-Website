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
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
 
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
    $select_user->execute([$email, $number]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
 
    if($select_user->rowCount() > 0){
       $message[] = 'email or number already exists!';
    }else{
       if($pass != $cpass){
          $message[] = 'confirm password not matched!';
       }else{
          $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
          $insert_user->execute([$name, $email, $number, $cpass]);
          $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
          $select_user->execute([$email, $pass]);
          $row = $select_user->fetch(PDO::FETCH_ASSOC);
          if($select_user->rowCount() > 0){
             $_SESSION['user_id'] = $row['id'];
             header('location:home.php');
          }
       }
    }
 
 }
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

     <!-- custome css file link -->
      <link rel="stylesheet" href="css/style.css">

</head>
<body>
 
<!-- header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->


<!-- Register section starts -->

<section class="form-container">
    <form action="" method="post">
        <h3>Register Now</h3>
        <input type="text" name="name" placeholder="Enter Your Name" maxlength="50" class="box" required>
        <input type="email" name="email" placeholder="Enter Your Email" maxlength="50" class="box" required>
        <input type="number" name="number" placeholder="Enter Your Number" max="9999999999" min="0" maxlength="10" class="box" required>
        <input type="password" name="pass" placeholder="Enter Your Password" maxlength="50" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="cpass" placeholder="Conform Your Password" maxlength="50" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="register now" name="submit" class="btn">
        <p>Already Have An Account? <a href="login.php">Login Now</a></p>
    </form>
</section>
<!-- Register section ends -->
















<!-- footer section starts -->

<?php include 'components/footer.php';?>
<!-- footer section ends -->



<!-- custome js file link -->
 <script src="js/script.js"></script>

</body>
</html>