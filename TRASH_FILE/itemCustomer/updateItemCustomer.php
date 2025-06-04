<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $customer = $_POST['kustomer'];
        $item = $_POST['item'];
        $price = $_POST['harga'];
        $ref_no = $_POST['kode'];

        // Prepare and bind
        $query = "UPDATE itemCustomer SET REF_NO='$ref_no', CUSTOMER='$customer', ITEM='$item', PRICE='$price' WHERE ID='$id'";

        // Execute the statement
        if (mysqli_query($conn, $query)) {
            header("Location: ../../pages/itemCustomer/itemCustomer.php");
        } else {
            echo "Error updating customer";
        }
    }
?>