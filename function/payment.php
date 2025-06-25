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
    echo "halo delete";
    $payment->deletePayment($id);
}
?>