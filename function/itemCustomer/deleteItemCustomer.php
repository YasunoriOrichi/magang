<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];

        // Hapus data dari database
        $query = "DELETE FROM itemCustomer WHERE ID = '$id'";
        $hasil = mysqli_query($conn, $query);

        if ($hasil) {
            echo "<script>window.location.href='../../pages/itemCustomer/itemCustomer.php?status=deleted';</script>";
        } else {
            echo "<script>window.location.href='../../pages/itemCustomer/itemCustomer.php?status=error_delete';</script>";
        }
    } else {
        echo "<script>window.location.href='../../pages/itemCustomer/itemCustomer.php?status=invalid';</script>";
    }
?>