<?php
include '../../connect.php';

// Ambil ID invoice dari URL
$invoiceID = $_GET['id'];

// Query untuk mengambil data invoice berdasarkan ID
$query = "
    SELECT invoice.ID, INVOICE_NO, customer.NAME AS CUSTOMER_NAME, item.NAME AS ITEM_NAME,
           QTY, UNIT_PRICE, TOTAL_PRICE, invoice.DATE_INVOICE
    FROM invoice
    JOIN customer ON invoice.CUSTOMER = customer.ID
    JOIN item ON invoice.ITEM = item.ID
    WHERE invoice.ID = '$invoiceID'
";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);
$invoiceID = $row['INVOICE_NO'];
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
        <p><strong>Nama Kustomer:</strong> <?= $row['CUSTOMER_NAME']; ?></p>
        <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($row['DATE_INVOICE'])); ?></p>
        <p><strong>Kode Invoice:</strong> <?= $row['INVOICE_NO']; ?></p>
    </div>

    <table>
        <tr>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
        </tr>
        <tr>
            <td><?= $row['ITEM_NAME']; ?></td>
            <td><?= $row['QTY']; ?></td>
            <td>Rp <?= number_format($row['UNIT_PRICE'], 0, ',', '.'); ?></td>
            <td>Rp <?= number_format($row['TOTAL_PRICE'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima kasih atas pembelian Anda.</p>
    </div>

    <script>
        // Setelah halaman dimuat, langsung panggil fungsi print
        window.print();
        window.onafterprint = function() {
            window.location.href = "detailInvoice.php?id=<?= $invoiceID ?>"; // Redirect setelah print selesai
        };
    </script>

</body>
</html>
