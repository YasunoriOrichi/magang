<?php
    include '../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['nama'];
        $price = $_POST['harga'];

        // Prepare and bind
        $query = "INSERT INTO items (name, price) VALUES ('$name', '$price')";

        // Execute the statement
        if (mysqli_query($conn, $query)) {
            echo "<script>window.location.href='../pages/item.php';</script>";
        } else {
            echo "Error adding item";
        }

        // Close the statement
        $stmt->close();
    }
?>