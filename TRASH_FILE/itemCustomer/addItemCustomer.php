<?php
    include '../../connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nameID = $_POST['kustomer'];
        $itemID = $_POST['item'];
        // Kalau harga kosong dari form
        if (empty($_POST['harga'])) {
            $q = mysqli_query($conn, "SELECT PRICE FROM item WHERE ID = '$itemID'");
            $data = mysqli_fetch_assoc($q);
            $price = $data['PRICE'];
        } else {
            $price = $_POST['harga'];
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

        // INSERT DATA TANPA ref_no DULU
        $insert = "INSERT INTO itemCustomer (CUSTOMER, ITEM, PRICE) VALUES ('$nameID', '$itemID', '$price')";
        $conn->query($insert);

        // GET ID YANG BARU DIBUAT
        $newID = $conn->insert_id;

        // BUAT REF_NO DARI INISIAL + ID
        $initialKustomer = strtoupper(substr($customerName, 0, 1));
        $initialItem = strtoupper(substr($itemName, 0, 1));
        $nomorFormatted = str_pad($newID, 3, "0", STR_PAD_LEFT);
        $ref_no = $initialKustomer . $initialItem . $nomorFormatted;

        // UPDATE ref_no BERDASARKAN ID YANG BARU
        $update = "UPDATE itemCustomer SET REF_NO = '$ref_no' WHERE ID = '$newID'";
        $conn->query($update);

        // REDIRECT / FEEDBACK
        header("Location: ../../pages/itemCustomer/itemCustomer.php?status=deleted");
    }
?>
