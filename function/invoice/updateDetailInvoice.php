<?php
include '../../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_detail_row = $_POST['id'];
    $item = $_POST['item'];
    $qty = $_POST['jumlah'];

    // Ambil harga dari input atau default dari item
    if (empty($_POST['harga'])) {
        $q = mysqli_query($conn, "SELECT PRICE FROM item WHERE ID = '$itemID'");
        $data = mysqli_fetch_assoc($q);
        $unit_price = $data['PRICE'];
    } else {
        $unit_price = $_POST['harga'];
    }

    $total_price = $qty * $unit_price;

    $update = mysqli_query($conn, "UPDATE invoice_detail SET ITEM = '$item', QTY = '$qty', UNIT_PRICE = '$unit_price', TOTAL_PRICE = '$total_price' WHERE ID_DETAIL_ROW = '$id_detail_row'");
    $result = mysqli_query($conn, "SELECT ID_DETAIL FROM invoice_detail WHERE ID_DETAIL_ROW = '$id_detail_row'");
    $row = mysqli_fetch_assoc($result);
    $invoice_id = $row['ID_DETAIL'];

    if ($update) {
        header("Location: ../../pages/invoice/detailInvoice.php?id=$invoice_id");
    } else {
        echo "Gagal update data invoice.";
    }
}
?>