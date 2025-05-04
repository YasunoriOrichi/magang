<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $customerID = $_POST['kustomer'];
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
        $invoice_no = $_POST['kode'];

        // TOTAL HARGA
        $total_price = $qty * $unit_price;

        // Prepare and bind
        $query = "UPDATE invoice SET INVOICE_NO='$invoice_no', CUSTOMER='$customerID', ITEM='$itemID', QTY='$qty', UNIT_PRICE='$unit_price', TOTAL_PRICE='$total_price' WHERE ID='$id'";

        // Execute the statement
        if (mysqli_query($conn, $query)) {
            echo "<script>window.location.href='../../pages/invoice/invoice.php';</script>";
        } else {
            echo "Error updating customer";
        }
    }
?>