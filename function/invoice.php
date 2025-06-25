<?php 
require_once '../config/BaseController.php';
$action = $_GET['action'];
$id_invoice = $_GET['inv'] ?? $_POST['inv'] ?? null;
$id_detail = $_GET['id'] ?? $_POST['id'] ?? null;
$invoice_no = $_POST['invoice_no'] ?? null;
$customer = $_POST['kustomer'] ?? null;
$unit_price = $_POST['harga'] ?? null;
$item = $_POST['item'] ?? null;
$date = $_POST['date'] ?? null;
$qty = $_POST['jumlah'] ?? null;
$ref_no = $_POST['kode'] ?? null;
$note = $_POST['note'] ?? null;

echo $action;


class Invoice {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addInvoice($customer) {
        // GET NAME CUSTOMER
        $queryName = "SELECT NAME FROM customer WHERE ID = '$customer'";
        $resultName = $this->conn->query($queryName);
        $rowName = mysqli_fetch_assoc($resultName);
        $customerName = $rowName['NAME'];

        // Ambil inisial hari ini
        $days = ['Sun'=>'M', 'Mon'=>'S', 'Tue'=>'S', 'Wed'=>'R', 'Thu'=>'K', 'Fri'=>'J', 'Sat'=>'S'];
        $dayInitial = $days[date('D')]; // Ex: 'Wed' => 'R'

        // Ambil tanggal sekarang
        $tanggal = date('d'); // 2 digit tanggal
        $bulan = date('m');   // 2 digit bulan
        $tahun = date('y');   // 2 digit tahun

        // INSERT DATA invoice DAHULU
        $insert = "INSERT INTO invoice (CUSTOMER) VALUES ('$customer')";
        $this->conn->query($insert);

        // GET ID YANG BARU DIBUAT
        $newID = $this->conn->insert_id;
        echo $newID;

        // BUAT INVOICE_NO DARI INISIAL + 
        $initialKustomer = strtoupper(substr($customerName, 0, 1));
        $nomorFormatted = str_pad($newID, 3, "0", STR_PAD_LEFT);
        $prefix = $initialKustomer . $dayInitial . $tanggal . $bulan . $tahun;
        $invoice_no = $prefix . $nomorFormatted;

        // UPDATE INVOICE_NO ke baris yang sudah dibuat
        $update = "UPDATE invoice SET INVOICE_NO = '$invoice_no' WHERE ID = '$newID'";
        $this->conn->query($update);

        header("Location: ../../pages/invoice/detailInvoice.php?inv=$newID");
    }

    public function addDetailInvoice($item, $qty, $unit_price, $id_invoice) {
        if ($unit_price == null) {
            $unit_price = "SELECT PRICE FROM item WHERE ID = '$item'";
            $result = mysqli_query($this->conn, $unit_price);
            $row = mysqli_fetch_assoc($result);
            $unit_price = $row['PRICE'];
        }
        $total_price = $unit_price * $qty;

        echo " " . $item . " " . $qty . " " . $unit_price . " " . $total_price . " " . $id_invoice;


        $insert = "INSERT INTO invoice_detail (ITEM, QTY, UNIT_PRICE, TOTAL_PRICE, ID_DETAIL)
                    VALUES ('$item', '$qty', '$unit_price', '$total_price', '$id_invoice')";
        $this->conn->query($insert);

        header("Location: ../../pages/invoice/detailInvoice.php?inv=$id_invoice");
    }

    public function updateInvoice($invoice_no, $customer, $date, $note, $id_invoice) {
        $updateInvoice = mysqli_query($this->conn, "UPDATE invoice SET INVOICE_NO = '$invoice_no', CUSTOMER = '$customer', DATE_INVOICE = '$date', NOTE = '$note' WHERE ID = '$id_invoice'");

        if ($updateInvoice) {
            header("Location: ../../pages/invoice/detailInvoice.php?inv=$id_invoice");
        } else {
            echo "Gagal update data invoice.";
        }
    }

    public function updateDetailInvoice($item, $qty, $unit_price, $id_detail, $id_invoice) {
        if ($unit_price == null) {
            $unit_price = "SELECT PRICE FROM item WHERE ID = '$item'";
            $result = mysqli_query($this->conn, $unit_price);
            $row = mysqli_fetch_assoc($result);
            $unit_price = $row['PRICE'];
        }
        $total_price = $unit_price * $qty;
    
        $update = mysqli_query($this->conn, "UPDATE invoice_detail SET ITEM = '$item', QTY = '$qty', UNIT_PRICE = '$unit_price', TOTAL_PRICE = '$total_price' WHERE ID_DETAIL_ROW = '$id_detail'");
    
        if ($update) {
            header("Location: ../../pages/invoice/detailInvoice.php?inv=$id_invoice");
        } else {
            echo "Gagal update data invoice.";
        }
    }

    public function deleteInvoice($id_invoice) {
        $delete = mysqli_query($this->conn, "DELETE FROM invoice WHERE ID = '$id_invoice'");
        if ($delete) {
            header("Location: ../../pages/invoice/invoice.php");
        } else {
            echo "Gagal menghapus data invoice.";
        }
    }

    public function deleteDetailInvoice($id_detail, $id_invoice) {
        $delete = mysqli_query($this->conn, "DELETE FROM invoice_detail WHERE ID_DETAIL_ROW = '$id_detail'");
        if ($delete) {
            header("Location: ../../pages/invoice/detailInvoice.php?inv=$id_invoice");
        } else {
            echo "Gagal menghapus data invoice.";
        }
    }
}

$invoice = new Invoice();

if ($_GET['action'] == 'add') {
    $invoice->addInvoice($customer);
} elseif ($_GET['action'] == 'addDetail') {
    $invoice->addDetailInvoice($item, $qty, $unit_price, $id_invoice);
} elseif ($_GET['action'] == 'update') {
    $invoice->updateInvoice($invoice_no, $customer, $date, $note, $id_invoice);
} elseif ($_GET['action'] == 'updateDetail') {
    $invoice->updateDetailInvoice($item, $qty, $unit_price, $id_detail, $id_invoice);
} elseif ($_GET['action'] == 'delete') {
    $invoice->deleteInvoice($id_invoice);
} elseif ($_GET['action'] == 'deleteDetail') {
    $invoice->deleteDetailInvoice($id_detail, $id_invoice);
} else {
    $_SESSION['alert'] = 'invalid';
    header("Location: ../../pages/invoice/invoice.php");
}

?>