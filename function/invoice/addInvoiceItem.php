<?php
    include '../../connect.php';

    $id = $_POST['id'];
    if (!isset($id)) {
        echo "error";
        // header('Location: ../../pages/invoice/invoice.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $itemID = $_POST['item'];
        $qty = $_POST['jumlah'];

        // Kalau harga kosong dari form
        if (empty($_POST['harga'])) {
            $q = mysqli_query($conn, "SELECT PRICE FROM item WHERE ID = '$itemID'");
            $data = mysqli_fetch_assoc($q);
            $unit_price = $data['PRICE'];
        } else {
            $unit_price = $_POST['harga'];
        }

        $total_price = $unit_price * $qty;

        $insert = "INSERT INTO invoice_detail (ITEM, QTY, UNIT_PRICE, TOTAL_PRICE, ID_DETAIL)
                    VALUES ('$itemID', '$qty', '$unit_price', '$total_price', '$id')";
        // INSERT DATA invoice_detail
        $conn->query($insert);
        
        // REDIRECT / FEEDBACK
        echo "<script>window.location.href='../../pages/invoice/detailInvoice.php?id=$id';</script>";
    }
?>
