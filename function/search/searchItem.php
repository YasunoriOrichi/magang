<?php
// Koneksi ke database
include '../../connect.php';

$query = $_GET['serach'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM item WHERE nama LIKE ?");
$stmt->execute(["%$query%"]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output JSON
header('Content-Type: application/json');
echo json_encode($results);
?>