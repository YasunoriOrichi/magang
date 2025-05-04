<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $name = $_POST['nama'];
        $ref_no = $_POST['kode'];

        // Prepare and bind
        $query = "UPDATE customer SET REF_NO='$ref_no', NAME='$name' WHERE ID='$id'";

        // Execute the statement
        if (mysqli_query($conn, $query)) {
            echo "<script>window.location.href='../../pages/customer/customer.php';</script>";
        } else {
            echo "Error updating customer";
        }
    }
?>