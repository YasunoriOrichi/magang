<?php
include '../../connect.php';

// Ambil ID invoice dari URL
$id = $_GET['id'];

// Query untuk mengambil data invoice berdasarkan ID
$query = "
    SELECT * FROM invoice
    JOIN customer ON invoice.CUSTOMER = customer.ID
    WHERE invoice.ID = '$id'
";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);

$id_customer = $row['ID'] ?? '';
$invoice_no = $row['INVOICE_NO'] ?? '';
$customer = $row['NAME'] ?? '';
$invoice_date = date('d-m-Y', strtotime($row['DATE_INVOICE']));

$query = "
    SELECT * FROM invoice_detail
    JOIN item ON invoice_detail.ITEM = item.ID
    WHERE invoice_detail.ID_DETAIL = '$id'";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);

$id_detail = $row['ID_DETAIL'] ?? '';
$item = $row['NAME'] ?? '';
$qty = $row['QTY'] ?? '';
$unit_price = $row['UNIT_PRICE'] ?? 0;
$total_price = $row['TOTAL_PRICE'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        td {
            background-color: #fff;
        }
        .footer {
            text-align: center;
            font-size: 14px;
        }
        .footer p {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Informasi Kustomer dan Invoice -->
    <h1>Invoice</h1>


    <div class="invoice-details">
        <p><strong>Nama Kustomer:</strong> <?= $customer; ?></p>
        <p><strong>Tanggal:</strong> <?= $invoice_date; ?></p>
        <p><strong>Kode Invoice:</strong> <?= $invoice_no; ?></p>
    </div>

    <table>
        <tr>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
        </tr>
        <tr>
            <td><?= $item; ?></td>
            <td><?= $qty; ?></td>
            <td>Rp <?= number_format($unit_price, 0, ',', '.'); ?></td>
            <td>Rp <?= number_format($total_price, 0, ',', '.'); ?></td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima kasih atas pembelian Anda.</p>
    </div>

    <script>
        // Setelah halaman dimuat, langsung panggil fungsi print
        window.print();
        window.onafterprint = function() {
            window.location.href = "detailInvoice.php?id=<?= $id ?>"; // Redirect setelah print selesai
        };
    </script>

</body>
</html>
