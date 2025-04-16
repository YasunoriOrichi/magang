<?php
    include '../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['ID'];

        // Hapus data dari database
        $query = "DELETE FROM supplier WHERE ID = '$id'";
        $hasil = mysqli_query($conn, $query);

        if ($hasil) {
            echo "<script>window.location.href='../pages/supplier.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    } else {
        echo "ID tidak ditemukan.";
    }
?>