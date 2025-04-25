<?php
include '../../connect.php';

// Query untuk mengambil data lengkap dari tabel invoice
$sql = "SELECT 
            inv.INVOICE_NO,
            c.NAME AS customerName,
            inv.DATE_INVOICE,
            i.NAME AS itemName,
            inv.QTY,
            inv.UNIT_PRICE,
            inv.TOTAL_PRICE
        FROM invoice inv
        JOIN customer c ON inv.CUSTOMER = c.ID
        JOIN item i ON inv.ITEM = i.ID";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            padding: 10px 15px;
            border: 1px solid #333;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

    <h2>Daftar Invoice</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Tanggal</th>
                <th>Kode Invoice</th>
                <th>Nama Item</th>
                <th>QTY</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php $no = 1; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['customerName'] ?></td>
                        <td><?= date('d-m-Y', strtotime($row['DATE_INVOICE'])) ?></td>
                        <td><?= $row['INVOICE_NO'] ?></td>
                        <td><?= $row['itemName'] ?></td>
                        <td><?= $row['QTY'] ?></td>
                        <td>Rp <?= number_format($row['UNIT_PRICE'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($row['TOTAL_PRICE'], 0, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center;">Tidak ada data untuk ditampilkan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        window.print();
        window.onafterprint = () => {
            window.location.href = '../../pages/invoice/invoice.php';
        };
    </script>

</body>
</html>
