<?php
include "../db.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    mysqli_query($conn, "INSERT INTO products(name, price, image) 
    VALUES('$name','$price','demo.jpg')");
}
?>

<form method="POST">
    <input name="name" placeholder="Product Name">
    <input name="price" placeholder="Price">
    <button name="submit">Add</button>
</form>