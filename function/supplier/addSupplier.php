<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['nama'];

        // VALIDATE NAME
        $check_name = "SELECT * FROM supplier WHERE NAME = '$name'";
        $resultName = $conn->query($check_name);

        if ($resultName->num_rows > 0) {
            echo "<script>window.location.href='../../pages/supplier/supplierAdd.php?status=duplikat';</script>";
            exit;
        }
        
        // AUTO NO REF
        $initial = strtoupper(substr($name, 0, 1));
        $sql = "SELECT COUNT(*) AS jumlah FROM supplier WHERE REF_NO LIKE '$initial%'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nomorUrut = $row['jumlah'] + 1;
        $nomorFormatted = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);

        $no_ref = $initial . $nomorFormatted;

        // INSERT INTO supplier
        $query = "INSERT INTO supplier (REF_NO, NAME) VALUES ('$no_ref', '$name')";
        $result = mysqli_query($conn, $query);

        // CONDITION
        if ($result) {
            echo "<script>window.location.href='../../pages/supplier/supplier.php';</script>";
        } else {
            echo "Error adding supplier";
        }
    }
?>