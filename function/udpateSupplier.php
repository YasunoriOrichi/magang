<?php
    include '../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $name = $_POST['nama'];

        // Prepare and bind
        $query = "UPDATE supplier SET NAME='$name' WHERE ID='$id'";

        // Execute the statement
        if (mysqli_query($conn, $query)) {
            echo "<script>window.location.href='../pages/supplier.php';</script>";
        } else {
            echo "Error updating supplier";
        }

        // Close the statement
        $stmt->close();
    }
?>