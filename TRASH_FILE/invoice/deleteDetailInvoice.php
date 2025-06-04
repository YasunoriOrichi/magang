<?php
    require '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id_detail_row'];

        $result = mysqli_query($conn, "SELECT ID_DETAIL FROM invoice_detail WHERE ID_DETAIL_ROW = '$id'");
        $row = mysqli_fetch_assoc($result);
        $id_detail = $row['ID_DETAIL'];

        // Hapus data dari database
        $query = "DELETE FROM invoice_detail WHERE ID_DETAIL_ROW = '$id'";
        $hasil = mysqli_query($conn, $query);

        if ($hasil) {
            // echo "Bisa cuy!";
            header("Location: ../../pages/invoice/detailInvoice.php?id=$id_detail&status=berhasil");
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    } else {
        header("Location: ../../pages/invoice/invoice.php?status=invalid");
        echo "ID tidak ditemukan.";
    }
?>