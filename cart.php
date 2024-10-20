<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
}
if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id , FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->execute([$qty , $cart_id]);
    $message[] = 'Cart Quantity Updated!';
}

if(isset($_POST['delete_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id , FILTER_SANITIZE_STRING);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart->execute([$cart_id]);
    $message[] = 'Cart Item Deleted!';
}
if(isset($_POST['delete_all'])){
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$user_id]);
    $message[] = 'Cart Deleted!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

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
    <h3>Shopping Cart</h3>
    <p>Cart / <a href="home.php">Home</a></p>
</div>

<!-- cart section starts -->

<section class="products">
    <h1 class="title">Your Cart</h1>

    <div class="box-container">
        <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
                while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){   
        ?>
        <form action="" method="POST" class="box">
            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
            <a href="quick_view.php?pid=<?= $fetch_cart['pid'] ?>" class="fas fa-eye"></a>
            <button type="submit" name="delete_cart" class="fas fa-times" onclick="return confirm('Sure To Delete Item From Cart??');"></button>
            <img src="uploaded_img/<?= $fetch_cart['image'] ?>" class="image" alt="">
            <div class="name"><?= $fetch_cart['name'] ?></div>
            <div class="flex">
                <div class="price"><span>₹</span><?= $fetch_cart['price']; ?></div>
                <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                <button type="submit" name="update_qty" class="fas fa-edit"></button>
            </div>
            <div class="sub-total">Sub Total : <span>₹<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span></div>
        </form>
        <?php
            $grand_total += $sub_total;
            }
        }else{
            echo '<p class="empty">Your Cart Is Empty</p>';
        }
        ?>
    </div>
    <div class="cart-total">
        <p class="grand-total">grand-total : <span>₹<?= $grand_total; ?></span></p>
        <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled' ?>">Proceed To Checkout</a>
    </div>
    <div class="more-btn">
        <form action="" method="POST">
            <button type="submit" class="delete-btn" name="delete_all" onclick="return confirm('Sure To Delete All Items From Cart??');">DELETE ALL</button>
        </form>
    </div>
</section>

<!-- cart section ends -->



















<!-- footer section starts -->

<?php include 'components/footer.php';?>
<!-- footer section ends -->



<!-- custome js file link -->
 <script src="js/script.js"></script>

</body>
</html>