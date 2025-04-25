<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];

        // Hapus data dari database
        $query = "DELETE FROM invoice WHERE INVOICE_NO = '$id'";
        $hasil = mysqli_query($conn, $query);

        if ($hasil) {
            echo "<script>window.location.href='../../pages/invoice/invoice.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    } else {
        echo "ID tidak ditemukan.";
    }
?>