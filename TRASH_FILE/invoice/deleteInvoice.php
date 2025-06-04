<?php
    require '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];

        // Hapus data dari database
        $query = "DELETE FROM invoice WHERE ID = '$id'";
        $hasil = mysqli_query($conn, $query);

        if ($hasil) {
            // echo "Bisa cuy!";
            header("Location: ../../pages/invoice/invoice.php?status=berhasil");
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    } else {
        header("Location: ../../pages/invoice/invoice.php?status=invalid");
        echo "ID tidak ditemukan.";
    }
?>