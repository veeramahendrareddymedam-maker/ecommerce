<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Our Products</h1>

<div class="products">

<?php
$result = mysqli_query($conn, "SELECT * FROM products");

while ($row = mysqli_fetch_assoc($result)) {
?>

<div class="card">

    <img src="images/<?php echo $row['image']; ?>">

    <h3><?php echo $row['name']; ?></h3>

    <p>₹<?php echo $row['price']; ?></p>

    <a href="cart.php?id=<?php echo $row['id']; ?>">
    <button>Add To Cart</button>
</a>
</div>

<?php } ?>

</div>

</body>
</html>