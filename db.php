<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "ecommerce", 3308);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>