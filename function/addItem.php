<?php
include '../connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO items (NAME, PRICE) VALUES ('$nama', '$harga')";

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil ditambahkan.";
        header("Location: ../pages/item.php");
    } else {
        echo "Gagal tambah data: " . mysqli_error($conn);
    }
}

?>