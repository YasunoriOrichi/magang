<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['ID'];

        // Hapus data dari database
        $query = "DELETE FROM supplier WHERE ID = '$id'";
        $hasil = mysqli_query($conn, $query);

        if ($hasil) {
            echo "<script>window.location.href='../../pages/supplier/supplier.php?status=deleted';</script>";
        } else {
            echo "<script>window.location.href='../../pages/supplier/supplier.php?status=error_delete';</script>";
        }
    } else {
        echo "<script>window.location.href='../../pages/supplier/supplier.php?status=invalid';</script>";
    }
?>