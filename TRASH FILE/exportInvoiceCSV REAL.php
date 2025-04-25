<?php
include '../../connect.php';

header('Content-Type: application/vnd-ms-excel');
header('Content-Disposition: attachment; filename=INVOICE.csv');

// Ambil semua invoice dan item
$sql = "
    SELECT 
        inv.INVOICE_NO,
        inv.DATE_INVOICE,
        c.NAME AS customerName,
        i.NAME AS itemName,
        inv.QTY,
        inv.UNIT_PRICE,
        inv.TOTAL_PRICE
    FROM invoice inv
    JOIN customer c ON inv.CUSTOMER = c.ID
    JOIN item i ON inv.ITEM = i.ID
    ORDER BY inv.INVOICE_NO, inv.ID
";

$result = $conn->query($sql);
?>
<table>
    <thead>
        <tr>
            <th>Kode Invoice</th>
            <th>Nama Kustomer</th>
            <th>Tanggal dibuat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Fetch data from the database
            $sql = "SELECT 
                inv.INVOICE_NO,
                c.NAME AS customerName,
                inv.DATE_INVOICE
                FROM invoice inv
                JOIN customer c ON inv.CUSTOMER = c.ID";
                  
                $result = mysqli_query($conn, $sql);

                // Check if there are results
                if (mysqli_num_rows($result) > 0) {
                    // Loop through the results and display them in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='align-middle'>";
                        echo "<td>" . $row['INVOICE_NO'] . "</td>";
                        echo "<td>" . $row['customerName'] . "</td>";
                        echo "<td>" . $row['DATE_INVOICE'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center px-4 py-2'>Tidak ada data</td></tr>";
                }
        ?>
    </tbody>
</table>