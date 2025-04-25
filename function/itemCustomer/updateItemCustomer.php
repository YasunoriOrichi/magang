<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $customer = $_POST['kustomer'];
        $item = $_POST['item'];
        $price = $_POST['harga'];

        // Prepare and bind
        $query = "UPDATE itemCustomer SET CUSTOMER='$customer', ITEM='$item', PRICE='$price' WHERE ID='$id'";

        // Execute the statement
        if (mysqli_query($conn, $query)) {
            echo "<script>window.location.href='../../pages/itemCustomer/itemCustomer.php';</script>";
        } else {
            echo "Error updating customer";
        }
    }
?>