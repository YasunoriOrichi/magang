<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];

        // Hapus data dari database
        $query = "DELETE FROM itemCustomer WHERE ID = '$id'";
        $hasil = mysqli_query($conn, $query);

        if ($hasil) {
            header("Location: ../../pages/itemCustomer/itemCustomer.php?status=deleted");
        } else {
            header("Location: ../../pages/itemCustomer/itemCustomer.php?status=error_delete");
        }
    } else {
        header("Location: ../../pages/itemCustomer/itemCustomer.php?status=invalid");
    }
?>