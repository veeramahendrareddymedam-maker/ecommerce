<?php
include "db.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");

    $product = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
</head>
<body>

<h1>Cart Page</h1>

<?php if(isset($product)) { ?>

<h2><?php echo $product['name']; ?></h2>

<p>Price: ₹<?php echo $product['price']; ?></p>

<img src="images/<?php echo $product['image']; ?>" width="200">

<?php } ?>

</body>
</html>