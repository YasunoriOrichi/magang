<?php
require_once '../config/BaseController.php';

$id = $_GET['id'] ?? $_POST['id'] ?? null;
$name = $_POST['nama'] ?? null;
$ref_no = $_POST['kode'] ?? null;
$address = $_POST['address'] ?? null;
$email = $_POST['email'] ?? null;
$number = $_POST['number'] ?? null;

class Customer {
    private $conn;
    public function __construct() {
        // Include database connection
        $this->conn = getConnection();
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addCustomer($name, $address, $email, $number) {

        // AUTO NO REF
        $initial = strtoupper(substr($name, 0, 1));
        $sql = "SELECT COUNT(*) AS jumlah FROM customer WHERE REF_NO LIKE '$initial%'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $nomorUrut = $row['jumlah'] + 1;
        $nomorFormatted = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);

        $no_ref = $initial . $nomorFormatted;

        // INSERT INTO customer
        $query = "INSERT INTO customer (REF_NO, NAME, ADDRESS, EMAIL, NUMBER) VALUES ('$no_ref', '$name', '$address', '$email', '$number')";
        $result = mysqli_query($this->conn, $query);
        // CONDITION
        if ($result) {
            header("Location: ../../pages/customer/customer.php?status=added");
            exit;
        } else {
            header("Location: ../../pages/customer/customerForm.php?id=&status=gagal");
            exit;
        }
    }

    public function updateCustomer($id, $name, $ref_no, $address, $email, $number) {
        $ref_no_now = $ref_no;
        $query = "SELECT COUNT(*) as total FROM customer WHERE ID != '$id' AND REF_NO LIKE '$ref_no_now'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        if ($total > 0) {
            header("Location: ../../pages/customer/customerForm.php?id=$id&status=duplicate");
            exit;
        }

        $query = "UPDATE customer SET NAME='$name', REF_NO='$ref_no', ADDRESS='$address', EMAIL='$email', NUMBER='$number' WHERE ID='$id'";
        $result = mysqli_query($this->conn, $query);

        // Execute the statement
        if ($result) {
            header("Location: ../../pages/customer/customer.php");
        } else {
            header("Location: ../../pages/customer/customerForm.php?id=$id&status=gagal");
        }
    }

    public function deleteCustomer($id) {
        $query = "DELETE FROM customer WHERE ID = '$id'";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Error deleting record: " . mysqli_error($this->conn));
        } else {
            header("Location: ../../pages/customer/customer.php?status=deleted");
        }
    }

}

$customer = new Customer();

if ($_GET['action'] == 'add') {
    $customer->addCustomer($name, $address, $email, $number);
} elseif ($_GET['action'] == 'update') {
    $customer->updateCustomer($id, $name, $ref_no, $address, $email, $number);
} elseif ($_GET['action'] == 'delete') {
    $customer->deleteCustomer($id);
} else {
    header("Location: ../../pages/customer/customer.php");
}

?>