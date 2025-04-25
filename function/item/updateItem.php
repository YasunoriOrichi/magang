<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $name = $_POST['nama'];
        $price = $_POST['harga'];

        // Prepare and bind
        $query = "UPDATE item SET NAME='$name', PRICE='$price' WHERE ID='$id'";

        // Execute the statement
        if (mysqli_query($conn, $query)) {
            echo "<script>window.location.href='../../pages/item/item.php';</script>";
        } else {
            echo "Error adding item";
        }
    }
?>