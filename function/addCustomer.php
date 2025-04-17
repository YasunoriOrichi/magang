<?php
    include '../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['nama'];


        // AUTO NO REF
        $initial = strtoupper(substr($name, 0, 1));
        $sql = "SELECT COUNT(*) AS jumlah FROM customer WHERE ref_no LIKE '$initial%'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $nomorUrut = $row['jumlah'] + 1;
        $nomorFormatted = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);

        $no_ref = $initial . $nomorFormatted;
        
        // INSERT INTO customer
        $query = "INSERT INTO customer (ref_no, name) VALUES ('$no_ref', '$name')";
        $result = mysqli_query($conn, $query);

        // CONDITION
        if ($result) {
            echo "<script>window.location.href='../pages/customer.php';</script>";
        } else {
            echo "Error adding customer";
        }
    }
?>