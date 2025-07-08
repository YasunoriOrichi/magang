<?php
require_once __DIR__ . '/../config/BaseController.php';

$id = $_POST['id'] ?? $_GET['id'] ?? null;
$invoice_id = $_POST['inv'] ?? $_GET['inv'] ?? null;
$unpaid = $_POST['submit'] ?? null;
$paid = $_POST['paid'] ?? null;
$date = $_POST['date'] ?? null;
$note = $_POST['note'] ?? null;

class Payment {
    private $conn;

    public function __construct() {
        $this->conn = getConnection();
    }

    public function checkPayment($invoice_id) {
        $status = '';
        $query = " SELECT
              i.*,
              c.NAME AS customerName,
              COALESCE((
                  SELECT SUM(TOTAL_PRICE)
                  FROM invoice_detail
                  WHERE ID_DETAIL = i.ID
              ), 0) AS TOTAL_TAGIHAN,
              COALESCE((
                  SELECT SUM(PAID)
                  FROM payment
                  WHERE INVOICE_ID = i.ID
              ), 0) AS TOTAL_PEMBAYARAN
          FROM invoice i
          LEFT JOIN customer c ON i.CUSTOMER = c.ID
          WHERE i.ID = '$invoice_id'";

        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row['TOTAL_TAGIHAN'] == 0) {
            $status = 'ITEM KOSONG';
          } elseif ($row['TOTAL_PEMBAYARAN'] == $row['TOTAL_TAGIHAN']) {
            $status = 'LUNAS';
          } else {
            $status = 'BELUM LUNAS';
          }
        $update = "UPDATE invoice SET STATUS = '$status' WHERE ID = '$invoice_id'";
        $result = mysqli_query($this->conn, $update);
    }

    public function addPayment($date, $invoice_id, $paid, $note) {
        $tunggakan = "SELECT
                SUM(TOTAL_PRICE) AS UNPAID
                FROM invoice_detail
                WHERE ID_DETAIL = '$invoice_id'";
        $result = mysqli_query($this->conn, $tunggakan);
        $tunggakan = mysqli_fetch_assoc($result);
        if ($tunggakan['UNPAID'] - $paid < 0) {
            $_SESSION['alert'] = 'error_add';
            header("Location: " . BASE_PATH . "/pages/payment/paymentForm.php?inv=$invoice_id");
            exit;
        } else {
            $notes = mysqli_real_escape_string($this->conn, $note);
            $query = "INSERT INTO payment (PAYMENT_DATE, INVOICE_ID, PAID, NOTE) VALUES ('$date', '$invoice_id', '$paid', '$notes')";
            if (mysqli_query($this->conn, $query)) {
                $_SESSION['alert'] = 'added';
                $this->checkPayment($invoice_id);
                header("Location: " . BASE_PATH . "/pages/payment/payment.php?status=success");
                exit;
            } else {
                header("Location: " . BASE_PATH . "/pages/payment/payment.php?status=error");
                exit;
            }    
        }
    }

    public function updatePayment($id, $date, $paid, $note) {        
        $notes = mysqli_real_escape_string($this->conn, $note);
        $query = "UPDATE payment SET PAYMENT_DATE = '$date', PAID = '$paid', NOTE = '$notes' WHERE PAYMENT_ID = '$id'";
        if (mysqli_query($this->conn, $query)) {
            $_SESSION['alert'] = 'updated';


            $invoice = "SELECT INVOICE_ID FROM payment WHERE PAYMENT_ID = '$id'";
            $result = mysqli_query($this->conn, $invoice);
            $invoice_id = mysqli_fetch_assoc($result)['INVOICE_ID'];
    
            $this->checkPayment($invoice_id);

            header("Location: " . BASE_PATH . "/pages/payment/payment.php?status=success");
            exit;
        } else {
            header("Location: " . BASE_PATH . "/pages/payment/payment.php?status=error");
            exit;
        }
    }

    public function deletePayment($id) {
        $query = "DELETE FROM payment WHERE PAYMENT_ID = '$id'";
        if (mysqli_query($this->conn, $query)) {
            $_SESSION['alert'] = 'deleted';

            $invoice = "SELECT INVOICE_ID FROM payment WHERE PAYMENT_ID = '$id'";
            $result = mysqli_query($this->conn, $invoice);
            $invoice_id = mysqli_fetch_assoc($result)['INVOICE_ID'];
    
            $this->checkPayment($invoice_id);

            header("Location: " . BASE_PATH . "/pages/payment/payment.php");
            exit;
        } else {
            header("Location: " . BASE_PATH . "/pages/payment/payment.php?status=error");
            exit;
        }
    }
}

$payment = new Payment();
$action = $_GET['action'] ?? null;
if ($action === 'add') {
    $payment->addPayment($date, $invoice_id, $paid, $note);
} elseif ($action === 'update') {
    $payment->updatePayment($id, $date, $paid, $note);
} elseif ($action === 'delete') {
    $payment->deletePayment($id);
}
?>