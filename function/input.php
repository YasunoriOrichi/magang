<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $item = $_POST['item'];

    // Validasi input
    if (empty($name) || empty($item)) {
        header("Location: ../pages/input.php?error=Please fill in all fields");
        exit();
    }

    // Ambil semua data item berdasarkan ID
    $itemQuery = mysqli_query($conn, "SELECT * FROM item WHERE ID = '$item'");
    if (mysqli_num_rows($itemQuery) == 0) {
        header("Location: ../pages/input.php?error=Item not found");
        exit();
    }
    $itemData = mysqli_fetch_assoc($itemQuery);
    $price = $itemData['PRICE'];

    // Simpan data ke invoice
    $query = "INSERT INTO invoice (CUSTOMER, ITEM) VALUES ('$name', '$item')";
    if (mysqli_query($conn, $query)) {
        header("Location: addCustomer.php?nama=" . urlencode($nama));
    } else {
        header("Location: ../pages/input.php?error=" . mysqli_error($conn));
    }
}
?>