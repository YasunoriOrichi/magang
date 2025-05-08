<?php
include '../../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $customer = $_POST['kustomer'];
    $invoice_no = $_POST['invoice_no'];
    $date = $_POST['invoice_date'];

    // 2. Update tabel invoice
    $updateInvoice = mysqli_query($conn, "UPDATE invoice SET INVOICE_NO = '$invoice_no', CUSTOMER = '$customer', DATE_INVOICE = '$date' WHERE ID = '$id'");


    if ($updateInvoice) {
        echo "<script>window.location.href='../../pages/invoice/detailInvoice.php?id=$id';</script>";
    } else {
        echo "Gagal update data invoice.";
    }
}
?>