<?php
    include '../../connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nameID = $_POST['kustomer'];
        $itemID = $_POST['item'];
        $qty = $_POST['jumlah'];
        // Kalau harga kosong dari form
        // if (empty($_POST['harga'])) {
        //     $q = mysqli_query($conn, "SELECT PRICE FROM item WHERE ID = '$itemID'");
        //     $data = mysqli_fetch_assoc($q);
        //     $unit_price = $data['PRICE'];
        // } else {
        //     $unit_price = $_POST['harga'];
        // }

        // GET NAME CUSTOMER
        $queryName = "SELECT NAME FROM customer WHERE ID = '$nameID'";
        $resultName = $conn->query($queryName);
        $rowName = mysqli_fetch_assoc($resultName);
        $customerName = $rowName['NAME'];

        // Ambil inisial hari ini
        $days = ['Sun'=>'M', 'Mon'=>'S', 'Tue'=>'S', 'Wed'=>'R', 'Thu'=>'K', 'Fri'=>'J', 'Sat'=>'S'];
        $dayInitial = $days[date('D')]; // Ex: 'Wed' => 'R'

        // Ambil tanggal sekarang
        $tanggal = date('d'); // 2 digit tanggal
        $bulan = date('m');   // 2 digit bulan
        $tahun = date('y');   // 2 digit tahun

        // INSERT DATA invoice DAHULU
        $insert = "INSERT INTO invoice (CUSTOMER) VALUES ('$nameID')";
        $conn->query($insert);

        // GET ID YANG BARU DIBUAT
        $newID = $conn->insert_id;
        echo $newID;

        // BUAT INVOICE_NO DARI INISIAL + 
        $initialKustomer = strtoupper(substr($customerName, 0, 1));
        $nomorFormatted = str_pad($newID, 3, "0", STR_PAD_LEFT);
        $prefix = $initialKustomer . $dayInitial . $tanggal . $bulan . $tahun;
        $invoice_no = $prefix . $nomorFormatted;

        // UPDATE INVOICE_NO ke baris yang sudah dibuat
        $update = "UPDATE invoice SET INVOICE_NO = '$invoice_no' WHERE ID = '$newID'";
        $conn->query($update);

        // INSERT DATA invoice_detail
        for ($i = 0; $i < count($itemID); $i++) {
            $item = $itemID[$i];
            $jumlah = $qty[$i];

            // GET HARGA DARI ITEM
            if (empty($_POST['harga'][$i])) {
                $queryPrice = "SELECT PRICE FROM item WHERE ID = '$item'";
                $resultPrice = $conn->query($queryPrice);
                $rowPrice = mysqli_fetch_assoc($resultPrice);
                $unit_price = $rowPrice['PRICE'];
            } else {
                $unit_price = $_POST['harga'][$i];
            }

            // HITUNG TOTAL HARGA
            $total_price = $unit_price * $jumlah;

            // INSERT DATA invoice_detail
            $insertDetail = "INSERT INTO invoice_detail (ID_DETAIL, ITEM, QTY, UNIT_PRICE, TOTAL_PRICE) VALUES ('$newID', '$item', '$jumlah', '$unit_price', '$total_price')";
            // echo $insertDetail;
            $conn->query($insertDetail);
        }
        
        // REDIRECT / FEEDBACK
        echo "<script>window.location.href='../../pages/invoice/detailInvoice.php?id=$newID';</script>";
    }
?>
