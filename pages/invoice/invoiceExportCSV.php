<?php
include '../../connect.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan-excel.xls"); 

?>

<p align="center">DAFTAR INVOICE</p>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode Invoice</th>
            <th>Kustomer</th>
            <th>Barang</th>
            <th>QTY</th>
            <th>Harga/pcs</th>
            <th>Total Harga</th>
            <th>Tanggal dibuat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Fetch data from the database
            $sql = "SELECT 
                inv.ID,
                inv.INVOICE_NO,
                c.NAME AS customerName,
                i.NAME AS itemName,
                inv.QTY,
                inv.UNIT_PRICE,
                inv.TOTAL_PRICE,
                inv.DATE_INVOICE
                FROM invoice inv
                JOIN customer c ON inv.CUSTOMER = c.ID
                JOIN item i ON inv.ITEM = i.ID";
                  
                $result = mysqli_query($conn, $sql);

                // Check if there are results
                if (mysqli_num_rows($result) > 0) {
                    // Loop through the results and display them in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='align-middle'>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['INVOICE_NO'] . "</td>";
                        echo "<td>" . $row['customerName'] . "</td>";
                        echo "<td>" . $row['itemName'] . "</td>";
                        echo "<td>" . $row['QTY'] . "</td>";
                        echo "<td>" . $row['UNIT_PRICE'] . "</td>";
                        echo "<td>" . $row['TOTAL_PRICE'] . "</td>";
                        echo "<td>" . $row['DATE_INVOICE'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center px-4 py-2'>Tidak ada data</td></tr>";
                }
        ?>
    </tbody>
</table>
<!-- </body>
</html> -->