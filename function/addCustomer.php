<?php
include '../connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = $_POST['nama'];

    $query = "INSERT INTO customer (NAME) VALUES ('$nama')";

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil ditambahkan.";
        header("Location: ../pages/customer.php");
    } else {
        echo "Gagal tambah data: " . mysqli_error($conn);
    }
}

?>