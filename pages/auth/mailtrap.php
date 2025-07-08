<?php
require_once __DIR__ . '/../../config/BaseController.php';
require 'PHPMailer/PHPMailer/PHPMailer.php';
require 'PHPMailer/PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer/SMTP.php';
$conn = getConnection();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$controller = new BaseController();

$email = $_POST['email']; // Ambil email dari form

$query = "SELECT * FROM account WHERE EMAIL = '$email'";
$result = mysqli_query(getConnection(), $query);
if (mysqli_num_rows($result) == 0) {
    $_SESSION['alert'] = 'unregistered'; // Set session alert for email not found
    header("Location: " . $controller->formResetPassword());
    exit;
}
$token = bin2hex(random_bytes(32));
mysqli_query($conn, "UPDATE account SET reset_token = '$token' WHERE email = '$email'");

$mail = new PHPMailer(true);

try {
    // Konfigurasi server Mailtrap
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'e790c036d1b2d2'; // Ganti dengan username Mailtrap
    $mail->Password = '5fb5a228256649'; // Ganti dengan password Mailtrap
    $mail->Port = 2525;

    // Pengirim & Penerima
    $mail->setFrom('nurserinevil@example.com', 'Nevil Nurseri'); // Ganti dengan nama pengirim
    $mail->addAddress($email, 'kostumer'); // Ganti dengan email penerima

    // Konten email
    $link = $controller->formResetPassword() . "?token=$token";
    $mail->isHTML(true);
    $mail->Subject = 'Link Verifikasi Reset Password';
    $mail->Body = "<a href='$link' target='_blank'>Klik disini<a/> untuk mereset kata sandi anda!";
    $mail->send();

    // Simpan kode di SESSION atau database
    $_SESSION['kode_verifikasi'] = $kode_verifikasi;
    $_SESSION['email_reset'] = $email;

    header("Location: " . $controller->formResetPassword() . "?vrf=1"); // Redirect ke halaman verifikasi kode
} catch (Exception $e) {
    echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
}
?>