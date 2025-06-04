<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $new_name = $_POST['nama'];
        $new_price = $_POST['harga'];
        $ref_no = $_POST['kode'];
        
        // Update data
        $update = mysqli_query($conn, "UPDATE item SET REF_NO='$ref_no', NAME='$new_name', PRICE = '$new_price' WHERE ID = '$id'");

        
        if ($update) {
            echo "<script>window.location.href='../../pages/item/item.php';</script>";
        } else {
            echo "❌ Gagal update item.";
        }
    }
?>