<?php
session_start();
include "db.php";

// PLACE ORDER
if(isset($_POST['place_order'])){

    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

        unset($_SESSION['cart']);

        $message = "🎉 Order Placed Successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>

<h1>Checkout Page</h1>

<?php
if(isset($message)){
    echo "<h3 style='color:green;'>$message</h3>";
}

$total = 0;

if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

    foreach($_SESSION['cart'] as $product_id => $quantity){

        $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$product_id");

        $product = mysqli_fetch_assoc($result);

        $subtotal = $product['price'] * $quantity;

        $total += $subtotal;
?>

<div style="border:1px solid black;padding:10px;margin:10px;">

    <h3><?php echo $product['name']; ?></h3>

    <p>Price: ₹<?php echo $product['price']; ?></p>

    <p>Quantity: <?php echo $quantity; ?></p>

    <p>Subtotal: ₹<?php echo $subtotal; ?></p>

</div>

<?php
    }
?>

<h2>Total: ₹<?php echo $total; ?></h2>

<form method="post">
    <button name="place_order">Place Order</button>
</form>

<?php
}else{
    echo "<h3>Your cart is empty</h3>";
}
?>

</body>
</html>