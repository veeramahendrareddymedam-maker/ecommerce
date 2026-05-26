<?php
session_start();
include "db.php";
if(isset($_GET['action']) && isset($_GET['id'])){

    $id = $_GET['id'];

    if($_GET['action'] == 'inc'){
        $_SESSION['cart'][$id] += 1;
    }

    if($_GET['action'] == 'dec'){
        $_SESSION['cart'][$id] -= 1;

        // if quantity becomes 0 → remove product
        if($_SESSION['cart'][$id] <= 0){
            unset($_SESSION['cart'][$id]);
        }
    }

    header("Location: cart.php");
    exit;
}
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

    if(isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id] += 1;
    $_SESSION['message'] = "⚠ product already in cart ";
}else{
    $_SESSION['cart'][$id] = 1;
    $_SESSION['message'] = "✅ Product added to cart";
}

header("Location: cart.php");
exit;
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
if(isset($_SESSION['message'])){
    echo "<p style='color:green;'>".$_SESSION['message']."</p>";
    unset($_SESSION['message']);
}
?>

<?php

$total = 0;

if(isset($_SESSION['cart'])){

    foreach($_SESSION['cart'] as $product_id => $quantity){

        $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$product_id");

        $product = mysqli_fetch_assoc($result);

        $total += $product['price'] * $quantity;
?>

<div style="border:1px solid black;padding:10px;margin:10px;">

    <h3><?php echo $product['name']; ?></h3>

    <p>₹<?php echo $product['price']; ?></p>
    <p>Quantity: <?php echo $quantity; ?></p>

<a href="cart.php?action=dec&id=<?php echo $product_id; ?>">
    <button>-</button>
</a>

<a href="cart.php?action=inc&id=<?php echo $product_id; ?>">
    <button>+</button>
</a>
    <img src="images/<?php echo $product['image']; ?>" width="150">
    <br><br>

<a href="cart.php?remove=<?php echo $product_id; ?>">
    <button>Remove</button>
</a>

</div>

<?php
    }
}
?>

<h2>Total: ₹<?php echo $total; ?></h2>

<a href="checkout.php">
    <button>Proceed to Checkout</button>
</a>

</body>
</html>