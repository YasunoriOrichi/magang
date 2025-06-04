<?php
    class base {
        private $conn;
        private $name;

        public function __construct($conn, $name) {
            $this->conn = $conn;
            $this->name = $name;
        }

        public function addCustomer() {
            // VALIDATE NAME
            $check_name = "SELECT * FROM customer WHERE NAME = '$this->name'";
            $resultName = $this->conn->query($check_name);

            if ($resultName->num_rows > 0) {
                header("Location: ../../pages/customer/customerAdd.php?status=duplikat");
                exit;
            }

            // AUTO NO REF
            $initial = strtoupper(substr($this->name, 0, 1));
            $sql = "SELECT COUNT(*) AS jumlah FROM customer WHERE REF_NO LIKE '$initial%'";
            $result = $this->conn->query($sql);
            $row = $result->fetch_assoc();
            $nomorUrut = $row['jumlah'] + 1;
            $nomorFormatted = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);

            $no_ref = $initial . $nomorFormatted;

            // INSERT INTO customer
            $query = "INSERT INTO customer (REF_NO, NAME) VALUES ('$no_ref', '$this->name')";
            $result = mysqli_query($this->conn, $query);

            // CONDITION
            if ($result) {
                echo "<script>window.location.href='../../pages/customer/customer.php?status=added';</script>";
            } else {
                echo "Error adding customer";
            }
        }

        public function updateCustomer() {
            // Update customer logic here
        }

        public function deleteCustomer() {
            // Delete customer logic here
        }
    }
?>