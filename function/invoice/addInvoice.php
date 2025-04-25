<?php
    include '../../connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nameID = $_POST['kustomer'];
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

        // GET NAME CUSTOMER
        $queryName = "SELECT NAME FROM customer WHERE ID = '$nameID'";
        $resultName = $conn->query($queryName);
        $rowName = mysqli_fetch_assoc($resultName);
        $customerName = $rowName['NAME'];

        // GET NAME ITEM
        $queryItem = "SELECT NAME FROM item WHERE ID = '$itemID'";
        $resultItem = $conn->query($queryItem);
        $rowItem = mysqli_fetch_assoc($resultItem);
        $itemName = $rowItem['NAME'];

        // Ambil inisial hari ini
        $days = ['Sun'=>'M', 'Mon'=>'S', 'Tue'=>'S', 'Wed'=>'R', 'Thu'=>'K', 'Fri'=>'J', 'Sat'=>'S'];
        $dayInitial = $days[date('D')]; // Ex: 'Wed' => 'R'

        // Ambil tanggal sekarang
        $tanggal = date('d'); // 2 digit tanggal
        $bulan = date('m');   // 2 digit bulan
        $tahun = date('y');   // 2 digit tahun

        // GET TOTAL PRICE
        $total_price = $qty * $unit_price;

        // INSERT DATA invoice DAHULU
        $insert = "INSERT INTO invoice (CUSTOMER, ITEM, QTY, UNIT_PRICE, TOTAL_PRICE) VALUES ('$nameID', '$itemID', '$qty', '$unit_price', '$total_price')";
        $conn->query($insert);

        // GET ID YANG BARU DIBUAT
        $newID = $conn->insert_id;

        // BUAT INVOICE_NO DARI INISIAL + 
        $initialKustomer = strtoupper(substr($customerName, 0, 1));
        $nomorFormatted = str_pad($newID, 3, "0", STR_PAD_LEFT);
        $prefix = $initialKustomer . $dayInitial . $tanggal . $bulan . $tahun;
        $invoice_no = $prefix . $nomorFormatted;

        // UPDATE INVOICE_NO ke baris yang sudah dibuat
        $update = "UPDATE invoice SET INVOICE_NO = '$invoice_no' WHERE ID = '$newID'";
        $conn->query($update);
        
        // REDIRECT / FEEDBACK
        echo "<script>window.location.href='../../pages/invoice/invoice.php';</script>";
    }
?>
