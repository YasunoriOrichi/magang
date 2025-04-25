<?php
    include '../../connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['ID'];

        // Aktifkan laporan error MySQLi sebagai Exception
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            // Hapus data
            $query = "DELETE FROM customer WHERE ID = '$id'";
            mysqli_query($conn, $query);

            // Kalau berhasil
            header("Location: ../../pages/customer/customer.php?status=berhasil");

        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
                header("Location: ../../pages/customer/customer.php?status=gagal");
            } else {
                header("Location: ../../pages/customer/customer.php?status=error");
            }
            exit;
        }
    } else {
        header("Location: ../../pages/customer/customer.php?status=invalid");
        exit;
    }
?>
