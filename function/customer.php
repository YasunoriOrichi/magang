<?php
require_once '../config/BaseController.php';

$id = $_GET['id'] ?? $_POST['id'] ?? null;
$name = $_POST['nama'] ?? null;
$ref_no = $_POST['kode'] ?? null;
$address = $_POST['address'] ?? null;
$email = $_POST['email'] ?? null;
$number = $_POST['number'] ?? null;
$file = $_FILES['import']['tmp_name'] ?? null;

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

    public function exportCSV() {
        $query = "SELECT * FROM customer ORDER BY NAME ASC";
        $result = $this->conn->query($query);
    
        if ($result->num_rows > 0) {
            ob_clean(); // Bersihkan output buffer sebelum mengirim header CSV
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="customer.csv"');
    
            $output = fopen('php://output', 'w');
    
            // Tulis header kolom
            fputcsv($output, ['No', 'Nomor Referal', 'Nama', 'Alamat', 'No. Telp'], ';');
    
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                fputcsv($output, [
                    $no++,
                    $row['REF_NO'],
                    $row['NAME'],
                    $row['ADDRESS'],
                    $row['NUMBER']
                ], ';');
            }
    
            fclose($output);
            exit;
        } else {
            echo "Tidak ada data Kostumer.";
        }
    }

    public function importCSV($file) {
        if ($file > 0) {
            $handle = fopen($file, "r");
            $isHeader = true;
    
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if ($isHeader) {
                    $isHeader = false;
                    continue;
                }
    
                // Kolom sesuai urutan CSV kamu:
                // 0 = No, 1 = Nomor Refi, 2 = Nama, 3 = Alamat, 4 = No. Telp
                $kode_ref = trim($data[0]);
                $nama     = trim($data[1]);
                $alamat   = trim($data[2]);
                $telp     = trim($data[3]);
    
                // Cek jika semua data valid (misalnya nama tidak kosong)
                if ($nama !== "") {
                    $stmt = $this->conn->prepare("INSERT INTO customer (REF_NO, NAME, ADDRESS, NUMBER) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $kode_ref, $nama, $alamat, $telp);
                    $stmt->execute();
                }
            }
    
            fclose($handle);
            $_SESSION['alert'] = 'imported';
            header("Location: ../../pages/customer/customer.php");
        } else {
            echo "File kosong!";
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
} elseif ($_GET['action'] == 'exportCSV') {
    $customer->exportCSV();
} elseif ($_GET['action'] == 'importCSV') {
    $customer->importCSV($file);
} else {
    header("Location: ../../pages/customer/customer.php");
}

?>