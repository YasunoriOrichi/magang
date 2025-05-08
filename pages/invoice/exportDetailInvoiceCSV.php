<?php
include '../../connect.php';

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=detail-invoice.xls");

$kode_invoice = $_GET['id'];

// Ambil 3 digit terakhir
$id = (int)substr($kode_invoice, -3);

?>
<p align="center">DETAIL INVOICE</p>

<table>
    <?php
    $sql = "SELECT 
    c.NAME AS customerName,
    inv.INVOICE_NO,
    inv.DATE_INVOICE
    FROM invoice inv
    JOIN customer c ON inv.CUSTOMER = c.ID
    WHERE inv.ID = '$id'";
              
    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo "<tr>";
        echo "<td>Kode Invoice: </td>";
        echo "<td>" . $data['INVOICE_NO'] . "</td>";
        echo "</tr>";    
        echo "<tr>";
        echo "<td>Tanggal: </td>";
        echo "<td>" . $data['DATE_INVOICE'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Nama: </td>";
        echo "<td>" . $data['customerName'] . "</td>";
        echo "</tr>";
        }
    ?>
</table>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>QTY</th>
            <th>Harga/pcs</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Fetch data from the database
            $sql = "SELECT 
                i.NAME AS itemName,
                inv.QTY,
                inv.UNIT_PRICE,
                inv.TOTAL_PRICE
                FROM invoice_detail inv
                JOIN item i ON inv.ITEM = i.ID
                ";
                  
                $result = mysqli_query($conn, $sql);

                // Check if there are results
                if (mysqli_num_rows($result) > 0) {
                    $id = 0;
                    // Loop through the results and display them in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Increment the ID for each row
                        echo "<tr class='align-middle'>";
                        echo "<td>" . ++$id . "</td>";
                        echo "<td>" . $row['itemName'] . "</td>";
                        echo "<td>" . $row['QTY'] . "</td>";
                        echo "<td>" . $row['UNIT_PRICE'] . "</td>";
                        echo "<td>" . $row['TOTAL_PRICE'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center px-4 py-2'>Tidak ada data</td></tr>";
                }
        ?>
    </tbody>
</table>