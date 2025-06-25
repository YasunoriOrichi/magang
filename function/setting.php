<?php
require_once '../config/BaseController.php'; // koneksi DB kamu
$controller = new BaseController();
$conn = getConnection();

$action = $_GET['action'] ?? '';

$company_name = $_POST['company'] ?? '';
$company_address = $_POST['address'] ?? '';
$company_phone = $_POST['phone'] ?? '';
$company_email = $_POST['email'] ?? '';

if ($action === 'logo') {
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $folder = '/dist/assets/img/';
        $namaFile = basename($_FILES['logo']['name']);
        $pathRelatif = $folder . $namaFile; // Simpan ke database
        $pathPenuh = $_SERVER['DOCUMENT_ROOT'] . $pathRelatif;
    
        // Pindahkan file
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $pathPenuh)) {
            // Simpan path ke database
            $query = "UPDATE setting SET COMPANY_LOGO = '$pathRelatif' WHERE COMPANY_ID = 1";
            mysqli_query($conn, $query);
    
            $_SESSION['alert'] = 'updated';
            header("Location: " . BASE_PATH . "/pages/setting/setting.php");
        } else {
            echo "Gagal menyimpan file.";
        }
    } else {
        echo "Tidak ada file yang diupload.";
    }

    // Upload Tanda Tangan
    if (isset($_FILES['signature']) && $_FILES['signature']['error'] == 0) {
        $folder = '/dist/assets/img/';
        $namaFileTtd = basename($_FILES['signature']['name']);
        $pathTtdRelatif = $folder . $namaFileTtd;
        $pathTtdPenuh = $_SERVER['DOCUMENT_ROOT'] . $pathTtdRelatif;

        if (move_uploaded_file($_FILES['signature']['tmp_name'], $pathTtdPenuh)) {
            $queryTtd = "UPDATE setting SET COMPANY_SIGNATURE = '$pathTtdRelatif' WHERE COMPANY_ID = 1";
            mysqli_query($conn, $queryTtd);
        } else {
            echo "Gagal menyimpan file tanda tangan.<br>";
        }
    }
} elseif ($action === 'detail') {
    // Update detail perusahaan
    $query = "UPDATE setting SET COMPANY_NAME = '$company_name', COMPANY_ADDRESS = '$company_address', COMPANY_PHONE = '$company_phone', COMPANY_EMAIL = '$company_email' WHERE COMPANY_ID = 1";
    mysqli_query($conn, $query);
    
    $_SESSION['alert'] = 'updated';
    header("Location: " . BASE_PATH . "/pages/setting/setting.php");
}
?>