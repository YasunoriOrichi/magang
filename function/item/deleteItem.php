<?php
    include '../../connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['ID'];

        // Aktifkan laporan error MySQLi sebagai Exception
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            // Hapus data
            $query = "DELETE FROM item WHERE ID = '$id'";
            mysqli_query($conn, $query);

            // Kalau berhasil
            header("Location: ../../pages/item/item.php?status=berhasil");

        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
                header("Location: ../../pages/item/item.php?status=gagal");
            } else {
                header("Location: ../../pages/item/item.php?status=error");
            }
            exit;
        }
    } else {
        header("Location: ../../pages/item/item.php?status=invalid");
        exit;
    }
?>
