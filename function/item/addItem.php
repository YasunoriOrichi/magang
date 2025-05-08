<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['nama'];
        $price = $_POST['harga'];

        // VALIDATE NAME
        $check_name = "SELECT * FROM item WHERE NAME = '$name'";
        $resultName = $conn->query($check_name);

        if ($resultName->num_rows > 0) {
            echo "<script>window.location.href='../../pages/item/itemAdd.php?status=duplikat';</script>";
            exit;
        }

        // AUTO NO REF
        $initial = strtoupper(substr($name, 0, 1));
        $sql = "SELECT COUNT(*) AS jumlah FROM item WHERE REF_NO LIKE '$initial%'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nomorUrut = $row['jumlah'] + 1;
        $nomorFormatted = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);

        $no_ref = $initial . $nomorFormatted;

        // INSERT INTO item
        $query = "INSERT INTO item (REF_NO, NAME, PRICE) VALUES ('$no_ref', '$name', '$price')";
        $result = mysqli_query($conn, $query);

        // CONDITION
        if ($result) {
            echo "<script>window.location.href='../../pages/item/item.php?status=added';</script>";
        } else {
            echo "Error adding item";
        }
    }
?>