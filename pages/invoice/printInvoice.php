<?php
require_once '../../config/BaseController.php';
require_once '../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$print = $_GET['print'] ?? null;
if ($print === 'true') {
    $print = true;
} else {
    $print = false;
}

$controller = new BaseController();
$conn = getConnection();
$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID invoice tidak ditemukan.");
}

// Query data
$company = $conn->query("SELECT * FROM setting WHERE COMPANY_ID = 1")->fetch_assoc();
$invoice = $conn->query("SELECT * FROM invoice JOIN customer ON invoice.CUSTOMER = customer.ID WHERE invoice.ID = '$id'")->fetch_assoc();
$client = $conn->query("SELECT * FROM customer WHERE ID = '{$invoice['CUSTOMER']}'")->fetch_assoc();
$payment = $conn->query("SELECT SUM(PAID) AS PAYMENT FROM payment WHERE INVOICE_ID = '$id'")->fetch_assoc();
$detail_query = $conn->query("SELECT * FROM invoice_detail JOIN item ON invoice_detail.ITEM = item.ID WHERE invoice_detail.ID_DETAIL = '$id'");
$details = [];
$total = 0;
while ($row = $detail_query->fetch_assoc()) {
    $details[] = $row;
    $total += $row['TOTAL_PRICE'];
}

// Variable untuk template
$invoice_no = $invoice['INVOICE_NO'];
$invoice_date = $invoice['DATE_INVOICE'];
$customer = $invoice['NAME'];
$note = $invoice['NOTE'] ?? 'Tidak ada keterangan';

// Ambil tampilan HTML
ob_start();
include('invoice_template.php');
$html = ob_get_clean();

// Buat PDF
$options = new Options();
$options->set('isRemoteEnabled', true); // Biar bisa load gambar dari URL
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream("invoice-$invoice_no.pdf", ["Attachment" => $print]);