<?php
require_once '../config/BaseController.php';

$id = $_GET['id'] ?? $_POST['id'] ?? null;
$name = $_POST['nama'] ?? null;
$ref_no = $_POST['kode'] ?? null;
$address = $_POST['address'] ?? null;
$email = $_POST['email'] ?? null;
$number = $_POST['number'] ?? null;

class Pic {
    private $conn;
    public function __construct() {
        // Include database connection
        $this->conn = getConnection();
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addPic($name, $address, $email, $number) {

        // AUTO NO REF
        $initial = strtoupper(substr($name, 0, 1));
        $sql = "SELECT COUNT(*) AS jumlah FROM pic WHERE PIC_REF LIKE '$initial%'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $nomorUrut = $row['jumlah'] + 1;
        $nomorFormatted = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);

        $no_ref = $initial . $nomorFormatted;

        // INSERT INTO pic
        $query = "INSERT INTO pic (PIC_REF, PIC_NAME, PIC_ADDRESS, PIC_EMAIL, PIC_NUMBER) VALUES ('$no_ref', '$name', '$address', '$email', '$number')";
        $result = mysqli_query($this->conn, $query);
        // CONDITION
        if ($result) {
            header("Location: ../../pages/pic/pic.php?status=added");
            exit;
        } else {
            header("Location: ../../pages/pic/picForm.php?id=&status=gagal");
            exit;
        }
    }

    public function updatePic($id, $name, $ref_no, $address, $email, $number) {
        $ref_no_now = $ref_no;
        $query = "SELECT COUNT(*) as total FROM pic WHERE PIC_ID != '$id' AND PIC_REF LIKE '$ref_no_now'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'];
        if ($total > 0) {
            header("Location: ../../pages/pic/picForm.php?id=$id&status=duplicate");
            exit;
        }

        $query = "UPDATE pic SET PIC_NAME='$name', PIC_REF='$ref_no', PIC_ADDRESS='$address', PIC_EMAIL='$email', PIC_NUMBER='$number' WHERE PIC_ID='$id'";
        $result = mysqli_query($this->conn, $query);

        // Execute the statement
        if ($result) {
            header("Location: ../../pages/pic/pic.php");
        } else {
            header("Location: ../../pages/pic/picForm.php?id=$id&status=gagal");
        }
    }

    public function deletePic($id) {
        $query = "DELETE FROM pic WHERE PIC_ID = '$id'";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Error deleting record: " . mysqli_error($this->conn));
        } else {
            header("Location: ../../pages/pic/pic.php?status=deleted");
        }
    }

}

$pic = new Pic();

if ($_GET['action'] == 'add') {
    $pic->addPic($name, $address, $email, $number);
} elseif ($_GET['action'] == 'update') {
    $pic->updatePic($id, $name, $ref_no, $address, $email, $number);
} elseif ($_GET['action'] == 'delete') {
    $pic->deletePic($id);
} else {
    header("Location: ../../pages/pic/pic.php");
}

?>