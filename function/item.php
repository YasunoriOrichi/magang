<?php
session_start();
require_once '../config/BaseController.php';
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? $_POST['id'] ?? null;
$name = $_POST['nama'] ?? null;
$price = $_POST['harga'] ?? null;
$ref_no = $_POST['kode'] ?? null;

class Item {
    private $conn;
    public function __construct() {
        $this->conn = getConnection();
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addItem($name, $price) {
        $initial = strtoupper(substr($name, 0, 1));
        $query = "SELECT COUNT(*) AS jumlah FROM item WHERE REF_NO LIKE '$initial%'";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        $nomorUrut = $row['jumlah'] + 1;
        $nomorFormatted = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);

        $no_ref = $initial . $nomorFormatted;

        // INSERT INTO item
        $query = "INSERT INTO item (REF_NO, NAME, PRICE) VALUES ('$no_ref', '$name', '$price')";
        $result = mysqli_query($this->conn, $query);

        // CONDITION
        if ($result) {
            $_SESSION['alert'] = 'added';
            header("Location: ../pages/item/item.php");
            exit;
        } else {
            echo "Error adding item";
        }
    }

    public function updateItem($id, $name, $price, $ref_no) {
        $ref_no_now = $ref_no;
        $query = "SELECT COUNT(*) as total FROM item WHERE ID != '$id' AND REF_NO LIKE '$ref_no_now'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        if ($total > 0) {
            $_SESSION['alert'] = 'duplicate';
            header("Location: ../../pages/item/itemForm.php?id=$id&status=duplicate");
            exit;
        }

        $update = "UPDATE item SET NAME='$name', REF_NO='$ref_no', PRICE = '$price' WHERE ID = '$id'";
        $result = mysqli_query($this->conn, $update);
        
        if ($result) {
            $_SESSION['alert'] = 'updated';
            header("Location: ../../pages/item/item.php");
            exit;
        } else {
            echo "❌ Gagal update item.";
        }
    }

    public function deleteItem($id) {
        $query = "DELETE FROM item WHERE ID='$id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $_SESSION['alert'] = 'deleted';
            header("Location: ../../pages/item/item.php");
            exit;
        } else {
            echo "❌ Gagal menghapus item.";
        }
    }
}

$item = new Item();

if ($_GET['action'] == 'add') {
    $item->addItem($name, $price);
} elseif ($_GET['action'] == 'update') {
    $item->updateItem($id, $name, $price, $ref_no);
} elseif ($_GET['action'] == 'delete') {
    $item->deleteItem($id);
} else {
    $_SESSION['alert'] = 'invalid';
    header("Location: ../../pages/item/item.php");
}


?>