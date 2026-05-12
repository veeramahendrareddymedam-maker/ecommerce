<?php include "db.php"; ?>

<h1>Products</h1>

<?php
$result = mysqli_query($conn, "SELECT * FROM products");

while ($row = mysqli_fetch_assoc($result)) {
?>
    <div>
        <h3><?php echo $row['name']; ?></h3>
        <p><?php echo $row['price']; ?></p>
    </div>
<?php } ?>