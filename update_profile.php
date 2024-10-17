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
    $name = $_POST['name'];
    $name = filter_var($name,FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email,FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number,FILTER_SANITIZE_STRING);

    if(!empty($name)){
        $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
        $update_name->execute([$name,$user_id]);
        $message[] = 'Username Updated';
    }
    if(!empty($email)){
        $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_email->execute([$email]);
        if($select_email->rowCount() > 0){
            $message[] = 'Email Already Taken!';
        }else{
            $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
            $update_email->execute([$email,$user_id]);
            $message[] = 'email Updated';
        }
    }
    if(!empty($number)){
        $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ?");
        $select_number->execute([$number]);
        if($select_number->rowCount() > 0){
            $message[] = 'number Already Taken!';
        }else{
            $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
            $update_number->execute([$number,$user_id]);
            $message[] = 'number Updated';
        }
    }

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
    $select_prev_pass->execute([$user_id]);
    $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['password'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = sha1($_POST['confirm_pass']);
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);
    
    if($old_pass != $empty_pass){
        if($old_pass != $prev_pass){
           $message[] = 'old password not matched!';
        }elseif($new_pass != $confirm_pass){
           $message[] = 'confirm password not matched!';
        }else{
           if($new_pass != $empty_pass){
              $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
              $update_pass->execute([$confirm_pass, $user_id]);
              $message[] = 'password updated successfully!';
           }else{
              $message[] = 'please enter a new password!';
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
    <title>Update Profile</title>

    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

     <!-- custome css file link -->
      <link rel="stylesheet" href="css/style.css">

</head>
<body>
 
<!-- header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->


<!-- Update Profile section starts -->

<section class="form-container">
    <form action="" method="POST">
        <h3>Update Profile</h3>
        <input type="text" name="name" class="box" placeholder="<?= $fetch_profile['name']; ?>" maxlength="50" id="">
        <input type="email" name="email" class="box" placeholder="<?= $fetch_profile['email']; ?>" maxlength="50" id="">
        <input type="number" name="number" class="box" placeholder="<?= $fetch_profile['number']; ?>" max="9999999999" min="0" maxlength="10" id="">
        <input type="password" class="box" name="old_pass" maxlength="50" oninput="this.value = this.value.replace(/\s/g,'')" placeholder="Enter Old Password">
        <input type="password" class="box" name="new_pass" maxlength="50" oninput="this.value = this.value.replace(/\s/g,'')" placeholder="Enter New Password">
        <input type="password" class="box" name="confirm_pass" maxlength="50" oninput="this.value = this.value.replace(/\s/g,'')" placeholder="Confirm New Password">
        <input type="submit" value="update now" name="submit" class="btn">
    </form>
</section>



<!-- Update Profile section ends -->
















<!-- footer section starts -->

<?php include 'components/footer.php';?>
<!-- footer section ends -->



<!-- custome js file link -->
 <script src="js/script.js"></script>

</body>
</html>