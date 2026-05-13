<?php
session_start();
include "db.php";
if(isset($_GET['remove'])){

    $key = $_GET['remove'];

    unset($_SESSION['cart'][$key]);

    header("Location: cart.php");
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $id;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
</head>
<body>

<h1>Shopping Cart</h1>

<?php

$total = 0;

if(isset($_SESSION['cart'])){

    foreach($_SESSION['cart'] as $key => $product_id){

        $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$product_id");

        $product = mysqli_fetch_assoc($result);

        $total += $product['price'];
?>

<div style="border:1px solid black;padding:10px;margin:10px;">

    <h3><?php echo $product['name']; ?></h3>

    <p>₹<?php echo $product['price']; ?></p>

    <img src="images/<?php echo $product['image']; ?>" width="150">
    <br><br>

<a href="cart.php?remove=<?php echo $key; ?>">
    <button>Remove</button>
</a>

</div>

<?php
    }
}
?>

<h2>Total: ₹<?php echo $total; ?></h2>

</body>
</html>