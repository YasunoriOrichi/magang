<?php
    include '../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nameID = $_POST['nama'];
        $itemID = $_POST['item'];
        $price = $_POST['harga'];
        $qty = $_POST['jumlah'];

        // AUTO NO REF
        $initial = strtoupper(substr($name, 0, 1));
        $sql = "SELECT COUNT(*) AS jumlah FROM itemCustomer WHERE ref_no LIKE '$initial%'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nomorUrut = $row['jumlah'] + 1;
        $nomorFormatted = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);

        $no_ref = $initial . $nomorFormatted;

        // INSERT INTO item
        $query = "INSERT INTO itemCustomer (ref_no, customer, item, price, qty) VALUES ('$no_ref', '$name', '$item', '$price', '$qty')";
        $result = mysqli_query($conn, $query);

        // CONDITION
        if ($result) {
            echo "<script>window.location.href='../pages/itemCustomer.php';</script>";
        } else {
            echo "Error adding item";
        }
    }
?>