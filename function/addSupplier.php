<?php
    include '../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['nama'];

        // Prepare and bind
        $query = "INSERT INTO supplier (name) VALUES ('$name')";

        // Execute the statement
        if (mysqli_query($conn, $query)) {
            echo "<script>window.location.href='../pages/supplier.php';</script>";
        } else {
            echo "Error adding supplier";
        }

        // Close the statement
        $stmt->close();
    }
?>