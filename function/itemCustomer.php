<?php
session_start();
require_once '../config/BaseController.php';
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? $_POST['id'] ?? null;
$customer = $_POST['kustomer'] ?? null;
$item = $_POST['item'] ?? null;
$price = $_POST['harga'] ?? '1';
$ref_no = $_POST['kode'] ?? null;

class ItemCustomer {
    private $conn;
    public function __construct() {
        $this->conn = getConnection();
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addItemCustomer($item, $price, $customer) {
        if (empty($_POST['harga'])) {
            $q = mysqli_query($this->conn, "SELECT PRICE FROM item WHERE ID = '$item'");
            $data = mysqli_fetch_assoc($q);
            $price = $data['PRICE'];
        } else {
            $price = $_POST['harga'];
        }

        // GET NAME CUSTOMER
        $queryName = "SELECT NAME FROM customer WHERE ID = '$customer'";
        $resultName = $this->conn->query($queryName);
        $rowName = mysqli_fetch_assoc($resultName);
        $customerName = $rowName['NAME'];

        // GET NAME ITEM
        $queryItem = "SELECT NAME FROM item WHERE ID = '$item'";
        $resultItem = $this->conn->query($queryItem);
        $rowItem = mysqli_fetch_assoc($resultItem);
        $itemName = $rowItem['NAME'];

        // INSERT DATA TANPA ref_no DULU
        $insert = "INSERT INTO itemcustomer (CUSTOMER, ITEM, PRICE) VALUES ('$customer', '$item', '$price')";
        $this->conn->query($insert);

        // GET ID YANG BARU DIBUAT
        $newID = $this->conn->insert_id;

        // BUAT REF_NO DARI INISIAL + ID
        $initialKustomer = strtoupper(substr($customerName, 0, 1));
        $initialItem = strtoupper(substr($itemName, 0, 1));
        $nomorFormatted = str_pad($newID, 3, "0", STR_PAD_LEFT);
        $ref_no = $initialKustomer . $initialItem . $nomorFormatted;

        // UPDATE ref_no BERDASARKAN ID YANG BARU
        $update = "UPDATE itemcustomer SET REF_NO = '$ref_no' WHERE ID = '$newID'";
        $this->conn->query($update);

        // REDIRECT / FEEDBACK
        $_SESSION['alert'] = 'added';
        header("Location: ../../pages/itemCustomer/itemCustomer.php");
    }

    public function updateItemCustomer($id, $customer, $item, $price, $ref_no) {
        $ref_no_now = $ref_no;
        $query = "SELECT COUNT(*) as total FROM itemcustomer WHERE ID != '$id' AND REF_NO LIKE '$ref_no_now'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        if ($total > 0) {
            $_SESSION['alert'] = 'duplicate';
            header("Location: ../../pages/itemCustomer/itemCustomerForm.php?id=$id");
            exit;
        }

        $query = "UPDATE itemcustomer SET REF_NO='$ref_no', CUSTOMER='$customer', ITEM='$item', PRICE='$price' WHERE ID='$id'";

        // Execute the statement
        if (mysqli_query($this->conn, $query)) {
            $_SESSION['alert'] = 'updated';
            header("Location: ../../pages/itemCustomer/itemCustomer.php");
        } else {
            echo "Error updating customer";
        }
    }

    public function deleteItemCustomer($id) {
        $query = "DELETE FROM itemcustomer WHERE ID = '$id'";
        $hasil = mysqli_query($this->conn, $query);

        if ($hasil) {
            $_SESSION['alert'] = 'deleted';
            header("Location: ../../pages/itemCustomer/itemCustomer.php?status=deleted");
        } else {
            $_SESSION['alert'] = 'error_deleted';
            header("Location: ../../pages/itemCustomer/itemCustomer.php?status=error_delete");
        }
    }
}

$itemCustomer = new ItemCustomer();

if ($_GET['action'] == 'add') {
    $itemCustomer->addItemCustomer($item, $price, $customer);
} elseif ($_GET['action'] == 'update') {
    $itemCustomer->updateItemCustomer($id, $customer, $item, $price, $ref_no);
} elseif ($_GET['action'] == 'delete') {
    $itemCustomer->deleteItemCustomer($id);
} else {
    $_SESSION['alert'] = 'invalid';
    header("Location: ../../pages/itemCustomer/itemCustomer.php");
}


?>