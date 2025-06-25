<?php
require_once '../config/BaseController.php';

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? $_POST['id'] ?? null;
$name = $_POST['nama'] ?? null;
$ref_no = $_POST['kode'] ?? null;

class Supplier {
    private $conn;
    public function __construct() {
        $this->conn = getConnection();
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addSupplier($name) {

        // AUTO NO REF
        $initial = strtoupper(substr($name, 0, 1));
        $sql = "SELECT COUNT(*) AS jumlah FROM supplier WHERE REF_NO LIKE '$initial%'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $nomorUrut = $row['jumlah'] + 1;
        $nomorFormatted = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);

        $no_ref = $initial . $nomorFormatted;

        // INSERT INTO supplier
        $query = "INSERT INTO supplier (REF_NO, NAME) VALUES ('$no_ref', '$name')";
        $result = mysqli_query($this->conn, $query);
        // CONDITION
        if ($result) {
            header("Location: ../../pages/supplier/supplier.php?status=added");
            exit;
        } else {
            header("Location: ../../pages/supplier/supplierForm.php?id=&status=gagal");
            exit;
        }
    }

    public function updateSupplier($id, $name, $ref_no) {
        $ref_no_now = $ref_no;
        $query = "SELECT COUNT(*) as total FROM supplier WHERE ID != '$id' AND REF_NO LIKE '$ref_no_now'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        if ($total > 0) {
            header("Location: ../../pages/supplier/supplierForm.php?id=$id&status=duplicate");
            exit;
        }

        $query = "UPDATE supplier SET NAME='$name', REF_NO='$ref_no' WHERE ID='$id'";
        $result = mysqli_query($this->conn, $query);

        // Execute the statement
        if ($result) {
            header("Location: ../../pages/supplier/supplier.php?status=updated");
        } else {
            header("Location: ../../pages/supplier/supplierForm.php?id=$id&status=gagal");
        }
    }

    public function deleteSupplier($id) {
        $query = "DELETE FROM supplier WHERE ID = '$id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            header("Location: ../../pages/supplier/supplier.php?status=deleted");
        } else {
            header("Location: ../../pages/supplier/supplier.php?status=error_delete");
        }
    }

}

$supplier = new Supplier();

if ($_GET['action'] == 'add') {
    $supplier->addSupplier($name);
} elseif ($_GET['action'] == 'update') {
    $supplier->updateSupplier($id, $name, $ref_no);
} elseif ($_GET['action'] == 'delete') {
    $supplier->deleteSupplier($id);
} else {
    header("Location: ../../pages/supplier/supplier.php?status=invalid");
}

?>